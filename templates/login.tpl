{% extends "base.tpl" %}

{% block content %}
	<div>
		<h1 class="text-7xl my-8">Login</h1>
	</div>
	{% if error %}
		<p class="text-red-500">{{ error }}. Please try again or file an issue.</p>
	{% endif %}
	<div class="my-8">
		<form method="post">
			<label class="block">
				<span>Your EOS Account</span>
				<input class="block w-3/6 border-cyan-900 focus:border-cyan-900" type="text" name="account" value="{{ post.account|e('html_attr') }}">
			</label>
			<label class="block mt-4">
				<span>Your EOS Private Key*</span>
				<input class="block w-3/6 border-cyan-900 focus:border-cyan-900" type="text" name="key" value="{{ post.key|e('html_attr') }}">
				<span class="block text-sm text-gray-300">*We promise we won't steal it.**</span>
				<span class="block text-sm text-gray-300">**Seriously, though, don't enter your mainnet key here.</span>
			</label>

			<div class="block mt-4">
				<input class="text-5xl bg-cyan-900 hover:bg-cyan-700 text-white py-2 px-4 rounded" type="submit" name="login" value=".login()">
			</div>
		</form>
	</div>
{% endblock %}
