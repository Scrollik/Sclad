$(document).ready(function () {
    $('body').on('click', '#delete_delivery', function () {
        $("#confrim_form").attr('action', $(this).data('url'));
        $('#confirmed_modal').modal('show');
    })
})
