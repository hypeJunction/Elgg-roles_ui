<?php

namespace Elgg\Roles\UI;

echo elgg_view('output/url', array(
	'text' => "<sup>&lowast;</sup>",
	'title' => elgg_echo('roles_ui:warning:callback'),
	'class' => 'roles-ui-warning',
	'href' => false
));