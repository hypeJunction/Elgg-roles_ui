<?php

namespace Elgg\Roles\UI;

$entity = elgg_extract('entity', $vars);

$title = elgg_view('output/url', array(
	'text' => $entity->getDisplayName(),
	'href' => $entity->getURL()
		));

$subtitle = elgg_echo('roles_ui:name'). ': <strong>' . $entity->name . '</strong>';

$extends = $role->extends;
if ($extends && !is_array($extends)) {
	$extends = array($extends);
}

if (count($extends)) {
	$content .= '<div class="roles-ui-extends">';
	$content .= '<h3>' . elgg_echo('roles_ui:extends') . '</h3>';
	$content .= '<ul class="elgg-list">';
	foreach ($extends as $rname) {
		$content .= '<li>';
		$content .= elgg_view('output/url', array(
			'text' => $rname,
			'href' => "admin/roles/permissions?role=$rname"
		));
		$content .= '</li>';
	}
	$content .= '</ul>';
	$content .= '</div>';
}

echo elgg_view('object/elements/summary', array(
	'entity' => $entity,
	'title' => $title,
	'subtitle' => $subtitle,
	'content' => $content,
));
