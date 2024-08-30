var a = 1;
$(function () {
    $('body').on('click', '#new_order', function () {
        var materialURL = $(this).data('url');
        $.get(materialURL, function (data) {
            $('#newOrder').modal('show');
            $.each(data.dryMaterials, function (i, item) {
                var string = 'Сухой' + ' ' + item.material.nameMaterials + ' ' + item.material.height + 'x' + item.material.width + ' '
                $('#dry_materials' + a).append($('<option>', {value: item.id, text: string}));
            })
            $.each(data.rawMaterials, function (i, item) {
                var string = 'Сырой' + ' ' + item.material.nameMaterials + ' ' + item.material.height + 'x' + item.material.width + ' '
                $('#raw_materials' + a).append($('<option>', {value: item.id, text: string}));
            })
        })
    })
})


$(function () {
    $('body').on('click', '#add_mat', function () {
        var materialURL = $(this).data('url');
        $.get(materialURL, function (data) {
            $.each(data.dryMaterials, function (i, item) {
                var string = 'Сухой' + ' ' + item.material.nameMaterials + ' ' + item.material.height + 'x' + item.material.width + ' '
                $('#dry_materials' + a).append($('<option>', {value: item.id, text: string}));
            })
            $.each(data.rawMaterials, function (i, item) {
                var string = 'Сырой' + ' ' + item.material.nameMaterials + ' ' + item.material.height + 'x' + item.material.width + ' '
                $('#raw_materials' + a).append($('<option>', {value: item.id, text: string}));
            })
        })
        ++a;
        var str = '<tr id="material' + a + '">\n' +
            '                                    <td> <select name="materials[material_id][' + a + ']" class="form-control">\n' +
            '<optgroup label="Сухой Пиломатериал" id="dry_materials' + a + '" ">\n' +
            '                                                </optgroup>' +
            ' <optgroup label="Сырой Пиломатериал" id="raw_materials' + a + '">\n' +
            '                                                </optgroup>' +
            '                                        </select>\n' +
            '                                    </td>\n' +
            '                                    <td id="test">\n' +
            '                                        <input class="form-control" required name="materials[amount][' + a + ']" type="number">\n' +
            '                                    </td>\n' +
            '<td>' +
            '<a href="javascript:void(0)" id="del_mat" data-info="' + a + '" class="btn btn-danger  btn-sm">Удалить\n' +
            '                материал</a>' +

            '</td>' +
            '</tr>';
        $('#materialTable').append(str);
    })
})
// удлаение нового материала
$(function () {
    $('body').on('click', '#del_mat', function () {
        var elem = $(this).data('info');
        var del = document.getElementById("material" + elem);
        $(del).empty();
    })
})
// Удаление нового продукта
$(function () {
    $("#new_send").on('submit', function (e) {
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
            success: function ()
            {
                location.reload();
            },
            error: function (e) {
                if (e.status === 422) {
                    $.each(e.responseJSON.errors, function (key, value) {
                        $('span.' + key + '_error').text(value);
                    });
                } else if (e.status === 500) {
                    $('span.' + 'base_error').text(e.responseJSON.message);
                }
            }

        })
    })


})

//очистка данных при закрытие модального окна
$(document).ready(function () {
    jQuery(function ($) {
        $('#sendingdryerModal').on('hidden.bs.modal', function (e) {
            $('#materialTable>tbody').empty();
        })
    })
})

