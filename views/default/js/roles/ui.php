<?php if (FALSE) : ?>
	<script type='text/javascript'>
<?php endif; ?>

	elgg.provide('roles');
	elgg.provide('roles.ui');

	roles.ui.init = function() {

		$('.roles-ui-add-permission-button')
				.live('click', function(e) {
			e.preventDefault();
			var tmpl = $(this).attr('rel');
			var $template = $('[data-tmpl="' + tmpl + '"]').clone();
			$template.removeAttr('data-tmpl').removeClass('hidden').appendTo('.roles-ui-permissions');
			roles.ui.initAutocomplete();

		})

		$('.roles-ui-form-rule-select')
				.live('change', function(e) {

			var $form = $(this).closest('.roles-ui-form');
			$('.roles-ui-form-rule-options-parts', $form).hide().find('input,select').val('');
			$('.roles-ui-form-rule-options-parts[rel="' + $(this).val() + '"]', $form).show();
			roles.ui.initAutocomplete();
		})

		$('.roles-ui-rule-remove')
				.live('click', function(e) {

			e.preventDefault();

			if (confirm(elgg.echo('question:areyousure'))) {
				$(this).closest('.roles-ui-permission').remove();
			} else {
				return false;
			}
		})
	}

	roles.ui.initAutocomplete = function() {
		$('.roles-ui-autocomplete-views')
				.autocomplete({
			source: elgg.views_config
		})

		$('.roles-ui-autocomplete-actions')
				.autocomplete({
			source: elgg.actions_config
		})
		$('.roles-ui-autocomplete-hooks')
				.autocomplete({
			source: elgg.hooks_config,
			select : function(event, ui) {
				var value = ui.item.value;
				$(this)
						.closest('.roles-ui-permission')
						.find('.roles-ui-autocomplete-hook-handlers')
						.autocomplete({
							source : elgg.hook_handlers_config[value]
						})
			}
		})
		$('.roles-ui-autocomplete-events')
				.autocomplete({
			source: elgg.events_config,
			select : function(event, ui) {
				var value = ui.item.value;
				$(this)
						.closest('.roles-ui-permission')
						.find('.roles-ui-autocomplete-event-handlers')
						.autocomplete({
							source : elgg.event_handlers_config[value]
						})
			}
		})

		$('.roles-ui-autocomplete-menus')
				.autocomplete({
			source: elgg.menus_config
		})


	}

	elgg.register_hook_handler('init', 'system', roles.ui.init);
	elgg.register_hook_handler('init', 'system', roles.ui.initAutocomplete);

<?php if (FALSE) : ?></script><?php
endif;
?>
