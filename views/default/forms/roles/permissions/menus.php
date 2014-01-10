<?php

namespace Elgg\Roles\UI;

$name = elgg_extract('name', $vars, false);
$details = elgg_extract('details', $vars);
$actionable = elgg_extract('actionable', $vars, true);

$rule = elgg_extract('rule', $details);

switch ($rule) {
	default :
	case 'allow' :
	case 'deny' :
		break;

	case 'replace' :
		$opts = '';
		break;

	case 'extend' :
		$opts = '';
		break;
}


if ($actionable) {
	$form = elgg_view('forms/roles/templates/menus', $vars);
	$actions = elgg_view_icon('delete', 'roles-ui-rule-remove');
}

$html = <<<__HTML
<div class="roles-ui-permission">
	$form
	<div class="roles-ui-rule-perm-type roles-ui-rule-perm-type-menus"><span>menus</span></div>
	<div class="roles-ui-rule-name">$name</div>
	<div class="roles-ui-rule roles-ui-rule-$rule">$rule</div>
	<div class="roles-ui-rule-options roles-ui-rule-options-$rule">$opts</div>
	<div class="roles-ui-rule-actions">$actions</div>
</div>
__HTML;

echo $html;



