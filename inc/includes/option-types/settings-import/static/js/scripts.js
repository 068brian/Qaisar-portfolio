jQuery(function($){

	fwEvents.on('fw:options:init', function (data) {

		var option_class = '.fw-backend-option-type-settings-import';

		var parent_class = '#fw-option-' + fw_import_id;

		var $elements = data.$elements.find(option_class +':not(.fw-option-initialized)');

		/** Init Import button */
		$elements.on('click', parent_class + '-btn-import-file', function(){
			$(parent_class + '-btn-import-file').addClass('button-primary');
			$(parent_class + '-btn-import-url').removeClass('button-primary');
			$(parent_class + '-import-file').removeClass('fw-hidden');
			$(parent_class + '-import-url').addClass('fw-hidden');
			$(parent_class + '-btn-import-submit').attr('import-from', 'file');
		});

		$elements.on('click', parent_class + '-btn-import-url', function(){
			$(parent_class + '-btn-import-url').addClass('button-primary');
			$(parent_class + '-btn-import-file').removeClass('button-primary');
			$(parent_class + '-import-url').removeClass('fw-hidden');
			$(parent_class + '-import-file').addClass('fw-hidden');
			$(parent_class + '-btn-import-submit').attr('import-from', 'url');
		});

		$elements.on('click', parent_class + '-btn-import-submit', function(){

			var error = false;
			var data = '';

			if ( $(parent_class + '-btn-import-submit').attr('import-from') == 'url' ){
				if ( $(parent_class + '-import-url').val() == '' )
					error = true;
				else
					data = $(parent_class + '-import-url').val();
			}
			else if ( $(parent_class + '-btn-import-submit').attr('import-from') == 'file' ){
				if ( $(parent_class + '-import-file').val() == '' )
					error = true;
				else
					data = $(parent_class + '-import-file').val();
			}
			else 
				error = true;

			if ( !error ) {
				var title = 'Importing';
				var description =
					'We are currently importing your settings' +
					'<br />' + 
					'This may take a few moments';

				fw.soleModal.show(
					'fw-options-ajax-import-loading',
					'<h2 class="fw-text-muted">'+
						'<img src="'+ fw.img.loadingSpinner +'" alt="Loading" class="wp-spinner" /> '+
						title +
					'</h2>'+
					'<p class="fw-text-muted"><em>'+ description +'</em></p>',
					{
						autoHide: 60000,
						allowClose: false
					}
				);

				$.ajax({
					url: ajaxurl,
					data: {
						action: 'fw_backend_options_import',
						type: $(parent_class + '-btn-import-submit').attr('import-from'),
						data: data
					},
					method: 'post',
					dataType: 'json'
				}).done(function (r) {
					if (r.success) {
						fw.soleModal.show(
							'fw-options-ajax-import-success',
							'<h2 class="fw-text-muted">Import Successfully</h2>',
							{
								autoHide: 1000,
								showCloseButton: false,
								hidePrevious: false,
								afterClose: function(){ location.reload(); }
							}
						);
					} else {
						try {
							alert(r.data.message);
						} catch (e) {
							alert('Request failed');
						}
					}
				}).fail(function (jqXHR, textStatus, errorThrown) {
					alert('AJAX error: '+ String(errorThrown));
				}).always(function () {
					fw.soleModal.hide('fw-options-ajax-import-loading');
				});
			}
			else
				alert('Please input import data');
			
		});

		$elements.addClass('fw-option-initialized');

	});

});