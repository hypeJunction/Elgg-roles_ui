<?php

namespace hypeJunction\Roles\Ui;

use ElggMenuItem;

class Menus {

	/**
	 * Setup menu
	 *
	 * @param string          $hook   "register"
	 * @param string          $type   "menu:page"
	 * @param ElggMenuItem[] $return Menu
	 * @param array           $params Hook params
	 *
	 * @return ElggMenuItem[]
	 */
	public static function setupPageMenu($hook, $type, $return, $params) {

		$return[] = ElggMenuItem::factory([
			'name' => 'summary',
			'href' => 'admin/roles/summary',
			'text' => elgg_echo('admin:roles:summary'),
			'context' => 'admin',
			'section' => 'roles'
		]);

		$return[] = ElggMenuItem::factory([
			'name' => 'create',
			'href' => 'admin/roles/create',
			'text' => elgg_echo('admin:roles:create'),
			'context' => 'admin',
			'section' => 'roles'
		]);

		$return[] = ElggMenuItem::factory([
			'name' => 'permissions',
			'href' => '#',
			'text' => elgg_echo('admin:roles:permissions'),
			'context' => 'admin',
			'section' => 'roles'
		]);

		$selectable_roles = roles_get_all_selectable_roles();

		foreach ($selectable_roles as $role) {
			$return[] = ElggMenuItem::factory([
				'name' => "roles:users:{$role->name}",
				'href' => "admin/roles/users?role=$role->name",
				'text' => elgg_echo('admin:roles:users:role', [$role->getDisplayName()]),
				'context' => 'admin',
				'parent_name' => 'users',
				'section' => 'administer'
			]);
		}

		$roles = roles_get_all_roles();

		foreach ($roles as $role) {
			$return[] = ElggMenuItem::factory([
				'name' => "roles:permissions:{$role->name}",
				'href' => "admin/roles/permissions?role=$role->name",
				'text' => elgg_echo($role->title),
				'context' => 'admin',
				'parent_name' => 'permissions',
				'section' => 'roles'
			]);
		}

		return $return;
	}

	/**
	 * Add a menu item to the user hover menu to allow admins to easily change role
	 *
	 * @param string $hook   Equals 'register'
	 * @param string $type   Equals 'menu:user_hover'
	 * @param array  $menu   Current menu
	 * @param array  $params Addiitonal params
	 *
	 * @return array    Updated menu
	 */
	public static function setupUserHoverMenu($hook, $type, $menu, $params) {

		$user = elgg_extract('entity', $params);

		if (!elgg_instanceof($user, 'user') || $user->isAdmin()) {
			return $menu;
		}

		if (!elgg_is_admin_logged_in()) {
			return $menu;
		}

		$role = roles_get_role($user);

		elgg_load_css('lightbox');
		elgg_load_js('lightbox');

		$menu[] = ElggMenuItem::factory([
			'name' => 'roles:set',
			'text' => elgg_echo('roles_ui:set:role', [$role->getDisplayName()]),
			'href' => 'ajax/view/roles/ajax/set?guid=' . $user->guid,
			'data-guid' => $user->guid,
			'section' => 'admin',
			'link_class' => 'elgg-lightbox',
			'data-colorbox-opts' => json_encode(['width' => '600px']),
		]);

		return $menu;
	}

	/**
	 * Setup role entity menu
	 *
	 * @param string          $hook   "register"
	 * @param string          $type   "menu:entity"
	 * @param ElggMenuItem[] $return Menu
	 * @param array           $params Hook params
	 *
	 * @return ElggMenuItem[]
	 */
	public static function setupEntityMenu($hook, $type, $return, $params) {

		$entity = elgg_extract('entity', $params);

		if (!$entity instanceof \ElggRole) {
			return;
		}

		$return = [];

		if (!$entity->isReservedRole() && $entity->canDelete()) {
			$return[] = ElggMenuItem::factory([
				'name' => 'delete',
				'text' => elgg_view_icon('delete'),
				'href' => "action/roles/delete?guid=$entity->guid",
				'confirm' => true,
				'is_action' => true,
			]);
		}

		return $return;
	}
}