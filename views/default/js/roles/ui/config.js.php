<?php

namespace Elgg\Roles\UI;

$inspector = new \Elgg\Debug\Inspector();

$views_config = $inspector->getViews();
$views = array_keys(elgg_extract('views', $views_config, array()));
sort($views);

$actions_config = $inspector->getActions();
$actions = array_keys($actions_config);
sort($actions);

$hooks = array();
$hook_types = array();
$hook_handlers = array();
$hooks_config = $inspector->getPluginHooks();
foreach ($hooks_config as $hook => $handlers) {
	list($hook_type, $hook_name) = explode(',', $hook);
	$hooks[$hook_type][$hook_name] = $handlers;
}
if (!array_key_exists('all', $hooks)) {
	$hooks['all'] = array();
}
foreach ($hooks as $name => $params) {
	if (!array_key_exists('all', $params)) {
		$params['all'] = array();
	}
	foreach ($params as $type => $handlers) {
		$hook_types[] = "$name::$type";
		foreach ($handlers as $handler) {
			list($priority, $callback) = explode(': ', $handler, 2);
			$event_handlers["$name::$type"][] = $callback;
		}
	}
}
sort($hook_types);
ksort($hook_handlers);

$events = array();
$event_types = array();
$event_handlers = array();
$events_config = $inspector->getEvents();
foreach ($events_config as $event => $handlers) {
	list($event_type, $event_name) = explode(',', $event);
	$events[$event_type][$event_name] = $handlers;
}
if (!array_key_exists('all', $events)) {
	$events['all'] = array();
}
foreach ($events as $name => $params) {
	if (!array_key_exists('all', $params)) {
		$params['all'] = array();
	}
	foreach ($params as $type => $handlers) {
		$event_types[] = "$name::$type";
		foreach ($handlers as $handler) {
			list($priority, $callback) = explode(': ', $handler, 2);
			$event_handlers["$name::$type"][] = $callback;
		}
	}
}
sort($event_types);
ksort($event_handlers);

$menus = array();
$menus_config = $inspector->getMenus();
foreach ($menus_config as $menu_name => $menu_items) {
	foreach ($menu_items as $menu_item_name => $menu_item_opts) {
		$menus[] = "{$menu_name}::{$menu_item_name}";
	}
}

$conf = array(
	'views' => $views,
	'actions' => $actions,
	'hooks' => $hook_types,
	'hook_handlers' => $hook_handlers,
	'events' => $event_types,
	'event_handlers' => $event_handlers,
	'menus' => $menus,
);
?>
//<script>
define(function() {
	return <?php echo json_encode($conf) ?>;
});
