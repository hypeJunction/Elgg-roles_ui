<?php

namespace Elgg\Roles\UI;

if (FALSE) :
	?>
	<script type='text/javascript'>
<?php endif; ?>

	elgg.provide('roles.ui');
	elgg.provide('roles.ui.set');

	roles.ui.set.init = function() {

		$('.elgg-menu-item-roles-set > a')
				.fancybox({
					width: 200
				});

		$('.roles-ui-set-lightbox form')
				.live('submit', function(e) {

					var $form = $(this);

					elgg.action($form.attr('action'), {
						data: $form.serialize(),
						beforeSend: function() {
							$form.find('[type="submit"]').prop('disabled', true);
							$.fancybox.showActivity();
						},
						success: function(data) {
							if (data && data.output) {
								$('.elgg-menu-item-roles-set > a[data-guid="' + data.output.user.guid + '"]')
										.text(elgg.echo('roles_ui:set:role', [data.output.role.title]))
							}
						},
						complete: function() {
							$.fancybox.close();
						}
					})

					return false;
				});


	}
	elgg.register_hook_handler('init', 'system', roles.ui.set.init);

<?php if (FALSE) : ?></script><?php
endif;
?>
