<?php

namespace Elgg\Roles\UI;

$pname = elgg_extract('name', $vars, false);
$details = elgg_extract('details', $vars);
$prule = elgg_extract('rule', $details);

$name = elgg_view('input/text', array(
	'name' => 'menus[name][]',
	'class' => 'roles-ui-autocomplete-menus',
	'value' => $pname
		));

$rules = array('allow', 'deny');

$rule = elgg_view('input/dropdown', array(
	'name' => 'menus[rule][]',
	'options' => $rules,
	'class' => 'roles-ui-form-rule-select',
	'value' => $prule,
	
		));

switch ($prule) {
	default :
	case 'allow' :
	case 'deny' :
		break;

	case 'replace' :
		/**
		 * @todo Add replace and extend form elements
		 */
		$opts = '';
		break;

	case 'extend' :
		$opts = '';
		break;
}

$menus = elgg_view_icon('delete', 'roles-ui-rule-remove');

if (!$pname) {
	$template = 'class="roles-ui-permission roles-ui-form hidden" data-tmpl="menus"';
} else {
	$template = 'class="hidden"';
}
$html = <<<__HTML
<div $template>
	<div class="roles-ui-rule-perm-type roles-ui-rule-perm-type-menus"><span>menus</span></div>
	<div class="roles-ui-rule-name">$name</div>
	<div class="roles-ui-rule">$rule</div>
	<div class="roles-ui-rule-options">$opts</div>
	<div class="roles-ui-rule-menus">$menus</div>
</div>
__HTML;

echo $html;



