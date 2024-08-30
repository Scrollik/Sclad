$(document).ready(function () {
    $('body').on('click', '#show-dryers', function () {
        var dryerURL = $(this).data('url');
        $.get(dryerURL, function (data) {
            $('#dryersModal').modal('show');
            $('#id_dryers').val(data.id);
            $('#name_dry').val(data.dryersName);
        })
    })
})

$(function () {
    $("#edit_dryers").on('submit', function (e) {
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



