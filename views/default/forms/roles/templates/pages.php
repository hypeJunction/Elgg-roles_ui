<?php

$pname = elgg_extract('name', $vars, false);
$details = elgg_extract('details', $vars);
$prule = elgg_extract('rule', $details);

$name = elgg_view('input/text', array(
	'name' => 'pages[name][]',
	'class' => 'roles-ui-autocomplete-pages',
	'value' => $pname
		));

$rules = array('allow', 'deny', 'redirect');

$rule = elgg_view('input/dropdown', array(
	'name' => 'pages[rule][]',
	'options' => $rules,
	'class' => 'roles-ui-form-rule-select',
	'value' => $prule,
	
		));

$forward_url = elgg_extract('forward', $details);

// DENY PAGE
$opts .= '<div class="roles-ui-form-rule-options-parts hidden" rel="deny">';

$forward = elgg_view('input/text', array(
	'name' => 'pages[opts][deny_forward][]',
	'value' => $forward_url,
		));

$opts .= '<div class="option">' . elgg_echo('roles:ui:permissions:forward') . '<strong>' . $forward . '</strong></div>';

$opts .= '</div>';

// REDIRECT PAGE
$opts .= '<div class="roles-ui-form-rule-options-parts hidden" rel="redirect">';

$forward = elgg_view('input/text', array(
	'name' => 'pages[opts][redirect_forward][]',
	'value' => $forward_url,
		));

$opts .= '<div class="option">' . elgg_echo('roles:ui:permissions:forward') . '<strong>' . $forward . '</strong></div>';

$opts .= '</div>';


$actions = elgg_view_icon('delete', 'roles-ui-form-rule-remove');

if (!$pname) {
	$template = 'class="roles-ui-permission roles-ui-form hidden" data-tmpl="pages"';
} else {
	$template = 'class="hidden"';
}
$html = <<<__HTML
<div $template>
	<div class="roles-ui-rule-perm-type roles-ui-rule-perm-type-pages"><span>pages</span></div>
	<div class="roles-ui-rule-name">$name</div>
	<div class="roles-ui-rule">$rule</div>
	<div class="roles-ui-rule-options">$opts</div>
	<div class="roles-ui-rule-actions">$actions</div>
</div>
__HTML;

echo $html;



