const alpineCommonObj = {

    clearInputGroupField(event) {
        $(event.target).closest('.input-group').find(':input')
            .not(':button, :submit, :reset, :hidden')
            .val('')
            .removeAttr('checked')
            .removeAttr('selected');
    },

    clearFileInput(event) {
        $(event.target).closest('div').find(':file[data-toggle=filestyle]').filestyle('clear');
    },

    clearFilterForm(event) {
        $(event.target).closest('form').find(':input')
            .not(':button, :submit, :reset, :hidden')
            .val('')
            .removeAttr('checked')
            .removeAttr('selected');

        $(event.target).closest('form').submit();
    },

    copyToClipboard(element) {
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
            catch (error) {
                document.execCommand('copy');
            }

            return element.value;
        }
    },

    inputGroupCopyToClipboard(item, event) {
        let element = $(item).closest('.input-group').find(':input')
            .not(':button, :submit, :reset, :hidden');
    
        // console.log(element);
        if (element.length) {
            let copied = copyToClipboard(element.get(0));
            if (copied) {
                toastr.info('Skopiowano do schowka : ' + copied);
            }
        }
    },

    setSortOrder(event) {
        let url = new URL(window.location);
        let sort = $(event.target).val();

        if (sort.toLowerCase() == 'default') {
            url.searchParams.delete('sort');
        }
        else {
            url.searchParams.set('sort', $(event.target).val());
        }

        window.location = url;
    },

    submitFilterForm(event) {
        $(event.target).closest('form').find('button:submit').click();
    },

    toggleFilterContent(event) {
        let filterShowIconClass = $(event.target).data('filter-show-icon');
        let filterHideIconClass = $(event.target).data('filter-hide-icon');

        if ($(event.target).closest('.card').find('.card-body').is(':visible')) {
            $(event.target).closest('.card').find('.card-body').hide();
            $(event.target).closest('.card').find('.card-footer').hide();

            $(event.target).closest('.card').find('.toggle-icon')
                .removeClass(filterShowIconClass)
                .removeClass(filterHideIconClass)
                .addClass(filterShowIconClass);
        }
        else {
            $(event.target).closest('.card').find('.card-body').show();
            $(event.target).closest('.card').find('.card-footer').show();

            $(event.target).closest('.card').find('.toggle-icon')
            .removeClass(filterHideIconClass)
            .removeClass(filterShowIconClass)
            .addClass(filterHideIconClass);
        }
    },



}

export default alpineCommonObj
