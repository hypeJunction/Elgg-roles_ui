<?php

namespace Elgg\Roles\UI;

// VIEWS FOR AUTOCOMPLETE
$views = elgg_view_tree('', '');
foreach ($views as $view) {
	$views_config[] = trim($view, '/');
}


// HOOKS FOR AUTOCOMPLETE
$hooks = elgg_get_config('hooks');
if (!array_key_exists('all', $hooks)) {
	$hooks['all'] = array();
}
foreach ($hooks as $name => $params) {
	if (!array_key_exists('all', $params)) {
		$params['all'] = array();
	}
	foreach ($params as $type => $handlers) {
		$hooks_config[] = "$name::$type";
		$hook_handlers_config["$name::$type"] = array_values($handlers);
		$menu_type = explode(':', $type);
		if ($menu_type[0] == 'menu') {
			unset($menu_type[0]);
			$registered_menu_hooks[] = implode(':', $menu_type);
		}
	}
}
sort($hooks_config);


// EVENTS FOR AUTOCOMPLETE
$events = elgg_get_config('events');
if (!array_key_exists('all', $events)) {
	$events['all'] = array();
}
foreach ($events as $name => $params) {
	if (!array_key_exists('all', $params)) {
		$params['all'] = array();
	}
	foreach ($params as $type => $handlers) {
		$events_config[] = "$name::$type";
		$event_handlers_config["$name::$type"] = array_values($handlers);
	}
}
sort($events_config);


// ACTIONS FOR AUTOCOMPLETE
$actions = elgg_get_config('actions');
foreach ($actions as $name => $settings) {
	$actions_config[] = $name;
}
sort($actions_config);


// MENUS FOR AUTOCOMPLETE
$registered_menus = elgg_get_config('menus');
$entities = elgg_get_entities(array(
	'group_by' => 'e.subtype',
	'limit' => 0
		));

$contextbackup = elgg_get_config('context');
$pages = elgg_get_config('pagehandler');
foreach ($pages as $context => $callback) {
	elgg_push_context($context);
}

/**
 * @todo:  clean up this code and add logic for river, annotations menus
 */
foreach ($entities as $entity) {
	$menus = $registered_menus;
	$unregistered_menus[] = 'title';
	$unregistered_menus[] = 'entity';
	$unregistered_menus = array_merge($unregistered_menus, $registered_menu_hooks);
	foreach ($unregistered_menus as $m) {
		if (!array_key_exists($m, $menus)) {
			if (!elgg_instanceof($entity, 'user') && !elgg_instanceof($entity, 'group') && in_array($m, array('user_hover'))) {
				continue;
			}
			if ($m == 'river')
				continue;
			if ($m == 'widget' && !elgg_instanceof($entity, 'object', 'widget'))
				continue;
			$menus[$m] = array();
		}
	}

	foreach ($menus as $menu_name => $items) {
		$menus_config[$menu_name] = array();
		if (!is_array($items)) {
			$items = array();
		}

		$fake_params = array(
			'handler' => $entity->getSubtype(),
			'entity' => $entity
		);

		$menu = elgg_trigger_plugin_hook('register', "menu:$menu_name", $fake_params, $items);

		foreach ($menu as $item) {
			if ($item instanceof \ElggMenuItem) {
				$menus_config[$menu_name][] = $item->getName();
			}
		}
	}
}
$menus_config[$menu_name] = array_unique($menus_config[$menu_name]);

foreach ($menus_config as $menu_name => $items) {
	//$menus_config_merged[] = $menu_name;
	foreach ($items as $item) {
		$menus_config_merged[] = "$menu_name::$item";
	}
}
sort($menus_config_merged);
elgg_set_config('context', $contextbackup);

$conf = array(
	'views' => $view_config,
	'actions' => $actions_config,
	'hooks' => $hooks_config,
	'hook_handlers' => $hook_handlers_config,
	'events' => $events_config,
	'event_handlers' => $event_handlers_config,
	'menus_config' => $menus_config_merged,
);
?>
//<script>
define(function() {
	return <?php echo json_encode($conf) ?>;
});
