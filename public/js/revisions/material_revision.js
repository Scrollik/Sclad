var a = 1;
$(function () {
    $('body').on('click', '#create_revision', function () {
        var materialURL = $(this).data('url');
        $.get(materialURL, function (data) {
            $('#revisionModal').modal('show');
            $.each(data, function (i, item) {
                var string = '' + data[i].nameMaterials + ' ' + data[i].height + 'x' + data[i].width + ' '
                $('#select_material' + a).append($('<option>', {value: data[i].id, text: string}));
            })
        })
    })
})


$(function () {
    $('body').on('click', '#add_mat', function () {
        var materialURL = $(this).data('url');
        $.get(materialURL, function (data) {
            $.each(data, function (i, item) {
                var string = '' + data[i].nameMaterials + ' ' + data[i].height + 'x' + data[i].width + ' '
                $('#select_material' + a).append($('<option>', {value: data[i].id, text: string}));
            });
        })
        ++a;
        var str = '<tr id="material' + a + '">\n' +
            '                                    <td> <select name="material[' + a + '][id]" id="select_material' + a + '" class="form-control">\n' +
            '                                        </select>\n' +
            '<span class="text-danger error-text material[' + a + '][id]"></span>\n' +
            '                                    </td>\n' +
            '                                    <td> <select name="material[' + a + '][type]" id="select_type' + a + '" class="form-control">\n' +
            '  <option value="dry">Сухой</option>\n' +
            '  <option value="raw">Сырой</option>\n' +
            '                                        </select>\n' +
            '<span class="text-danger error-text material[' + a + '][type]"></span>\n' +
            '                                    </td>\n' +
            '                                    <td>\n' +
            '                                        <input class="form-control" required name="material[' + a + '][amount_material]" type="number">\n' +
            '<span class="text-danger error-text material.' + a + '.amount_material"></span>\n' +
            '                                    </td>\n' +
            '<td>' +
            ' <a href="javascript:void(0)" id="del_deliv_mat" data-info="' + a + '" class="btn btn-danger  btn-sm">Удалить материал</a>' +
            '</td>' +
            '</tr>';
        $('#materialTable').append(str);
    })
})
// Удаление нового продукта
$(function () {
    $('body').on('click', '#del_deliv_mat', function () {
        var elem = $(this).data('info');
        var del = document.getElementById("material" + elem);
        $(del).empty();

    })
})
// Удаление нового продукта
$(function () {
    $("#new_revision").on('submit', function (e) {
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
                        $('span.' + 'date_error').text(value);
                    });
                }
                else {
                    location.reload();
                }

            }
        })
    })


})

//очистка данных при закрытие модального окна
$(document).ready(function () {
    jQuery(function ($) {
        $('#revisionModal').on('hidden.bs.modal', function (e) {
            $('#materialTable>tbody').empty();
        })
    })
})

