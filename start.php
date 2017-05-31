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

use hypeJunction\Roles\Ui\Menus;
use hypeJunction\Roles\Ui\Router;

require_once __DIR__ . '/autoloader.php';

elgg_register_event_handler('init', 'system', function() {

	if (!elgg_is_admin_logged_in()) {
		return;
	}

	elgg_unregister_event_handler('ready', 'system', 'roles_check_update');

	// Register actions
	elgg_register_action('roles/edit', __DIR__ . '/actions/edit.php', 'admin');
	elgg_register_action('roles/delete', __DIR__ . '/actions/delete.php', 'admin');
	elgg_register_action('roles/permissions', __DIR__ . '/actions/permissions.php', 'admin');
	elgg_register_action('roles/set', __DIR__ . '/actions/set.php', 'admin');

	// Register JS and CSS
	elgg_register_simplecache_view('js/roles/ui/config.js');
	elgg_extend_view('css/elgg', 'roles/ui/set.css');
	elgg_extend_view('css/admin', 'roles/ui/admin.css');

	// Pretty URL for roles
	elgg_register_plugin_hook_handler('entity:url', 'object', [Router::class, 'setURL']);

	// Register admin menu items
	elgg_register_plugin_hook_handler('register', 'menu:page', [Menus::class, 'setupPageMenu']);

	// Allow admins to set the role from user hover menu
	elgg_register_plugin_hook_handler('register', 'menu:user_hover', [Menus::class, 'setupUserHoverMenu']);

	// Setup role menu
	elgg_register_plugin_hook_handler('register', 'menu:entity', [Menus::class, 'setupEntityMenu'], 1000);

	// Register an ajax view to pull up a roles form
	elgg_register_ajax_view('roles/ajax/set');

});
