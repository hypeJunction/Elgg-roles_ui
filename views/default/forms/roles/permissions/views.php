<?php

namespace Elgg\Roles\UI;

$name = elgg_extract('name', $vars, false);
if (!elgg_view_exists($name)) {
	$name .= elgg_view('admin/roles/warnings/views');
}
$details = elgg_extract('details', $vars);
$actionable = elgg_extract('actionable', $vars, true);

$rule = elgg_extract('rule', $details);

switch ($rule) {
	default :
	case 'allow' :
	case 'deny' :
		break;

	case 'extend' :
		$extension = elgg_extract('view_extension', $details);
		$view = $extension['view'];
		if (!elgg_view_exists($view)) {
			$view .= elgg_view('admin/roles/warnings/views');
		}
		$opts = '<div class="option">' . elgg_echo('roles_ui:permissions:view_extension') . '<strong>' . $view . '</strong></div>';
		$opts .= '<div class="option">' . elgg_echo('roles_ui:permissions:priority') . '<strong>' . $extension['priority'] . '</strong></div>';
		break;

	case 'replace' :
		$replacement = elgg_extract('view_replacement', $details);
		$opts = '<div class="option">' . elgg_echo('roles_ui:permissions:location') . '<strong>' . $replacement['location'] . '</strong></div>';
		break;
}


if ($actionable) {
	$form = elgg_view('forms/roles/templates/views', $vars);
	$actions = elgg_view_icon('delete', 'roles-ui-rule-remove');
}

$html = <<<__HTML
<div class="roles-ui-permission">
	$form
	<div class="roles-ui-rule-perm-type roles-ui-rule-perm-type-views"><span>views</span></div>
	<div class="roles-ui-rule-name">$name</div>
	<div class="roles-ui-rule roles-ui-rule-$rule">$rule</div>
	<div class="roles-ui-rule-options roles-ui-rule-options-$rule">$opts</div>
	<div class="roles-ui-rule-actions">$actions</div>
</div>
__HTML;

echo $html;



