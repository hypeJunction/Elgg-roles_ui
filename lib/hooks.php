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

	elgg_load_css('lightbox');
	elgg_load_js('lightbox');

	$menu[] = \ElggMenuItem::factory(array(
				'name' => 'roles:set',
				'text' => elgg_echo('roles_ui:set:role', array($role->getDisplayName())),
				'href' => 'ajax/view/roles/ajax/set?guid=' . $user->guid,
				'data-guid' => $user->guid,
				'section' => 'admin',
				'link_class' => 'elgg-lightbox',
				'data-colorbox-opts' => json_encode(array('width' => '600px')),
	));

	return $menu;
}

/**
 * Setup role entity menu
 * 
 * @param string          $hook   "register"
 * @param string          $type   "menu:entity"
 * @param \ElggMenuItem[] $return Menu
 * @param array           $params Hook params
 * @return \ElggMenuItem[]
 */
function entity_menu_setup($hook, $type, $return, $params) {

	$entity = elgg_extract('entity', $params);

	if (!$entity instanceof \ElggRole) {
		return;
	}

	$return = array();

	if (!$entity->isReservedRole() && $entity->canDelete()) {
		$return[] = \ElggMenuItem::factory(array(
					'name' => 'delete',
					'text' => elgg_view_icon('delete'),
					'href' => "action/roles/delete?guid=$entity->guid",
					'confirm' => true,
					'is_action' => true,
		));
	}

	return $return;
}
