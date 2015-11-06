<?php

/**
 * Change user role
 */

namespace Elgg\Roles\UI;

$guid = get_input('guid');
$role_name = get_input('role');

$user = get_entity($guid);
$role = roles_get_role_by_name($role_name);

if (!elgg_is_admin_logged_in()) {
	register_error(elgg_echo('roles_ui:set:error:admin_gatekeeper'));
	forward(REFERER);
}

if (!elgg_instanceof($user, 'user')) {
	register_error(elgg_echo('roles_ui:set:error:no_user'));
	forward(REFERER);
}

if (!elgg_instanceof($role, 'object', 'role')) {
	register_error(elgg_echo('roles_ui:set:error:no_role'));
	forward(REFERER);
}

$current_role = roles_get_role($user);

if ($role->guid == $current_role->guid) {
	register_error(elgg_echo('roles_ui:set:error:equivalent_role'));
	forward(REFERER);
}

if (roles_set_role($role, $user)) {
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
			)
		);

		print(json_encode($output));
	}
} else {
	register_error(elgg_echo('roles_ui:set:error:unknown'));
}

forward(REFERER);

