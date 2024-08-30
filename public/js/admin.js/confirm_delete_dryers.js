$(document).ready(function () {
    $('body').on('click', '#delete_dryers', function () {
        $('#delete_dryers_form').attr('action', $(this).data('url'));
        $('#confirmed_dryers_modal').modal('show');
    })
})
