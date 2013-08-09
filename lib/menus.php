<?php

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

$roles = roles_get_all_roles();

foreach ($roles as $role) {

	if ($role->name !== VISITOR_ROLE) {
		elgg_register_menu_item('page', array(
			'name' => "roles:users:{$role->name}",
			'href' => "admin/roles/users?role=$role->name",
			'text' => elgg_echo('admin:roles:users', array(elgg_echo($role->title))),
			'context' => 'admin',
			'parent_name' => 'users',
			'section' => 'administer'
		));
	}

	elgg_register_menu_item('page', array(
		'name' => "roles:permissions:{$role->name}",
		'href' => "admin/roles/permissions?role=$role->name",
		'text' => elgg_echo($role->title),
		'context' => 'admin',
		'parent_name' => 'permissions',
		'section' => 'roles'
	));
}