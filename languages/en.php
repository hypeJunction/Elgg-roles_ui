<?php

$english = array(

	'menu:page:header:roles' => 'Roles',

	'admin:roles' => 'Roles',
	'admin:roles:summary' => 'Summary',
	'admin:roles:create' => 'Add Role',
	'admin:roles:edit' => 'Edit Role',
	'admin:roles:permissions' => 'Permissions',
	'admin:roles:users' => 'User by role',
	'admin:roles:users:role' => 'Role: %s',

	'roles_ui:plugin_dependancy_error' => 'Roles plugin is not active. Roles UI will be deactivated',

	'roles_ui:name' => 'Role name',
	'roles_ui:name:help' => 'Must be a unique role identifier, e.g. moderator',
	'roles_ui:title' => 'Title',
	'roles_ui:title:help' => 'Role title, e.g. Moderator',
	'roles_ui:config' => 'Configuration array',
	'roles_ui:permissions' => 'Permissions',
	'roles_ui:extends' => 'Extends',
	'roles_ui:extends:help' => 'Specify which other roles and in which order this role extends (if any). See Roles documentation for details',
	'roles_ui:extend_name' => 'Role to extend',
	'roles_ui:extend_order' => 'Order',

	'roles_ui:norole' => 'Role %s does not exist',
	
	'roles_ui:edit:error' => 'Could not create new role %s',
	'roles_ui:edit:duplicate' => 'Another role with name %s already exists',
	'roles_ui:edit:success' => 'Role \'%s\' has been successfully updated',

	'roles_ui:add:actions' => '+ Action Rule',
	'roles_ui:add:menus' => '+ Menu Rule',
	'roles_ui:add:views' => '+ Views Rule',
	'roles_ui:add:hooks' => '+ Hook Rule',
	'roles_ui:add:events' => '+ Event Rule',
	'roles_ui:add:pages' => '+ Page Rule',

	'roles_ui:permissions:view_extension' => 'Extension',
	'roles_ui:permissions:location' => 'Location',
	'roles_ui:permissions:priority' => 'Priority',
	'roles_ui:permissions:handler' => 'Handler',
	'roles_ui:permissions:old_handler' => 'Old handler',
	'roles_ui:permissions:new_handler' => 'New handler',
	'roles_ui:permissions:forward' => 'Forward',

	'roles_ui:warning:views' => 'View does not exist',
	'roles_ui:warning:actions' => 'Action is not registered',
	'roles_ui:warning:callback' => 'Callback function is not callable',

	'roles_ui:users:in_role' => 'Users in %s role',
	'roles_ui:users:none' => 'No users in %s role',

	'roles_ui:set:role' => 'Change role [%s]',
	'roles_ui:set:success' => 'New role has been assigned successfully',
	'roles_ui:set:error:no_user' => 'Not a valid user',
	'roles_ui:set:error:no_role' => 'Not a valid role',
	'roles_ui:set:error:equivalent_role' => 'Role you are trying to assign is the current user role',
	'roles_ui:set:error:admin_gatekeeper' => 'Only administrators are allowed to change user roles',
	'roles_ui:set:error:unknown' => 'An unknown has occurred while trying to set the role',

	'roles:no_selecatable_roles' => 'There are no configured roles',
	'user:set:roles' => 'Select one or more roles to assign to this user',
	'user:set:roles:help' => 'You can order roles by priority to ensure that conflicting '
	. 'role permissions are resolved correctly. Roles with higher priority (on top of the list) '
	. 'will take precedence over roles with lower priority (bottom of the list)',

);

add_translation("en", $english);
