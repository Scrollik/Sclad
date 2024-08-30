$(document).ready(function () {
    $('body').on('click', '#delete_order', function () {
        $('#delete_order_form').attr('action', $(this).data('url'));
        $('#delete_confirm_order_modal').modal('show');
    })
})
