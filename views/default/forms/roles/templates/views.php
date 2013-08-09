<?php

$pname = elgg_extract('name', $vars, false);
$details = elgg_extract('details', $vars);
$prule = elgg_extract('rule', $details);

$name = elgg_view('input/text', array(
	'name' => 'views[name][]',
	'class' => 'roles-ui-autocomplete-views',
	'value' => $pname
		));

$rules = array('allow', 'deny', 'extend', 'replace');

$rule = elgg_view('input/dropdown', array(
	'name' => 'views[rule][]',
	'options' => $rules,
	'class' => 'roles-ui-form-rule-select',
	'value' => $prule,
	
		));


// EXTEND VIEW
$opts .= '<div class="roles-ui-form-rule-options-parts hidden" rel="extend">';

$extension = elgg_extract('view_extension', $details);
$view = elgg_view('input/text', array(
	'name' => 'views[opts][view][]',
	'class' => 'roles-ui-autocomplete-views',
	'value' => $extension['view'],
	
		));
$priority = elgg_view('input/text', array(
	'name' => 'views[opts][priority][]',
	'value' => $extension['priority']
		));

$opts .= '<div class="option">' . elgg_echo('roles:ui:permissions:view_extension') . '<strong>' . $view . '</strong></div>';
$opts .= '<div class="option">' . elgg_echo('roles:ui:permissions:priority') . '<strong>' . $priority . '</strong></div>';

$opts .= '</div>';

// REPLACE VIEW

$opts .= '<div class="roles-ui-form-rule-options-parts hidden" rel="replace">';

$replacement = elgg_extract('view_replacement', $details);
$location = elgg_view('input/text', array(
	'name' => 'views[opts][location][]',
	'value' => $extension['priority']
		));
$opts .= '<div class="option">' . elgg_echo('roles:ui:permissions:location') . '<strong>' . $location . '</strong></div>';

$opts .= '</div>';


$actions = elgg_view_icon('delete', 'roles-ui-form-rule-remove');

if (!$pname) {
	$template = 'class="roles-ui-permission roles-ui-form hidden" data-tmpl="views"';
} else {
	$template = 'class="hidden"';
}
$html = <<<__HTML
<div $template>
	<div class="roles-ui-rule-perm-type roles-ui-rule-perm-type-views"><span>views</span></div>
	<div class="roles-ui-rule-name">$name</div>
	<div class="roles-ui-rule">$rule</div>
	<div class="roles-ui-rule-options">$opts</div>
	<div class="roles-ui-rule-actions">$actions</div>
</div>
__HTML;

echo $html;



