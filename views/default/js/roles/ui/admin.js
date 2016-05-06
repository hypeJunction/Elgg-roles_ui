define(function (require) {

	var elgg = require('elgg');
	var $ = require('jquery');
	var config = require('roles/ui/config');
//	if (require.defined('jquery-ui')) {
//		require('jquery-ui');
//	}
	
	$(document).on('click', '.roles-ui-add-permission-button', function (e) {
		e.preventDefault();
		var tmpl = $(this).attr('rel');
		var $template = $('[data-tmpl="' + tmpl + '"]').clone();
		$template.removeAttr('data-tmpl').removeClass('hidden').appendTo('.roles-ui-permissions');
		initAutocomplete();
	});

	$(document).on('change', '.roles-ui-form-rule-select', function (e) {
		var $form = $(this).closest('.roles-ui-form');
		$('.roles-ui-form-rule-options-parts', $form).hide().find('input,select').val('');
		$('.roles-ui-form-rule-options-parts[rel="' + $(this).val() + '"]', $form).show();
		initAutocomplete();
	});

	$(document).on('click', '.roles-ui-rule-remove', function (e) {
		e.preventDefault();
		if (confirm(elgg.echo('question:areyousure'))) {
			$(this).closest('.roles-ui-permission').remove();
		} else {
			return false;
		}
	});

	var initAutocomplete = function () {
		$('.roles-ui-autocomplete-views').autocomplete({
			source: config.views
		});

		$('.roles-ui-autocomplete-actions').autocomplete({
			source: config.actions
		});

		$('.roles-ui-autocomplete-hooks').autocomplete({
			source: config.hooks,
			select: function (event, ui) {
				var value = ui.item.value;
				$(this).closest('.roles-ui-permission')
						.find('.roles-ui-autocomplete-hook-handlers')
						.autocomplete({
							source: config.hook_handlers[value]
						});
			}
		});

		$('.roles-ui-autocomplete-events').autocomplete({
			source: config.events,
			select: function (event, ui) {
				var value = ui.item.value;
				$(this).closest('.roles-ui-permission')
						.find('.roles-ui-autocomplete-event-handlers')
						.autocomplete({
							source: config.event_handlers[value]
						});
			}
		});

		$('.roles-ui-autocomplete-menus').autocomplete({
			source: config.menus
		});

	};

});