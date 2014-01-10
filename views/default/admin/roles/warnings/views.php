<?php

namespace Elgg\Roles\UI;

echo elgg_view('output/url', array(
	'text' => "<sup>&lowast;</sup>",
	'title' => elgg_echo(PLUGIN_ID . ':warning:views'),
	'class' => 'roles-ui-warning',
	'href' => false
));