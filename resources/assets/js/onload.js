$('div.alert').not('.alert-danger, .alert-important').delay(3000).slideUp(300);
$('div.callout').not('.callout-danger, .callout-important').delay(3000).slideUp(300);

function initAfterAjax() {
    //initLaravel();
	initJStriggers();
    // initAutoFocusInput();
    initSelect2();
	//initInputMask();
	//initColorPicker();
    initDatePicker();
    initDateRangePicker();
    initReadonlySelect();
    initSwitchables();
    initToggables();

}

function initJStriggers() {
    console.log('call initJStriggers();');

	$('[data-js-action]').each(function(index, item){
		var action = $(item).data('js-action');

		switch( $(item).data('js-trigger') ) {
			default:
			case 'click':
				$(item).unbind('click').click(function(event){
                    if ( $(item).is('[data-confirm]') ) {
                        if ( confirm($(item).data('confirm')) ) {
                            callback.call(action, item, event);
                        }
                    }
                    else {
                        callback.call(action, item, event);
                    }
				});
			break;

			case 'change':
				$(item).unbind('change').change(function(event){
					callback.call(action, item, event);
				});
			break;
		}
	});
}

//function initInputMasks() {
//    console.log('call initInputMasks();');
//
//    $("[data-inputmask]").each(function(){
//        $(this).inputmask($(this).data('inputmask'));
//    });
//
//}

function initReadonlySelect() {
    $('select[readonly=readonly]').on('change', function(){
        $(this).attr('selectedIndex')
    });
}

function initColorPicker() {
	$('.colorpicker').colorpicker({
		format: 'rgba'
	});
}

function initDatePicker() {
	console.log('call initDatePicker();');

	// -- Date picker
	$('[data-widget=datepicker]').datepicker({
		autoclose: true,
		calendarWeeks: true,
		clearBtn: true,
		daysOfWeekHighlighted: [6,7],
		format: 'yyyy-mm-dd',
		language: 'pl',
		weekStart: 1
	});
}

function initDateRangePicker() {
	$('.date-range-picker').daterangepicker({
		"showDropdowns": true,
		"showISOWeekNumbers": true,
		"autoApply": true,
		"ranges": {
            'Today': [moment(), moment()],
			'This Month': [moment().startOf('month'), moment().endOf('month')],
			'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
		},
		"locale": {
			"format": 'YYYY/MM/DD',
			"separator": " - ",
			"applyLabel": "OK",
			"cancelLabel": "Anuluj",
			"fromLabel": "Od:",
			"toLabel": "Do:",
			"customRangeLabel": "Inny zakres",
			"daysOfWeek": [
				"Nd", "Mo", "Tu", "We", "Th", "Fr", "Sa"
			],
			"monthNames": [
				"January","February","March","April","May","June","July","August","September","October","November","December"
			],
			"firstDay": 1
		},
		"alwaysShowCalendars": true,
		"startDate": moment().startOf('month').format('YYYY/MM/DD'),
        "endDate": moment().format('YYYY/MM/DD'),
        "maxDate": moment().endOf('month').format('YYYY/MM/DD'),
		"opens": "left"
	}, function(start, end, label) {
        $('#date_range').val( start.format('YYYY/MM/DD') +' - '+ end.format('YYYY/MM/DD') );
        console.log( label );
		//console.log("New date range selected: ' + start.format('YYYY/MM/DD') + ' to ' + end.format('YYYY/MM/DD') + ' (predefined range: ' + label + ')");

		//var years = moment().diff(start, 'years');
		//alert("You are " + years + " years old.");

	});

}

function initAutoFocusInput() {
    $('.autofocus').first().focus();
}

function initInputMask() {
	$(':input[data-inputmask]').inputmask();
}

function initSelect2() {
	$('.select2able').select2({
		language: appLang,
		placeholder: ' --- ',
  		allowClear: true
	});
}

function initSwitchables() {
	console.log('call initSwitchables();');
	$('input[type=checkbox].switchable, input[type=radio].switchable').bootstrapSwitch();
}

