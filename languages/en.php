<?php

$english = array(

	'menu:page:header:roles' => 'Roles',

	'admin:roles' => 'Roles',
	'admin:roles:summary' => 'Summary',
	'admin:roles:create' => 'Add Role',
	'admin:roles:edit' => 'Edit Role',
	'admin:roles:permissions' => 'Permissions',
	'admin:roles:users' => 'Role: %s',
	
	'roles:ui:name' => 'Role name',
	'roles:ui:name:help' => 'Must be a unique role identifier, e.g. moderator',
	'roles:ui:title' => 'Title',
	'roles:ui:title:help' => 'Role title, e.g. Moderator',
	'roles:ui:config' => 'Configuration array',
	'roles:ui:permissions' => 'Permissions',
	'roles:ui:extends' => 'Extends',
	'roles:ui:extends:help' => 'Specify which other roles and in which order this role extends (if any). See Roles documentation for details',
	'roles:ui:extend_name' => 'Role to extend',
	'roles:ui:extend_order' => 'Order',

	'roles:ui:norole' => 'Role %s does not exist',
	
	'roles:ui:edit:error' => 'Could not create new role %s',
	'roles:ui:edit:duplicate' => 'Another role with name %s already exists',
	'roles:ui:edit:success' => 'Role \'%s\' has been successfully updated',

	'roles:ui:add:actions' => '+ Action Rule',
	'roles:ui:add:menus' => '+ Menu Rule',
	'roles:ui:add:views' => '+ Views Rule',
	'roles:ui:add:hooks' => '+ Hook Rule',
	'roles:ui:add:events' => '+ Event Rule',
	'roles:ui:add:pages' => '+ Page Rule',

	'roles:ui:permissions:view_extension' => 'Extension',
	'roles:ui:permissions:location' => 'Location',
	'roles:ui:permissions:priority' => 'Priority',
	'roles:ui:permissions:handler' => 'Handler',
	'roles:ui:permissions:old_handler' => 'Old handler',
	'roles:ui:permissions:new_handler' => 'New handler',
	'roles:ui:permissions:forward' => 'Forward',

	'roles:ui:warning:views' => 'View does not exist',
	'roles:ui:warning:actions' => 'Action is not registered',
	'roles:ui:warning:callback' => 'Callback function is not callable',


);

add_translation("en", $english);
