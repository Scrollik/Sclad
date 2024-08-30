$(document).ready(function () {
    $('body').on('click', '#delete_materials', function () {
        $('#delete_materials_form').attr('action', $(this).data('url'));
        $('#confirmed_materials_modal').modal('show');
    })
})
