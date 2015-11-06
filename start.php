<?php

/**
 * Roles UI
 *
 * @package Elgg
 * @subpackage Roles\UI
 *
 * @author Ismayil Khayredinov <ismayil.khayredinov@gmail.com>
 * @copyright Copyright (c) 2013, Ismayil Khayredinov
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License v2
 */

namespace Elgg\Roles\UI;

require_once __DIR__ . "/lib/functions.php";
require_once __DIR__ . "/lib/hooks.php";
require_once __DIR__ . "/lib/events.php";

elgg_register_event_handler('init', 'system', __NAMESPACE__ . '\\init', 999);

/**
 * Init plugin
 */
function init() {

	if (!elgg_is_admin_logged_in()) {
		return;
	}

	elgg_unregister_event_handler('ready', 'system', 'roles_check_update');

	// Register actions
	elgg_register_action('roles/edit', __DIR__ . '/actions/edit.php', 'admin');
	elgg_register_action('roles/permissions', __DIR__ . '/actions/permissions.php', 'admin');
	elgg_register_action('roles/set', __DIR__ . '/actions/set.php', 'admin');

	// Register JS and CSS
	elgg_register_simplecache_view('css/roles/ui/admin');
	elgg_register_css('roles.ui.admin', elgg_get_simplecache_url('css', 'roles/ui/admin'));

	elgg_register_simplecache_view('css/roles/ui/set');
	elgg_register_css('roles.ui.set', elgg_get_simplecache_url('css', 'roles/ui/set'));

	// Override roles config once roles specified by other plugins have been created
	//elgg_register_plugin_hook_handler('roles:config', 'role', __NAMESPACE__ . '\\get_roles_config');

	// Pretty URL for roles
	elgg_register_entity_url_handler('object', 'role', __NAMESPACE__ . '\\url_handler');

	// Register admin menu items
	elgg_register_event_handler('pagesetup', 'system', __NAMESPACE__ . '\\menu_setup');

	// Allow admins to set the role from user hover menu
	elgg_register_plugin_hook_handler('register', 'menu:user_hover', __NAMESPACE__ . '\\user_hover_menu_setup');

	// Register an ajax view to pull up a roles form
	elgg_extend_view('navigation/menu/user_hover', 'roles/ui/user_hover');
	elgg_register_ajax_view('roles/ajax/set');

	if (version_compare(elgg_get_version(true), '2.0', '<')) {
		elgg_register_simplecache_view('js' , 'roles/ui/config.js');
	} else {
		elgg_register_simplecache_view('js/roles/ui/config.js');
	}
}

/**
 * Pretty URL for roles
 * 
 * @param ElggRole $role
 * @return string
 */
function url_handler($role) {
	return elgg_normalize_url("admin/roles/permissions?role=$role->name");
}
