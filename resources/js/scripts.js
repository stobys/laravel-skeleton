

function toggleFilterContainer(item, event)
{
    $('#'+ $(item).data('container-id')).toggle();

    return false;
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
