{% extends "base.tpl" %}

{% block content %}
	<div>
		<h1 class="text-7xl my-8">EOSIO Elemental Battles</h1>
	</div>
	{% if account %}
		<p>Let's get ready to rumble, <strong>{{ account|e('html') }}</strong>! (<a class="text-gray-300" href="/logout/">Logout</a>)</p>

		<h2 class="mt-8 text-3xl">Win Stats</h2>
		<p>Total games: {{ user.games }}, of which {{ ( user.score + user.games ) / 2 }} won and {{ user.games - ( ( user.score + user.games ) / 2 ) }} lost.</p>
	{% else %}
		<div class="my-8">
			<a class="text-5xl bg-cyan-900 hover:bg-cyan-700 text-white py-2 px-4 rounded" href="/login/">.login()</a>
		</div>
	{% endif %}
{% endblock %}
