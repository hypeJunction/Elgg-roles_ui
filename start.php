<?php

/**
 *
 * Roles UI
 *
 * @package Roles
 * @subpackage RolesUserInterface
 * @author Ismayil Khayredinov
 * @copyright Ismayil Khayredinov, 2013
 * @link http://www.hypejunction.com/
 */
elgg_register_event_handler('init', 'system', 'roles_ui_init', 999);

function roles_ui_init() {

	if (!is_callable('roles_init')) {
		register_error(elgg_echo('roles:ui:plugin_dependancy_error'));
		disable_plugin('roles_ui');
		forward('admin/plugins');
	}

	$path = elgg_get_plugins_path() . 'roles_ui/';

	$libraries = array(
		'actions',
		'menus',
		'helpers',
		'assets',
	);

	foreach ($libraries as $lib) {
		$libpath = "{$path}lib/{$lib}.php";
		if (file_exists($libpath)) {
			elgg_register_library("roles:ui:library:$lib", $libpath);
			elgg_load_library("roles:ui:library:$lib");
		}
	}

	// Override roles config once roles specified by other plugins have been created
	elgg_register_plugin_hook_handler('roles:config', 'role', 'roles_ui_get_roles_config');

}

/**
 * Override roles config, so that we do not loose permissions when roles are recreated from config
 * Let through new roles so that we have record of them in UI
 *
 * @return type
 */
function roles_ui_get_roles_config($hook, $type, $return, $params) {

	foreach ($return as $role_name => $role_options) {
		if (roles_get_role_by_name($role_name)) {
			unset($return[$role_name]);
		}
	}

	return $return;
}
