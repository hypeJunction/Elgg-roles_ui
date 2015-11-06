<?php

namespace Elgg\Roles\UI;

$pname = elgg_extract('name', $vars, false);
$details = elgg_extract('details', $vars);
$prule = elgg_extract('rule', $details);

$name = elgg_view('input/text', array(
	'name' => 'hooks[name][]',
	'class' => 'roles-ui-autocomplete-hooks',
	'value' => $pname
		));

$rules = array('allow', 'deny', 'extend', 'replace');

$rule = elgg_view('input/dropdown', array(
	'name' => 'hooks[rule][]',
	'options' => $rules,
	'class' => 'roles-ui-form-rule-select',
	'value' => $prule,
	
		));

$hook = elgg_extract('hook', $details);

// DENY HOOK
$opts .= '<div class="roles-ui-form-rule-options-parts hidden" rel="deny">';

$handler = elgg_view('input/text', array(
	'name' => 'hooks[opts][deny_handler][]',
	'class' => 'roles-ui-autocomplete-hook-handlers',
	'value' => $hook['handler'],
		));

$opts .= '<div class="option">' . elgg_echo('roles_ui:permissions:handler') . '<strong>' . $handler . '</strong></div>';

$opts .= '</div>';

// EXTEND HOOK
$opts .= '<div class="roles-ui-form-rule-options-parts hidden" rel="extend">';

$handler = elgg_view('input/text', array(
	'name' => 'hooks[opts][extend_handler][]',
	'value' => $hook['handler'],
	
		));
$priority = elgg_view('input/text', array(
	'name' => 'hooks[opts][extend_priority][]',
	'value' => $hook['priority']
		));

$opts .= '<div class="option">' . elgg_echo('roles_ui:permissions:handler') . '<strong>' . $handler . '</strong></div>';
$opts .= '<div class="option">' . elgg_echo('roles_ui:permissions:priority') . '<strong>' . $priority . '</strong></div>';

$opts .= '</div>';

// REPLACE HOOK

$opts .= '<div class="roles-ui-form-rule-options-parts hidden" rel="replace">';

$old_handler = elgg_view('input/text', array(
	'name' => 'hooks[opts][old_handler][]',
	'class' => 'roles-ui-autocomplete-hook-handlers',
	'value' => $hook['old_handler'],
		));
$new_handler = elgg_view('input/text', array(
	'name' => 'hooks[opts][new_handler][]',
	'value' => $hook['new_handler'],
		));

$opts .= '<div class="option">' . elgg_echo('roles_ui:permissions:old_handler') . '<strong>' . $old_handler . '</strong></div>';
$opts .= '<div class="option">' . elgg_echo('roles_ui:permissions:new_handler') . '<strong>' . $new_handler . '</strong></div>';

$opts .= '</div>';


$actions = elgg_view_icon('delete', 'roles-ui-form-rule-remove');

if (!$pname) {
	$template = 'class="roles-ui-permission roles-ui-form hidden" data-tmpl="hooks"';
} else {
	$template = 'class="hidden"';
}
$html = <<<__HTML
<div $template>
	<div class="roles-ui-rule-perm-type roles-ui-rule-perm-type-hooks"><span>hooks</span></div>
	<div class="roles-ui-rule-name">$name</div>
	<div class="roles-ui-rule">$rule</div>
	<div class="roles-ui-rule-options">$opts</div>
	<div class="roles-ui-rule-actions">$actions</div>
</div>
__HTML;

echo $html;



