var a = 1;
$(function () {
    $('body').on('click', '#update_order', function () {
        var orderURL = $(this).data('url');
        var date = $(this).data('date');
        var customer = $(this).data('customer');
        var materialURL = $(this).data('material');
        var id = $(this).data('id');
        $('#updateOrder').modal('show');
        $('#customer').val(customer);
        $('#datepicker_send').val(date);
        $('#order_id').val(id);
        $.get(materialURL, function (materials)
        {
            $.get(orderURL, function (data) {
                $.each(data.data, function (index, value)
                {
                    ++a;
                    var str = '<tr id="orderMaterial' + a + '">\n' +
                        '                                    <td> <select class="form-select" name="materials[material_id][' + a + ']" class="form-control">\n' +
                        '<optgroup label="Сухой Пиломатериал" id="dry_materials' + a + '" ">\n' +
                        '                                                </optgroup>' +
                        ' <optgroup label="Сырой Пиломатериал" id="raw_materials' + a + '">\n' +
                        '                                                </optgroup>' +
                        '                                        </select>\n' +
                        '                                    </td>\n' +
                        '                                    <td id="test">\n' +
                        '                                        <input class="form-control" id="amount'+a+'" required name="materials[amount][' + a + ']" type="number" value="">\n' +
                        '                                    </td>\n' +
                        '<td>' +
                        '<a href="javascript:void(0)" id="del_material" data-info="' + a + '" class="btn btn-danger  btn-sm">Удалить\n' +
                        '                материал</a>' +

                        '</td>' +
                        '</tr>';
                    $('#materialOrderTable').append(str);

                    $.each(materials.dryMaterials, function (i, item) {
                        var string = 'Сухой' + ' ' + item.material.nameMaterials + ' ' + item.material.height + 'x' + item.material.width + ' '
                        if (item.id !== value.scladId) {
                            $('#dry_materials' + a).append($('<option>', {value: item.id, text: string}));
                        } else {
                            $('#dry_materials' + a).append($('<option>', {value: item.id, text: string, selected: true,}));
                            $('#amount'+ a).val(value.amount);
                        }
                    })
                    $.each(materials.rawMaterials, function (i, item) {
                        var string = 'Сырой' + ' ' + item.material.nameMaterials + ' ' + item.material.height + 'x' + item.material.width + ' '
                        if (item.id !== value.scladId) {
                            $('#raw_materials' + a).append($('<option>', {value: item.id, text: string}));
                        } else {
                            $('#raw_materials' + a).append($('<option>', {value: item.id, text: string, selected: true,}));
                            $('#amount'+ a).val(value.amount);
                        }
                    })
                })
            })
        })
    })
})


$(function () {
    $('body').on('click', '#add_material', function () {
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
        var str = '<tr id="orderMaterial' + a + '">\n' +
            '                                    <td> <select name="materials[material_id][' + a + ']" class="form-control">\n' +
            '<optgroup label="Сухой Пиломатериал" id="dry_materials' + a + '" ">\n' +
            '                                                </optgroup>' +
            ' <optgroup label="Сырой Пиломатериал" id="raw_materials' + a + '">\n' +
            '                                                </optgroup>' +
            '                                        </select>\n' +
            '                                    </td>\n' +
            '                                    <td id="test">\n' +
            '                                        <input class="form-control" id="materials[amount][' + a + ']" required name="materials[amount][' + a + ']" type="number">\n' +
            '                                    </td>\n' +
            '<td>' +
            '<a href="javascript:void(0)" id="del_material" data-info="' + a + '" class="btn btn-danger  btn-sm">Удалить\n' +
            '                материал</a>' +

            '</td>' +
            '</tr>';
        $('#materialOrderTable').append(str);
    })
})
// удлаение нового материала
$(function () {
    $('body').on('click', '#del_material', function () {
        var elem = $(this).data('info');
        var del = document.getElementById("orderMaterial" + elem);
        $(del).empty();
    })
})
// Удаление нового продукта
$(function () {
    $("#update_order_form").on('submit', function (e) {
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

//очистка данных при закрытие модального окна
$(document).ready(function () {
    jQuery(function ($) {
        $('#updateOrder').on('hidden.bs.modal', function (e) {
            $('#materialOrderTable>tbody').empty();
        })
    })
})

