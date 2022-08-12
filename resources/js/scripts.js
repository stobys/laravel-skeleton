function clearInputGroupField(item, event) {
    $(item).closest('.input-group').find(':input')
        .not(':button, :submit, :reset, :hidden')
        .val('')
        .removeAttr('checked')
        .removeAttr('selected');
}

function inputGroupCopyToClipboard(item, event) {
    let element = $(item).closest('.input-group').find(':input')
        .not(':button, :submit, :reset, :hidden');

    // console.log(element);
    if (element.length) {
        let copied = copyToClipboard(element.get(0));
        if (copied)
        {
            toastr.info('Skopiowano do schowka : '+ copied);
        }
    }
}

function toggleFilterContainer(item, event)
{
    $('#'+ $(item).data('container-id')).toggle();

    return false;
}

function toggleFilterContent(item, event)
{
    logFunctionCall();

    var filterShowIconClass = $(item).data('filter-show-icon');
    var filterHideIconClass = $(item).data('filter-hide-icon');

    if ( $(item).closest('.card').find('.card-body').is(':visible') )
    {
        $(item).closest('.card').find('.card-body').hide();
        $(item).closest('.card').find('.card-footer').hide();

        $(item).closest('.card').find('.toggle-icon')
            .removeClass(filterShowIconClass)
            .removeClass(filterHideIconClass)
            .addClass(filterShowIconClass);
    }
    else {
        $(item).closest('.card').find('.card-body').show();
        $(item).closest('.card').find('.card-footer').show();

        $(item).closest('.card').find('.toggle-icon')
            .removeClass(filterHideIconClass)
            .removeClass(filterShowIconClass)
            .addClass(filterHideIconClass);
    }
}

function submitFilterForm(item, event)
{
    $(item).closest('form').find('button:submit').click();
}

function clearFilterForm(item, event)
{
    $(item).closest('form').find(':input')
        .not(':button, :submit, :reset, :hidden')
        .val('')
        .removeAttr('checked')
        .removeAttr('selected');

    $(item).closest('form').submit();
}

function clearForm( form ) {
    $(form).find(':input')
        .not(':button, :submit, :reset, :hidden')
        .val('')
        .removeAttr('checked')
        .removeAttr('selected');
}

function collapseAllBoxes()
{
	$('[data-widget="collapse"]').closest('.box').boxWidget('collapse');
}

function expandAllBoxes()
{
	$('[data-widget="collapse"]').closest('.box').boxWidget('expand');
}

function toggleAllBoxes()
{
	$('[data-widget="collapse"]').closest('.box').boxWidget('toggle');
}

function clearFileInput(item, event)
{
    $(item).closest('div').find(':file[data-toggle=filestyle]').filestyle('clear');
}

function createForm(action, method)
{
    var form = $('<form>', {
        'method': 'POST',
        'action': action
    });

    var tokenInput =
        $('<input>', {
            'type': 'hidden',
            'name': '_token',
            'value': $('meta[name="csrf-token"]').attr('content')
        });

    var methodInput =
        $('<input>', {
            'name': '_method',
            'type': 'hidden',
            'value': method
        });

    return form.append(tokenInput, methodInput);
}

function submitSelectedItems(item, event)
{
    logFunctionCall();

    var form = createForm( $(item).data('action'), $(item).data('method') );

    $('.rowSelectBox:checked').each(function(){
        console.log('each');
        
        var row = $('<input>', {
            'name': 'bulkIds[]',
            'type': 'hidden',
            'value': $(this).val()
        });

        form.append(row);
    });

    form.appendTo('body').submit();
}

function kanbanOrder(item, event)
{
    var body = {
        material_id : $(item).data('material-id')
    };

    $.post($(item).data('action'), body, function(data) {
        if ( data.errno ) {
            // showMsgBox(data.html, 'warning');
            console.log('kanbanOrder : errno: '+ data.errno);
        }
        else {
            console.log('kanbanOrder : no errno');
        }
    }, 'json')
        .fail(function(err){
            console.log('kanbanOrder : fail');
            // showMsgBox( 'Error #'+ err.status +': '+ err.statusText, 'error' );
        });
}

function kanbanShipment(item, event)
{
    var body = {
        material_id : $(item).data('material-id')
    };

    $.post($(item).data('action'), body, function(data) {
        if ( data.errno ) {
            // showMsgBox(data.html, 'warning');
            console.log('kanbanShipment : errno: '+ data.errno);
        }
        else {
            console.log('kanbanShipment : no errno');
        }
    }, 'json')
        .fail(function(err){
            console.log('kanbanShipment : fail');
            // showMsgBox( 'Error #'+ err.status +': '+ err.statusText, 'error' );
        });
}

function copyToClipboard(element) {
    // -- Get the text field
    if (typeof element == 'string') {
        element = document.getElementById(element);
    }

    // -- Select the text field
    element.select();
    element.setSelectionRange(0, 99999); /* For mobile devices */

    // -- Alert the copied text
    if (element.value == '') {
        return null;
    }
    else {
        // -- Copy the text inside the text field
        try {
            navigator.clipboard.writeText(element.value);
        }
        catch(error) {
            document.execCommand('copy');
        }

        return element.value;
    }
}

var selectedColumnIdx = -1;
function getSelectedText() {
    var range = window.getSelection().getRangeAt(0),
        doc = range.cloneContents(),
        nodes = doc.querySelectorAll('tr'),
        text = '';

    if (nodes.length) {
        [].forEach.call(nodes, function (tr, i) {
            let td = tr.cells[i ? selectedColumnIdx : 0];
            text += (i ? '\n' : '') + td.textContent;
        });
    } else {
        text = doc.textContent;
    }

    return text;
}

var selecty = document.getElementById('selecty');

if ( selecty )
{
    document.getElementById('selecty').addEventListener('mousedown', function (e) {
        var classes = [
                'lp',
                'storage-bin',
                'voucher-id',
                'part-number',
                'part-quantity',
                'storage-unit',
                'item-approval'
            ],
            table = document.getElementById('selecty');
    
        // -- remove all classes
        classes.forEach(function (value, index) {
            table.classList.remove('selecting-'+ value);
    
            // -- add proper class
            if (e.target.classList.contains(value)) {
                table.classList.add('selecting-' + value);
                selectedColumnIdx = index;
            }
        });
    });

    document.getElementById('selecty').addEventListener('copy', function (e) {
        let text = getSelectedText();
        e.clipboardData.setData('text', text);
    
        console.log('Copied to clipboard:\n' + text);
    });
}
