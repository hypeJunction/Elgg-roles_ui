<?php

$name = elgg_extract('name', $vars, false);
if (!elgg_action_exists($name)) {
	$name .= elgg_view('admin/roles/warnings/actions');
}
$details = elgg_extract('details', $vars);
$actionable = elgg_extract('actionable', $vars, true);

$rule = elgg_extract('rule', $details);

if ($actionable) {
	$form = elgg_view('forms/roles/templates/actions', $vars);
	$actions = elgg_view_icon('delete', 'roles-ui-rule-remove');
}

$html = <<<__HTML
<div class="roles-ui-permission">
	$form
	<div class="roles-ui-rule-perm-type roles-ui-rule-perm-type-actions"><span>actions</span></div>
	<div class="roles-ui-rule-name">$name</div>
	<div class="roles-ui-rule roles-ui-rule-$rule">$rule</div>
	<div class="roles-ui-rule-options roles-ui-rule-options-$rule">$opts</div>
	<div class="roles-ui-rule-actions">$actions</div>
</div>
__HTML;

echo $html;



