$(function () {
    $('body').on('click', '#confirm_dryers', function () {
        var materialURL = $(this).data('url');
        $.get(materialURL, function (data) {
            $('#confirm_dryerModal').modal('show');
            $('#id_dryer').val(data);
        })
    })
})

$(function () {
    $("#confirm_dryer_form").on('submit', function (e) {
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
                }
                else {
                    location.reload();
                }

            }
        })
    })
})


