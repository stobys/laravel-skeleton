delay(5000).then( () => {
	document.querySelectorAll('div.alert:not(.alert-danger)').forEach(element => slideUp(element, slideDuration));
	delay(slideDuration+100).then( () => {
		document.querySelectorAll('div.alert:not(.alert-danger)').forEach(element => element.remove());
	});
});

function initAfterAjax() {
    initLaravel();
	initSelectAllItems();
	initSelect2();
	initTooltips();
	initRowActionButtons();
	//initInputMask();
	//initColorPicker();
    // initDatePicker();
    // initDateRangePicker();
    // initWeekPicker();
 //    initReadonlySelect();
	// initSwitchables();
	// initToggables();
	// initIChecks();
	// initCountDownTimer();
	// initEditors();
	initFileInputs();
	initFormsValidation();
	preventTableCellsFromBeingSelectedWithCtrlClick();
	initScrollButtons();
}

// function initEditors() {
// 	$('.wysiwygable').wysihtml5();
// }

function preventTableCellsFromBeingSelectedWithCtrlClick()
{
    $('table').mousedown(function (event) {
        if (event.ctrlKey) {
            event.preventDefault();
        }
    });
}

//function initInputMasks() {
//    logFunctionCall();
//
//    $("[data-inputmask]").each(function(){
//        $(this).inputmask($(this).data('inputmask'));
//    });
//
//}

// function initIChecks()
// {
// 	$('input.icheckable').iCheck({
//     	checkboxClass: 'icheckbox_square-blue',
//     	radioClass: 'iradio_square-blue',
//     	increaseArea: '20%' // optional
//   	});
// }

// function initReadonlySelect() {
//     $('select[readonly=readonly]').on('change', function(){
//         $(this).attr('selectedIndex')
//     });
// }

// function initColorPicker() {
// 	$('.colorpicker').colorpicker({
// 		format: 'rgba'
// 	});
// }

// function initDatePicker() {
// 	// -- Date picker
// 	$('[data-widget=datepicker]').datepicker({
// 		autoclose: true,
// 		calendarWeeks: true,
// 		clearBtn: true,
// 		daysOfWeekHighlighted: [6],
// 		format: 'yyyy-mm-dd',
// 		language: 'pl',
// 		weekStart: 1
// 	});
// }

