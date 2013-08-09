<?php

$role = roles_get_role_by_name(get_input('role', DEFAULT_ROLE));

echo elgg_view_form('roles/edit', array(), array(
	'entity' => $role
));