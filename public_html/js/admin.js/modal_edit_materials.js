$(document).ready(function () {
    $('body').on('click', '#show-materials', function () {
        var materialURL = $(this).data('url');
        $.get(materialURL, function (data) {
            $('#materialsModal').modal('show');
            $('#id_materials').val(data.id);
            $('#name_mat').val(data.nameMaterials);
            $('#materials_width').val(data.width);
            $('#materials_height').val(data.height);

        })
    })
})

$(function () {
    $("#edit_materials").on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            method: $(this).attr('method'),
            url: $(this).attr('action'),
            data: new FormData(this),
            processData: false,
            dataType: 'json',
            contentType: false,
            beforeSend: function () {
                $(document).find('span.error-text').text('');
            },
            error: function (e) {
                if (e.status === 422) {
                    $.each(e.responseJSON.errors, function (key, value) {
                        $('span.' + key + '_error').text(value);
                    });
                } else {
                    location.reload();
                }

            }
        })
    })
})



