<?php

$pname = elgg_extract('name', $vars, false);
$details = elgg_extract('details', $vars);
$prule = elgg_extract('rule', $details);

$name = elgg_view('input/text', array(
	'name' => 'actions[name][]',
	'class' => 'roles-ui-autocomplete-actions',
	'value' => $pname
		));

$rules = array('allow', 'deny');

$rule = elgg_view('input/dropdown', array(
	'name' => 'actions[rule][]',
	'options' => $rules,
	'class' => 'roles-ui-form-rule-select',
	'value' => $prule,
	
		));

$actions = elgg_view_icon('delete', 'roles-ui-rule-remove');

if (!$pname) {
	$template = 'class="roles-ui-permission roles-ui-form hidden" data-tmpl="actions"';
} else {
	$template = 'class="hidden"';
}
$html = <<<__HTML
<div $template>
	<div class="roles-ui-rule-perm-type roles-ui-rule-perm-type-actions"><span>actions</span></div>
	<div class="roles-ui-rule-name">$name</div>
	<div class="roles-ui-rule">$rule</div>
	<div class="roles-ui-rule-options">$opts</div>
	<div class="roles-ui-rule-actions">$actions</div>
</div>
__HTML;

echo $html;



