<?php
if ( preg_match( '/\.(?:png|mp4|gif|webmanifest|ico|map|svg|css|js|woff2?)$/', $_SERVER['REQUEST_URI'] ) ) {
	return false; // Bail on static requests.
}

require __DIR__ . '/vendor/autoload.php';

use Bramus\Router\Router;
use Aura\Session\SessionFactory;
use PHPEOSIO\Client;

$client = new PHPEOSIO\Client( 'http://localhost:8888' );
$session = ( new SessionFactory )->newInstance( $_COOKIE );
$templates = new \Twig\Environment( new \Twig\Loader\FilesystemLoader( __DIR__ . '/templates/' ), [] );
$router = new Router();

if ( $account = $session->getSegment( 'elemental' )->get( 'account' ) ) {
	$client->add_key( "$account@active", $session->getSegment( 'elemental' )->get( 'key' ) );
}

$router->get( '/', function() use ( $router, $templates, $account, $client ) {
	$user = $client->get_table_rows( 'elemental', 'users', 'elemental', [
		'lower_bound' => $account,
		'limit' => 1,
	] );
	echo $templates->render( 'home.tpl', [
		'user' => reset( $user ),
		'account' => $account,
	] );
} );

$router->match( 'GET|POST', '/login/', function() use ( $router, $templates, $session, $client ) {
	if ( $session->getSegment( 'elemental' )->get( 'account' ) ) {
		header( 'Location: /' );
		exit;
	}

	if ( $router->getRequestMethod() === 'GET' ) {
		echo $templates->render( 'login.tpl' );
		return;
	}

	$account = trim( $_POST['account'] ?? '' );
	$key = trim( $_POST['key'] ?? '' );

	if ( empty( $account ) || empty( $key ) ) {
		echo $templates->render( 'login.tpl', [
			'error' => 'Invalid account/key combination',
			'post' => $_POST,
		] );
		return;
	}

	try {
		$client->add_key( "$account@active", $key );
		$response = $client->push_transaction( 'elemental', 'login', [
			'username' => $account,
		], "$account@active" );
	} catch ( Exception $e ) {
		echo $templates->render( 'login.tpl', [
			'error' => $e->getMessage(),
			'post' => $_POST,
		] );
		return;
	}

	// This is a super unsafe way of doing this. The server should
	// never ever ever see the private key of the user. Use localStorage
	// and sign transactions in eosio-js, etc. on the client-side instead.
	$session->getSegment( 'elemental' )->set( 'account', $account );
	$session->getSegment( 'elemental' )->set( 'key', $key );

	header( 'Location: /' );
	exit;
} );

$router->get( '/logout/', function() use ( $router, $templates, $session ) {
	$session->destroy();
	
	header( 'Location: /' );
	exit;
} );

$router->run();
