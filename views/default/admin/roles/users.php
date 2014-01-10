<?php

namespace Elgg\Roles\UI;

$role = roles_get_role_by_name(get_input('role', DEFAULT_ROLE));

echo '<h3>' . elgg_echo(PLUGIN_ID . ':users:in_role', array($role->title)) . '</h3>';

$list = elgg_list_entities_from_relationship(array(
	'types' => 'user',
	'relationship' => 'has_role',
	'relationship_guid' => $role->guid,
	'inverse_relationship' => true,
	'pagination' => true,
		));

if (!$list) {
	echo '<p>' . elgg_echo(PLUGIN_ID . ':users:none', array($role->title)) . '</p>';
} else {
	echo $list;
}
