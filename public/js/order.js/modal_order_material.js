//Внесение данных в таблицу модального окна состав поставки
$(document).ready(function () {
    $('body').on('click', '#show_table', function () {
        var userURL = $(this).data('url');
        $.get(userURL, function (data) {
            $('#order_contents').append('Номер заказа: ' + data.data[0].orderId + '');
            $('#show_tableModal').modal('show');
            $.each(data, function (i, value) {
                $.each(value, function (index, item) {
                    var type = item.material.type === 'dry' ? 'Сухой' : 'Сырой';
                    var str = '<tr id="material' + i + '">\n' +
                        '                                    <td>\n' +
                        ' ' + type + ' ' + item.material.material.nameMaterials + ' ' + item.material.material.height + 'x' + item.material.material.width + '' +
                        '                                    </td>\n' +
                        '<td>' +
                        '' + item.amount + '' +
                        '</td>' +
                        '</tr>';
                    $('#del_table').append(str);
                })


            })


        })
    })
})
// Очистка вносимых данных модального окна
$(document).ready(function () {
    jQuery(function ($) {
        $('#show_tableModal').on('hidden.bs.modal', function (e) {
            $('#del_table>tbody').empty();
            $('.modal-header>#order_contents').empty();
        })
    })
})


