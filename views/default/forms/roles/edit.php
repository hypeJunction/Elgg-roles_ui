<?php

namespace Elgg\Roles\UI;

$role = elgg_extract('entity', $vars);
$roles = roles_get_all_roles();

echo '<div>';
echo '<label>' . elgg_echo('roles_ui:name') . '</label>';
echo '<span class="elgg-text-help">' . elgg_echo('roles_ui:name:help') . '</span>';
echo elgg_view('input/text', array(
	'name' => 'name',
	'value' => $role->name,
	'disabled' => ($role->name)
));
echo '</div>';

echo '<div>';
echo '<label>' . elgg_echo('roles_ui:title') . '</label>';
echo '<span class="elgg-text-help">' . elgg_echo('roles_ui:title:help') . '</span>';
echo elgg_view('input/text', array(
	'name' => 'title',
	'value' => $role->title,
));
echo '</div>';

echo '<div>';
echo '<label>' . elgg_echo('roles_ui:extends') . '</label>';
echo '<span class="elgg-text-help">' . elgg_echo('roles_ui:extends:help') . '</span>';

echo '<table class="elgg-table-alt">';

echo '<thead>';
echo '<tr>';
echo '<th>' . elgg_echo('roles_ui:extend_name') . '</th>';
echo '<th>' . elgg_echo('roles_ui:extend_order') . '</th>';
echo '</tr>';
echo '</thead>';

echo '<tbody>';
foreach ($roles as $r) {

	if ($r->guid == $role->guid)
		continue;

	echo '<tr>';

	echo '<td>';
	echo '<label>' . elgg_echo($r->title) . '</label>';
	echo '</td>';

	$order = array_search($r->name, $role->extends);

	echo '<td>';
	echo elgg_view('input/text', array(
		'name' => "extends[$r->guid]",
		'value' => ($order !== false) ? $order : ''
	));
	echo '</td>';

	echo '</tr>';
}
echo '</tbody>';
echo '</table>';

echo '</div>';

echo '<div class="elgg-foot">';

echo elgg_view('input/hidden', array(
	'name' => 'guid',
	'value' => $role->guid
));

echo elgg_view('input/submit', array(
	'value' => elgg_echo('save')
));
echo '</div>';