function initToggables() {
	console.log('call initToggables();');
	$('input[data-toggle=toggle]').change(function() {
		if ( $(this).closest('.box-body').find('input:checked').length ) {
			$(this).closest('.box').removeClass('box-default box-warning').addClass('box-warning');
		}
		else {
			$(this).closest('.box').removeClass('box-default box-warning').addClass('box-default');
		}
	});
}

function initFileUploads() {
	console.log('call initFileUploads()');

	// Change this to the location of your server-side upload handler:
	var url = appBaseUrl +'files/upload',
		uploadButton = $('<button/>')
			.addClass('btn btn-primary')
			.prop('disabled', true)
			.text('Processing...')
			.on('click', function () {
				var $this = $(this),
					data = $this.data();

				$this
					.off('click')
					.text('Abort')
					.on('click', function () {
						$this.remove();
						data.abort();
					});

				data.submit().always(function () {
					$this.remove();
				});
			});

		$('#fileupload').fileupload({
			url: url,
			dataType: 'json',
			autoUpload: true,
			acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
			maxFileSize: 9999000,
			// Enable image resizing, except for Android and Opera,
			// which actually support image resizing, but fail to
			// send Blob objects via XHR requests:
			disableImageResize: /Android(?!.*Chrome)|Opera/.test(window.navigator.userAgent),
			previewMaxWidth: 100,
			previewMaxHeight: 100,
			previewCrop: true
		})
		//.on('fileuploadadd', function (e, data) {
         //   console.log('fileuploadadd: dodano plik');
		//})
		.on('fileuploadprocessalways', function (e, data) {
            console.log('fileuploadprocessalways');
		})
        .on('fileuploadprogressall', function (e, data) {
            console.log('fileuploadprogressall');

			var progress = parseInt(data.loaded / data.total * 100, 10);
			$('#progress .progress-bar').css('width', progress +'%');
		})
        .on('fileuploaddone', function (e, data) {
            console.log('fileuploaddone');

			$.each(data.result.files, function (index, file) {
                //$('#attachments-list').append( tmpl('tpl-uploaded-files', data.files) );
                $('#attachments-list').append( file.html );
			});

            initJStriggers();
		})
        .on('fileuploadfail', function (e, data) {
                console.log('fileuploadfail');
		})
        .prop('disabled', !$.support.fileInput)
		.parent().addClass($.support.fileInput ? undefined : 'disabled');

}

function initLaravel() {
	/*
	 <a href="posts/2" data-method="delete"> <---- We want to send an HTTP DELETE request
	 - Or, request confirmation in the process -
	 <a href="posts/2" data-method="delete" data-confirm="Are you sure?">
	 */

	(function() {

		var laravel = {
			initialize: function() {
				this.methodLinks = $('a[data-method]');

				this.registerEvents();
			},

			registerEvents: function() {
				this.methodLinks.on('click', this.handleMethod);
			},

			handleMethod: function(e) {
				var link = $(this);
				var httpMethod = link.data('method').toUpperCase();
				var form;

				// If the data-method attribute is not PUT or DELETE,
				// then we don't know what to do. Just ignore.
				if ( $.inArray(httpMethod, ['PUT', 'DELETE']) === - 1 ) {
					return;
				}

				// Allow user to optionally provide data-confirm="Are you sure?"
				if ( link.data('confirm') ) {
					if ( ! laravel.verifyConfirm(link) ) {
						return false;
					}
				}

				form = laravel.createForm(link);
				form.submit();

				e.preventDefault();
			},

			verifyConfirm: function(link) {
				return confirm(link.data('confirm'));
			},

			createForm: function(link) {
				var form =
					$('<form>', {
						'method': 'POST',
						'action': link.attr('href')
					});

				var token =
					$('<input>', {
						'type': 'hidden',
						'name': 'csrf_token',
						'value': '<?php echo csrf_token(); ?>' // hmmmm...
					});

				var hiddenInput =
					$('<input>', {
						'name': '_method',
						'type': 'hidden',
						'value': link.data('method')
					});

				return form.append(token, hiddenInput)
					.appendTo('body');
			}
		};

		laravel.initialize();

	})();
}

function submitFilter(element, event) {
	$(element).closest('form').submit();
}
