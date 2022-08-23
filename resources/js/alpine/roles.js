import common from './default.js'

export default () => ({...common,
    ...{
        init() {
            console.log('Initialize Alpine on Users Roles List');
        },

        deleteModel(element) {
            Swal.fire({
                title: $(element).data('confirm') ?? 'O RLY ?',
                showDenyButton: true,
                showCancelButton: false,
                confirmButtonText: $(element).data('confirm-text') ?? 'TAK',
                denyButtonText: $(element).data('cancel-text') ?? 'NIE'
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    $(element).closest('form').submit();
                }
            })
        },

        restoreModel(element) {
            Swal.fire({
                title: $(element).data('confirm') ?? 'O RLY ?',
                showDenyButton: true,
                showCancelButton: false,
                confirmButtonText: $(element).data('confirm-text') ?? 'TAK',
                denyButtonText: $(element).data('cancel-text') ?? 'NIE'
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    $(element).closest('form').submit();
                }
            })
        },

        deleteSeletedModels(element) {
            Swal.fire({
                title: $(element).data('confirm') ?? 'O RLY ?',
                showDenyButton: true,
                showCancelButton: false,
                confirmButtonText: $(element).data('confirm-text') ?? 'TAK',
                denyButtonText: $(element).data('cancel-text') ?? 'NIE'
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    let selectedValues = $.map($('input:checkbox.rowSelectBox:checked'), (item) => $(item).val());

                    $.ajax({
                        url: $(element).data('href'),
                        type: 'DELETE',
                        data: { bulkIds: selectedValues },
                        success: function (result) {
                            alert('OK');
                        }
                    });
                }
            })
        },

        restoreSeletedModels(element) {
            Swal.fire({
                title: $(element).data('confirm') ?? 'O RLY ?',
                showDenyButton: true,
                showCancelButton: false,
                confirmButtonText: $(element).data('confirm-text') ?? 'TAK',
                denyButtonText: $(element).data('cancel-text') ?? 'NIE'
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    let selectedValues = $.map($('input:checkbox.rowSelectBox:checked'), (item) => $(item).val());

                    $.ajax({
                        url: $(element).data('href'),
                        type: 'DELETE',
                        data: { bulkIds: selectedValues },
                        success: function (result) {
                            alert('OK');
                        }
                    });
                }
            })
        },
        

        // addItemRow(element) {
        //     let template = document.getElementById('container-item-row-tmpl').innerHTML;
        //     let rendered = Mustache.render(template, {
        //         nextIndex: parseInt($('input[name^=index]:last').val())+1
        //     });

        //     $('.card-body').append(rendered);

        //     initAfterAjax();
        // },

        // deleteItemRow(event) {
        //     $(event.target).closest('.row').remove();
        // },

        // stornoDocument(element) {
        //     Swal.fire({
        //         title: $(element).data('confirm') ?? 'O RLY ?',
        //         showDenyButton: true,
        //         showCancelButton: false,
        //         confirmButtonText: $(element).data('confirm-text') ?? 'TAK',
        //         denyButtonText: $(element).data('cancel-text') ?? 'NIE'
        //     }).then((result) => {
        //         /* Read more about isConfirmed, isDenied below */
        //         if (result.isConfirmed) {
        //             window.location = $(element).attr('href');
        //         }
        //     })
        // },
    }
})
