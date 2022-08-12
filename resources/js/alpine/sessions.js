export default () => ({
    init() {
        console.log('Initialize Alpine on Sessions List');
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

    // deleteModel(element) {
    //     Swal.fire({
    //         title: $(element).data('confirm') ?? 'O RLY ?',
    //         showDenyButton: true,
    //         showCancelButton: false,
    //         confirmButtonText: $(element).data('confirm-text') ?? 'TAK',
    //         denyButtonText: $(element).data('cancel-text') ?? 'NIE'
    //     }).then((result) => {
    //         /* Read more about isConfirmed, isDenied below */
    //         if (result.isConfirmed) {
    //             $(element).closest('form').submit();
    //         }
    //     })
    // },

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

})
