$(document).ready(function () {
    $('body').on('click', '.show-user', function () {
        var userURL = $(this).data('url');
        $.get(userURL, function (data) {
            $('#empModal').modal('show');
            $('#id').val(data.data.id);
            $('input[name="email"]').val(data.data.email);
            $('#name').val(data.data.name);
            $('select#editRole').val(data.data.role);
        })
    })
})
$(document).ready(function () {
    jQuery(function ($) {
        $('#empModall').on('hidden.bs.modal', function (e) {
            $(this).find('form')[0].reset();
        })
    })
})

$(function () {
    $("#edit_users").on('submit', function (e) {
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


