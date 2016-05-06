<?php
$entity = elgg_extract('entity', $vars);

if (!elgg_instanceof($entity, 'user')) {
	return;
}

$current_page_owner = elgg_get_page_owner_entity();
elgg_set_page_owner_guid($entity->guid);


$body = elgg_view('input/roles', [
	'entity' => $entity,
]);

$body .= elgg_view('input/hidden', array(
	'name' => 'guid',
	'value' => $entity->guid,
		));
$body .= '<div class="elgg-foot">' . elgg_view('input/submit') . '</div>';

elgg_push_context('widgets');
echo '<div class="roles-ui-set-lightbox">';
echo elgg_view_entity($entity, array(
	'full_view' => false,
	'use_hover' => false
));
echo elgg_view('input/form', array(
	'action' => 'action/roles/set',
	'body' => $body,
));
echo '</div>';
elgg_pop_context();

elgg_set_page_owner_guid($current_page_owner->guid);
?>
<script>
	require(['roles/ui/set']);
</script>