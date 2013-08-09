<?php

$path = elgg_get_plugins_path() . 'roles_ui/actions/';

elgg_register_action('roles/edit', $path . 'edit.php', 'admin');
elgg_register_action('roles/permissions', $path . 'permissions.php', 'admin');