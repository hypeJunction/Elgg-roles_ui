<?php

$pname = elgg_extract('name', $vars, false);
$details = elgg_extract('details', $vars);
$prule = elgg_extract('rule', $details);

$name = elgg_view('input/text', array(
	'name' => 'events[name][]',
	'class' => 'roles-ui-autocomplete-events',
	'value' => $pname
		));

$rules = array('allow', 'deny', 'extend', 'replace');

$rule = elgg_view('input/dropdown', array(
	'name' => 'events[rule][]',
	'options' => $rules,
	'class' => 'roles-ui-form-rule-select',
	'value' => $prule,
	
		));

$event = elgg_extract('event', $details);

// DENY event
$opts .= '<div class="roles-ui-form-rule-options-parts hidden" rel="deny">';

$handler = elgg_view('input/text', array(
	'name' => 'events[opts][deny_handler][]',
	'class' => 'roles-ui-autocomplete-event-handlers',
	'value' => $event['handler'],
		));

$opts .= '<div class="option">' . elgg_echo('roles:ui:permissions:handler') . '<strong>' . $handler . '</strong></div>';

$opts .= '</div>';

// EXTEND event
$opts .= '<div class="roles-ui-form-rule-options-parts hidden" rel="extend">';

$handler = elgg_view('input/text', array(
	'name' => 'events[opts][extend_handler][]',
	'value' => $event['handler'],
	
		));
$priority = elgg_view('input/text', array(
	'name' => 'events[opts][extend_priority][]',
	'value' => $event['priority']
		));

$opts .= '<div class="option">' . elgg_echo('roles:ui:permissions:handler') . '<strong>' . $handler . '</strong></div>';
$opts .= '<div class="option">' . elgg_echo('roles:ui:permissions:priority') . '<strong>' . $priority . '</strong></div>';

$opts .= '</div>';

// REPLACE event

$opts .= '<div class="roles-ui-form-rule-options-parts hidden" rel="replace">';

$old_handler = elgg_view('input/text', array(
	'name' => 'events[opts][old_handler][]',
	'class' => 'roles-ui-autocomplete-event-handlers',
	'value' => $event['old_handler'],
		));
$new_handler = elgg_view('input/text', array(
	'name' => 'events[opts][new_handler][]',
	'value' => $event['new_handler'],
		));

$opts .= '<div class="option">' . elgg_echo('roles:ui:permissions:old_handler') . '<strong>' . $old_handler . '</strong></div>';
$opts .= '<div class="option">' . elgg_echo('roles:ui:permissions:new_handler') . '<strong>' . $new_handler . '</strong></div>';

$opts .= '</div>';


$actions = elgg_view_icon('delete', 'roles-ui-form-rule-remove');

if (!$pname) {
	$template = 'class="roles-ui-permission roles-ui-form hidden" data-tmpl="events"';
} else {
	$template = 'class="hidden"';
}
$html = <<<__HTML
<div $template>
	<div class="roles-ui-rule-perm-type roles-ui-rule-perm-type-events"><span>events</span></div>
	<div class="roles-ui-rule-name">$name</div>
	<div class="roles-ui-rule">$rule</div>
	<div class="roles-ui-rule-options">$opts</div>
	<div class="roles-ui-rule-actions">$actions</div>
</div>
__HTML;

echo $html;



