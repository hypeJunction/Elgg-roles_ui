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

$value = [];
foreach ($all_roles as $role) {
	$roles_options[$role->name] = elgg_view_icon('drag-arrow') . $role->getDisplayName();
	if (roles_has_role($user, $role)) {
		$value[] = $role->name;
	}
}
?>

<div class="elgg-field">
	<label class="elgg-field-label"><?= elgg_echo('user:set:roles') ?></label>
	<?php
	echo elgg_view('input/checkboxes', [
		'name' => 'roles',
		'value' => $value,
		'options' => array_flip($roles_options),
		'class' => 'roles-ui-roles-checkboxes',
	]);
	?>
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