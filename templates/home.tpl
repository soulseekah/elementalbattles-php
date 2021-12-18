{% extends "base.tpl" %}

{% block content %}
	<div>
		<h1 class="text-7xl my-8">EOSIO Elemental Battles</h1>
	</div>
	{% if user %}
		<p>Let's get ready to rumble, <strong>{{ user|e('html') }}</strong>! (<a href="/logout/">Logout</a>)</p>
	{% else %}
		<div class="my-8">
			<a class="text-5xl bg-cyan-900 hover:bg-cyan-700 text-white py-2 px-4 rounded" href="/login/">.login()</a>
		</div>
	{% endif %}
{% endblock %}
