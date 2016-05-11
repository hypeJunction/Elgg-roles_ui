<?php
$user = elgg_extract('entity', $vars, elgg_get_logged_in_user_entity());
if (!$user) {
	return;
}

$all_roles = roles_get_all_selectable_roles();
if (empty($all_roles)) {
	echo elgg_format_element('p', ['class' => 'elgg-no-results'], elgg_echo('roles:no_selecatable_roles'));
	return;
}

$user_role = roles_get_role($user);
if (in_array($user_role, $all_roles)) {
	$roles_options[$role->name] = elgg_view_icon('cursor-drag-arrow') . $user_role->getDisplayName();
}
$extends = array_reverse((array) $user_role->getExtends());

foreach ($extends as $role_name) {
	$role = roles_get_role_by_name($role_name);
	if (!$role) {
		continue;
	}
	$roles_options[$role->name] = elgg_view_icon('cursor-drag-arrow') . $role->getDisplayName();
}

$value = [];
foreach ($all_roles as $role) {
	if (roles_has_role($user, $role)) {
		$value[] = $role->name;
	}
	if (array_key_exists($role->name, $roles_options)) {
		continue;
	}
	$roles_options[$role->name] = elgg_view_icon('cursor-drag-arrow') . $role->getDisplayName();
	
}
?>

<div class="elgg-field">
	<label class="elgg-field-label"><?php echo elgg_echo('user:set:roles') ?></label>
	<?php
	echo elgg_view('input/checkboxes', [
		'name' => 'roles',
		'value' => $value,
		'options' => array_flip($roles_options),
		'class' => 'roles-ui-roles-checkboxes',
	]);
	?>
	<div class="elgg-text-help"><?php echo elgg_echo('user:set:roles:help') ?></div>
</div>
<script>
	require(['jquery'], function ($) {
		$('.roles-ui-roles-checkboxes').sortable({
			items: 'li',
			connectWith: '.roles-ui-roles-checkboxes',
			handle: '.elgg-icon-drag-arrow',
			forcePlaceholderSize: true,
			placeholder: 'roles-ui-roles-checkboxes-placeholder',
			opacity: 0.8,
			revert: 500
		});
	});
</script>