function initDateRangePicker() {
	$('.date-range-picker').daterangepicker({
		"showDropdowns": true,
		"showISOWeekNumbers": true,
		"autoApply": true,
		"ranges": {
            'Dziś': [moment(), moment()],
			'Ten Miesiąc': [moment().startOf('month'), moment().endOf('month')],
			'Poprzedni Miesiąc': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
		},
		"locale": {
			"format": 'YYYY/MM/DD',
			"separator": " - ",
			"applyLabel": trans('global.ok'),
			"cancelLabel": trans('global.cancel'),
			"fromLabel": trans('global.from'),
			"toLabel": trans('global.to'),
			"customRangeLabel": trans('global.datePicker.different-range'),
			"daysOfWeek": trans('global.datePicker.days.short'),
			"monthNames": trans('global.months.full'),
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
	});

}

function initWeekPicker() {
	logFunctionCall();

	$('.week-picker input').datepicker({
	  // Format date value to week as text
	  format: {
	    toDisplay: function(date) {
	      var d = moment(date).add(1, 'd'); // In my case, week begin on Sat. +1 day to make sure Sat moved to next week (Default start from Sun)
	      var week_from = moment(date).add(1, 'd').startOf('week').add(-1, 'd'); // selected week's Sat
	      var week_til = moment(date).add(1, 'd').startOf('week').add(5, 'd'); // selected week's Sun
	      return d.format("YYYY-[W]W")+ " (" + week_from.format("D/M") + "-" + week_til.format("D/M") + ")";
	    },
	    // Convert string "2017-W34 (19/8 - 25/8)" to Date object
	    toValue: function(date) {
	      var year = Number(date.split("-W")[0]);
	      var week = Number(date.split("-W")[1].split(" ")[0]);
	      var d = moment().day("Monday").year(year).week(week).startOf('day');
	      return d.toDate();
	    }
	  },
      format: "yyyy-mm-dd",
      keyboardNavigation: false,
      calendarWeeks: true,
	  container: '.weekpicker', // Inject to placeholder to apply css
	  autoclose: true,
	  weekStart: 1, // Week starts on Mon
	});

	// Update highlight row when weekpicker shown
	// It's just simple add `active` class to `tr` which holds `active` `td`
	$('.week-picker input').on('show', function() {
		$('.weekpicker').find('.datepicker table tr').each(function() {
	    	if ($(this).find('td.day.active').length > 0) {
	      		$(this).addClass('active');
	    	} else {
	      		$(this).removeClass('active');
	    	}
	  	});
	});

	// Patch to fix highlight when using keys to update weekpicker
	$('.week-picker input').on('keyup', function() {
	  	$('.weekpicker').find('.datepicker table tr').each(function() {
	    	if ($(this).find("td.day.active").length > 0) {
	      		$(this).addClass('active');
	    	} else {
	      		$(this).removeClass('active');
	    	}
	  	});
	});
}

// function initInputMask() {
// 	$(':input[data-inputmask]').inputmask();
// }

function initSelect2() {
	$('.select2able').select2({
		language: appLang,
		placeholder: ' --- ',
  		allowClear: true
	}).on('select2:select', function (e) {
  		e.currentTarget.dispatchEvent(new Event('change'));
	});
}

function initTooltips() {
	// -- jQuery
	$('[data-toggle="tooltip"]').tooltip();

	// -- Vanilla JS
	// var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-toggle="tooltip"]'));
	// var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
	// 	return new bootstrap.Tooltip(tooltipTriggerEl)
	// });
}

// function initSwitchables() {
// 	$('[data-toggle="switch"], input[type=checkbox].switchable, input[type=radio].switchable').bootstrapSwitch();

// 	// -- workaround for v3.3.5 which not show checked initially
// 	$('[data-toggle="switch"], input[type=checkbox].switchable').each(function(){
// 		$(this).bootstrapSwitch('state', $(this).is(':checked'));
// 	});
// }

// function initToggables() {
	// $('input[data-toggle=toggle]').change(function() {
	// 	if ( $(this).closest('.box-body').find('input:checked').length ) {
	// 		$(this).closest('.box').removeClass('box-default box-warning').addClass('box-warning');
	// 	}
	// 	else {
	// 		$(this).closest('.box').removeClass('box-default box-warning').addClass('box-default');
	// 	}
	// });

	// $('[data-toggle=toggle]').bootstrapToggle();
// }

// function initFileUploads() {
// 	logFunctionCall();

// 	// Change this to the location of your server-side upload handler:
// 	var url = appBaseUrl +'files/upload',
// 		uploadButton = $('<button/>')
// 			.addClass('btn btn-primary')
// 			.prop('disabled', true)
// 			.text('Processing...')
// 			.on('click', function () {
// 				var $this = $(this),
// 					data = $this.data();

// 				$this
// 					.off('click')
// 					.text('Abort')
// 					.on('click', function () {
// 						$this.remove();
// 						data.abort();
// 					});

// 				data.submit().always(function () {
// 					$this.remove();
// 				});
// 			});

// 		$('#fileupload').fileupload({
// 			url: url,
// 			dataType: 'json',
// 			autoUpload: true,
// 			acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
// 			maxFileSize: 9999000,
// 			// Enable image resizing, except for Android and Opera,
// 			// which actually support image resizing, but fail to
// 			// send Blob objects via XHR requests:
// 			disableImageResize: /Android(?!.*Chrome)|Opera/.test(window.navigator.userAgent),
// 			previewMaxWidth: 100,
// 			previewMaxHeight: 100,
// 			previewCrop: true
// 		})
// 		//.on('fileuploadadd', function (e, data) {
//          //   console.log('fileuploadadd: dodano plik');
// 		//})
// 		.on('fileuploadprocessalways', function (e, data) {
//             console.log('fileuploadprocessalways');
// 		})
//         .on('fileuploadprogressall', function (e, data) {
//             console.log('fileuploadprogressall');

// 			var progress = parseInt(data.loaded / data.total * 100, 10);
// 			$('#progress .progress-bar').css('width', progress +'%');
// 		})
//         .on('fileuploaddone', function (e, data) {
//             console.log('fileuploaddone');

// 			$.each(data.result.files, function (index, file) {
//                 //$('#attachments-list').append( tmpl('tpl-uploaded-files', data.files) );
//                 $('#attachments-list').append( file.html );
// 			});

//             initJStriggers();
// 		})
//         .on('fileuploadfail', function (e, data) {
//                 console.log('fileuploadfail');
// 		})
//         .prop('disabled', !$.support.fileInput)
// 		.parent().addClass($.support.fileInput ? undefined : 'disabled');

// }

function initLaravel() {
	logFunctionCall();

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
				if ( link.data('confirm') && ! laravel.verifyConfirm(link) ) {
					return false;
				}

				form = laravel.createForm(link);
				form.submit();

				e.preventDefault();
			},

			verifyConfirm: function(link) {
				console.log(' - - verifyConfirm')
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
						'name': '_token',
						'value': $('meta[name="csrf-token"]').attr('content')
					});

				var hiddenInput =
					$('<input>', {
						'name': '_method',
						'type': 'hidden',
						'value': link.data('method')
					});

				return form.append(token, hiddenInput).appendTo('body');
			}
		};

		laravel.initialize();
	})();
}

