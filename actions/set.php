<?php

/**
 * Change user role
 */

namespace Elgg\Roles\UI;

$guid = get_input('guid');
$roles = get_input('roles');

$user = get_entity($guid);

if (!elgg_is_admin_logged_in()) {
	register_error(elgg_echo('roles_ui:set:error:admin_gatekeeper'));
	forward(REFERER);
}

if (!elgg_instanceof($user, 'user')) {
	register_error(elgg_echo('roles_ui:set:error:no_user'));
	forward(REFERER);
}

// reset roles to default
roles_unset_role(null, $user);

if (!empty($roles)) {
	foreach ($roles as $role_name) {
		$role = roles_get_role_by_name($role_name);
		if (!$role) {
			continue;
		}
		sleep(1); // roles are prioritized by relationship time, so make sure times are different
		roles_add_role($role, $user);
	}
}

$role = roles_get_role($user);

system_message(elgg_echo('roles_ui:set:success'));
if (elgg_is_xhr()) {
	$output = array(
		'user' => array(
			'guid' => $user->guid,
			'name' => $user->name,
		),
		'role' => array(
			'guid' => $role->guid,
			'name' => $role->name,
			'title' => $role->getDisplayName(),
		),
	);

	echo json_encode($output);
}

forward(REFERER);

