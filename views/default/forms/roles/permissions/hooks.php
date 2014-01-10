<?php

namespace Elgg\Roles\UI;

$name = elgg_extract('name', $vars, false);
$details = elgg_extract('details', $vars);
$actionable = elgg_extract('actionable', $vars, true);

$rule = elgg_extract('rule', $details);

$hook = elgg_extract('hook', $details);

switch ($rule) {

	case 'deny' :
		$handler = elgg_extract('handler', $hook);
		if (!$handler) {
			$handler = 'ALL';
		} else if (!is_callable($handler)) {
			$handler .= elgg_view('admin/roles/warnings/callback');
		}
		$opts = '<div class="option">' . elgg_echo(PLUGIN_ID . ':permissions:handler') . '<strong>' . $handler . '</strong></div>';
		break;

	case 'extend' :
		$handler = elgg_extract('handler', $hook);
		if (!is_callable($handler)) {
			$handler .= elgg_view('admin/roles/warnings/callback');
		}
		$opts = '<div class="option">' . elgg_echo(PLUGIN_ID . ':permissions:handler') . '<strong>' . $handler . '</strong></div>';
		$opts .= '<div class="option">' . elgg_echo(PLUGIN_ID . ':permissions:priority') . '<strong>' . $hook['priority'] . '</strong></div>';
		break;

	case 'replace' :
		$old_handler = elgg_extract('old_handler', $hook);
		if (!is_callable($old_handler)) {
			$old_handler .= elgg_view('admin/roles/warnings/callback');
		}
		$new_handler = elgg_extract('new_handler', $hook);
		if (!is_callable($new_handler)) {
			$new_handler .= elgg_view('admin/roles/warnings/callback');
		}
		$opts = '<div class="option">' . elgg_echo(PLUGIN_ID . ':permissions:old_handler') . '<strong>' . $old_handler . '</strong></div>';
		$opts .= '<div class="option">' . elgg_echo(PLUGIN_ID . ':permissions:new_handler') . '<strong>' . $new_handler . '</strong></div>';
		break;
}


if ($actionable) {
	$form = elgg_view('forms/roles/templates/hooks', $vars);
	$actions = elgg_view_icon('delete', 'roles-ui-rule-remove');
}

$html = <<<__HTML
<div class="roles-ui-permission">
	$form
	<div class="roles-ui-rule-perm-type roles-ui-rule-perm-type-hooks"><span>hooks</span></div>
	<div class="roles-ui-rule-name">$name</div>
	<div class="roles-ui-rule roles-ui-rule-$rule">$rule</div>
	<div class="roles-ui-rule-options roles-ui-rule-options-$rule">$opts</div>
	<div class="roles-ui-rule-actions">$actions</div>
</div>
__HTML;

echo $html;



