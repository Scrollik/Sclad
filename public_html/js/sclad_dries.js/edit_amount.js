$(document).ready(function () {
    $('body').on('click', '#edit_amount_dries_material', function () {
        var materialURL = $(this).data('url');
        $.get(materialURL, function (data) {
            $('#materials_amountModal').modal('show');
            $('#amount_materials').val(data.amount);
            $('#id_raw').val(data.id);
        })
    })
})

$(function () {
    $("#edit_amount_materials").on('submit', function (e) {
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
