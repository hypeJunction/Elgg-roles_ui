<?php

namespace Elgg\Roles\UI;

$guid = get_input('guid');
$role = get_entity($guid);

$permissions = array();

$views = get_input('views', false, false);

if ($views) {
	for ($i = 0; $i < count($views['name']); $i++) {
		$name = $views['name'][$i];
		if (!$name) {
			continue;
		}

		$rule = $views['rule'][$i];

		$options = array('rule' => $rule);

		switch ($rule) {
			case 'extend' :
				$options['view_extension']['view'] = $views['opts']['view'][$i];
				$options['view_extension']['priority'] = $views['opts']['priority'][$i];
				break;

			case 'replace' :
				$options['view_replacement']['location'] = $views['opts']['location'][$i];
				break;
		}

		$permissions['views'][$name] = $options;
	}
}

$actions = get_input('actions', false, false);

if ($actions) {
	for ($i = 0; $i < count($actions['name']); $i++) {
		$name = $actions['name'][$i];
		if (!$name) {
			continue;
		}

		$rule = $actions['rule'][$i];

		$options = array('rule' => $rule);

		$permissions['actions'][$name] = $options;
	}
}

$hooks = get_input('hooks', false, false);

if ($hooks) {
	for ($i = 0; $i < count($hooks['name']); $i++) {
		$name = $hooks['name'][$i];
		if (!$name) {
			continue;
		}

		$rule = $hooks['rule'][$i];

		$options = array('rule' => $rule);

		switch ($rule) {
			case 'deny' :
				$options['hook']['handler'] = $hooks['opts']['deny_handler'][$i];
				break;

			case 'extend' :
				$options['hook']['handler'] = $hooks['opts']['extend_handler'][$i];
				$options['hook']['priority'] = $hooks['opts']['extend_priority'][$i];
				break;

			case 'replace' :
				$options['hook']['old_handler'] = $hooks['opts']['old_handler'][$i];
				$options['hook']['new_handler'] = $hooks['opts']['new_handler'][$i];
				break;
		}

		$permissions['hooks'][$name] = $options;
	}
}


$events = get_input('events', false, false);

if ($events) {
	for ($i = 0; $i < count($events['name']); $i++) {
		$name = $events['name'][$i];
		if (!$name) {
			continue;
		}

		$rule = $events['rule'][$i];

		$options = array('rule' => $rule);

		switch ($rule) {
			case 'deny' :
				$options['event']['handler'] = $events['opts']['deny_handler'][$i];
				break;

			case 'extend' :
				$options['event']['handler'] = $events['opts']['extend_handler'][$i];
				$options['event']['priority'] = $events['opts']['extend_priority'][$i];
				break;

			case 'replace' :
				$options['event']['old_handler'] = $events['opts']['old_handler'][$i];
				$options['event']['new_handler'] = $events['opts']['new_handler'][$i];
				break;
		}

		$permissions['events'][$name] = $options;
	}
}

$pages = get_input('pages', false, false);

if ($pages) {
	for ($i = 0; $i < count($pages['name']); $i++) {
		$name = $pages['name'][$i];
		if (!$name) {
			continue;
		}

		$rule = $pages['rule'][$i];

		$options = array('rule' => $rule);

		switch ($rule) {
			case 'deny' :
				$options['forward'] = $pages['opts']['deny_forward'][$i];
				break;

			case 'redirect' :
				$options['forward'] = $pages['opts']['redirect_forward'][$i];
				break;
		}

		$permissions['pages'][$name] = $options;
	}
}


$menus = get_input('menus', false, false);

if ($menus) {
	for ($i = 0; $i < count($menus['name']); $i++) {
		$name = $menus['name'][$i];
		if (!$name) {
			continue;
		}

		$rule = $menus['rule'][$i];

		$options = array('rule' => $rule);

		switch ($rule) {
			case 'extend' :
				break;

			case 'replace' :
				break;
		}

		$permissions['menus'][$name] = $options;
	}
}

$role->setPermissions($permissions);

// Reset hash so that the cache is reindexed
elgg_set_plugin_setting('roles_hash', '', 'roles');

forward(REFERER);