function initToggleCardWidgetOnDblClick()
{
    $('[data-card-widget=collapse]').closest('.card-header')
    	.unbind('dblclick').dblclick(function(event){
        	$(this).CardWidget('toggle');
    	});
}

function showHideBulkActionButton()
{
	var totalCount = $('.rowSelectBox').length;
	var selectedCount = $('.rowSelectBox:checked').length;

	$('.rowsSelectAll').prop('checked', selectedCount == totalCount);

	if ( selectedCount )
	{
		$('.btn-bulk-action').show();
	}
	else {
		$('.btn-bulk-action').hide();
	}
}

function initSelectAllItems()
{
	logFunctionCall();

	// -- select all rows on index
	$('.rowsSelectAll').click( function() {
    	$('.rowSelectBox').prop('checked', $(this).prop('checked'));

		if ( $(this).prop('checked') )
		{
			$('.btn-bulk-action').show();
		}
		else {
			$('.btn-bulk-action').hide();
		}

	});

	// -- alter selection on change of single row on index
	$('.rowSelectBox').change(function(){
		console.log('change');
    	var totalCount = $('.rowSelectBox').length;
    	var selectedCount = $('.rowSelectBox:checked').length;

		$('.rowsSelectAll').prop('checked', selectedCount == totalCount);

		showHideBulkActionButton();
	});

	$('.table tbody tr').click( function(){
		var row = $(this);
		var chbox = row.find('.rowSelectBox');
		var actualState = chbox.prop('checked');

		// var actualState = $(item).find('.rowSelectBox').prop('checked', $(this).prop('checked'));
		if(ctrlPressed)
		{
			chbox.prop('checked', !actualState);
		}
		else {
			row.closest('tbody').find('.rowSelectBox').prop('checked', false);
		 	chbox.prop('checked', true);
		}

		showHideBulkActionButton();
	});

	// -- select all option in select (edit/create label)
	$('.select-all').click(function () {
    	let $select2 = $(this).parent().siblings('.select2')
    	$select2.find('option').prop('selected', 'selected')
    	$select2.trigger('change')
	});

	// -- deselect all option in select (edit/create label)
	$('.deselect-all').click(function () {
	    let $select2 = $(this).parent().siblings('.select2')
	    $select2.find('option').prop('selected', '')
	    $select2.trigger('change')
	});

}

function initFormsValidation()
{
	logFunctionCall();

	$('form[data-validate]').off('submit').on('submit', function(event){
		var validationResult = callback.call( $(this).data('validate') );

		if ( ! validationResult )
		{
			event.preventDefault();
			return false;
		}
	});
}

// function initFileInputs()
// {
// 	$(':file[data-toggle=filestyle]').filestyle();
// }

function initFileInputs()
{
	logFunctionCall();

	// We can attach the `fileselect` event to all file inputs on the page
	$(document).on('change', ':file', function () {
		var input = $(this),
			numFiles = input.get(0).files ? input.get(0).files.length : 1,
			label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
			input.trigger('fileselect', [numFiles, label]);
	});

	// We can watch for our custom `fileselect` event like this
	$(document).ready(function () {
		$(':file').on('fileselect', function (event, numFiles, label) {
			msg = numFiles > 1 ? 'Wybrano pików: ' + numFiles : label;
			$(this).parents('.input-group').find(':text').val(msg);
		});
	});

	$('.file-picker-trigger').on('click', function(){
		$(this).parents('.file-picker').find(':file').trigger('click');
	});
}

function initScrollButtons()
{
	$('.btn-scroll.scroll-to-top').on('click', function(){
		document.body.scrollIntoView(true);
	});

	$('.btn-scroll.scroll-to-bottom').on('click', function () {
		document.body.scrollIntoView(false);
	});

	window.addEventListener('scroll', function () {
		if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
			$('.btn-scroll').show();
			$('.row.scroll-fixed').addClass('scroll-fixed-top');
		} else {
			$('.btn-scroll').hide();
			$('.row.scroll-fixed').removeClass('scroll-fixed-top');
		}
	}, false);

}
