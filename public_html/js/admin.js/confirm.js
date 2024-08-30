$(document).ready(function () {
    $('body').on('click', '#delete_user', function () {
        $("#confrim_form_user").attr('action', $(this).data('url'));
        $('#confirmed_user_modal').modal('show');
    })
})
