<?php

namespace Elgg\Roles\UI;

/**
 * Setup menus
 */
function menu_setup() {

	if (elgg_is_admin_logged_in()) {

		elgg_register_menu_item('page', array(
			'name' => 'summary',
			'href' => 'admin/roles/summary',
			'text' => elgg_echo('admin:roles:summary'),
			'context' => 'admin',
			'section' => 'roles'
		));

		elgg_register_menu_item('page', array(
			'name' => 'create',
			'href' => 'admin/roles/create',
			'text' => elgg_echo('admin:roles:create'),
			'context' => 'admin',
			'section' => 'roles'
		));

		elgg_register_menu_item('page', array(
			'name' => 'permissions',
			'href' => '#',
			'text' => elgg_echo('admin:roles:permissions'),
			'context' => 'admin',
			'section' => 'roles'
		));

		$selectable_roles = roles_get_all_selectable_roles();

		foreach ($selectable_roles as $role) {

			elgg_register_menu_item('page', array(
				'name' => "roles:users:{$role->name}",
				'href' => "admin/roles/users?role=$role->name",
				'text' => elgg_echo('admin:roles:users:role', array($role->getDisplayName())),
				'context' => 'admin',
				'parent_name' => 'users',
				'section' => 'administer'
			));
		}

		$roles = roles_get_all_roles();

		foreach ($roles as $role) {

			elgg_register_menu_item('page', array(
				'name' => "roles:permissions:{$role->name}",
				'href' => "admin/roles/permissions?role=$role->name",
				'text' => elgg_echo($role->title),
				'context' => 'admin',
				'parent_name' => 'permissions',
				'section' => 'roles'
			));
		}
	}

	return;
}
