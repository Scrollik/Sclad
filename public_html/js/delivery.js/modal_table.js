//Внесение данных в таблицу модального окна состав поставки
$(document).ready(function () {
    $('body').on('click', '#show_table_delivery', function () {
        var userURL = $(this).data('url');
        $.get(userURL, function (data) {
            $('#delivery_contents').append('Поставка:' + data['delivery'].date + '');
            $('#show_tableModal').modal('show');
            $.each(data['material'], function (i, value) {
                var str = '<tr id="material' + i + '">\n' +
                    '                                    <td>\n' +
                    '' + data['material'][i].nameMaterials + ' ' + data['material'][i].height + 'x' + data['material'][i].width + '' +
                    '                                    </td>\n' +
                    '<td>' +
                    '' + data['material'][i].amount + '' +
                    '</td>' +
                    '</tr>';
                $('#del_table').append(str);

            })


        })
    })
})
// Очистка вносимых данных модального окна
$(document).ready(function () {
    jQuery(function ($) {
        $('#show_tableModal').on('hidden.bs.modal', function (e) {
            $('#del_table>tbody').empty();
            $('.modal-header>#delivery_contents').empty();
        })
    })
})


