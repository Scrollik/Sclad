$(document).ready(function () {
    $('body').on('click', '#delete_revision', function () {
        $("#confrim_form").attr('action', $(this).data('url'));
        $('#confirmed_modal').modal('show');
    })
})