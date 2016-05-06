define(function (require) {

	var elgg = require('elgg');
	var $ = require('jquery');
	var spinner = require('elgg/spinner');

	$(document).on('submit', '.roles-ui-set-lightbox form', function (e) {
		var $form = $(this);
		elgg.action($form.attr('action'), {
			data: $form.serialize(),
			beforeSend: function () {
				$form.find('[type="submit"]').prop('disabled', true);
				spinner.start();
			},
			success: function (data) {
				if (data && data.output) {
					$('.elgg-menu-item-roles-set > a[data-guid="' + data.output.user.guid + '"]')
							.text(elgg.echo('roles_ui:set:role', [data.output.role.title]))
				}
			},
			complete: function () {
				spinner.stop();
				if (typeof $.fancybox !== 'undefined') {
					$.fancybox.close();
				}
			}
		});
		return false;
	});
});
