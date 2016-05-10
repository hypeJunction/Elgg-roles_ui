<?php

$guid = get_input('guid');
$role = get_entity($guid);

if (!$role instanceof ElggRole || $role->isReservedRole() || !$role->canDelete()) {
	register_error(elgg_echo('actionunauthorized'));
	forward(REFERRER);
}

if ($role->delete()) {
	system_message(elgg_echo('roles_ui:delete:success'));
} else {
	register_error(elgg_echo('roles_ui:delete:error'));
}