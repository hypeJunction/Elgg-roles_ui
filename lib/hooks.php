<?php

namespace Elgg\Roles\UI;

/**
 * Override roles config, so that we do not loose permissions when roles are recreated from config
 * Iterate through new roles so that we have record of them in UI
 *
 * @return type
 */
function get_roles_config($hook, $type, $return, $params) {

	foreach ($return as $role_name => $role_options) {
		if (roles_get_role_by_name($role_name)) {
			unset($return[$role_name]);
		}
	}

	return $return;
}

/**
 * Add a menu item to the user hover menu to allow admins to easily change role
 *
 * @param string $hook	Equals 'register'
 * @param string $type	Equals 'menu:user_hover'
 * @param array $menu	Current menu
 * @param array $params	Addiitonal params
 * @return array	Updated menu
 */
function user_hover_menu_setup($hook, $type, $menu, $params) {

	$user = elgg_extract('entity', $params);

	if (!elgg_instanceof($user, 'user') || $user->isAdmin()) {
		return $menu;
	}

	if (!elgg_is_admin_logged_in()) {
		return $menu;
	}

	$role = roles_get_role($user);

	$menu[] = \ElggMenuItem::factory(array(
				'name' => 'roles:set',
				'text' => elgg_echo('roles_ui:set:role', array($role->getDisplayName())),
				'href' => 'ajax/view/roles/ajax/set?guid=' . $user->guid,
				'data-guid' => $user->guid,
				'section' => 'admin',
	));

	return $menu;
}
