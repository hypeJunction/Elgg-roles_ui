<?php

namespace Elgg\Roles\UI;

$guid = get_input('guid', null);
$current_role = get_entity($guid);

$name = strtolower(get_input('name'));
$title = get_input('title');
if (!$title)
	$title = elgg_echo("roles:role:$name");

$extends = get_input('extends', array());
foreach ($extends as $role_guid => $order) {
	if (!$order)
		continue;
	$role_name = get_entity($role_guid)->name;
	$ordered_extends[$order] = $role_name;
}
$ordered_extends = array_values($ordered_extends);

if (!$current_role && roles_get_role_by_name($name)) {
	register_error(elgg_echo('roles_ui:edit:duplicate', array($name)));
	forward(REFERER);
}

if (elgg_instanceof($current_role, 'object', 'role')) {
	// Update existing role obejct
	$current_role->title = $title;
	$current_role->setExtends($ordered_extends);
	if ($current_role->save()) {
		system_message(elgg_echo('roles_ui:edit:success', array($name)));
		$forward_url = $current_role->getURL();
	}
} else {

	$site = elgg_get_site_entity();

	// Create new role object
	$new_role = new \ElggRole();
	$new_role->title = $title;
	$new_role->owner_guid = elgg_get_logged_in_user_guid();
	$new_role->container_guid = $site->owner_guid;
	$new_role->access_id = ACCESS_PUBLIC;
	if (!($new_role->save())) {
		error_log('Could not create new role $name');
		register_error(elgg_echo('roles_ui:edit:error', array($name)));
		$forward_url = REFERER;
	} else {
		// Add metadata
		$new_role->name = $name;
		$new_role->setExtends($ordered_extends);
		$new_role->setPermissions(array());
		system_message(elgg_echo('roles_ui:edit:success', array($name)));
		$forward_url = $new_role->getURL();
	}
}

// Reset hash so that the cache is reindexed
elgg_set_plugin_setting('roles_hash', '', 'roles');

forward($forward_url);