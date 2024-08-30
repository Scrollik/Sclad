$(document).ready(function () {
    $('body').on('click', '#take_order_history', function () {
        var materialURL = $(this).data('url');
        $.get(materialURL, function (data) {
            $('#order_historyModal').modal('show');
            $.each(data, function (i, value) {
                var url = '{{ route("orders.show",' + data[i].id + ') }}';
                var str = '<tr id="history' + i + '">\n' +
                    '                                    <td>\n' +
                    '' + data[i].date + '' +
                    '                                    </td>\n' +
                    '<td>' +
                    '' + data[i].customer + '' +
                    '</td>' +
                    '<td>' +
                    '' + data[i].id + '' +
                    '</td>' +
                    '<td>' +
                    '<a href="javascript:void(0)" id="show_table" data-url="/orders/orders/' + data[i].id + '"\n' +
                    '                               class="btn btn-warning  btn-sm">Просмотр заказа</a>' +
                    '</td>' +
                    '</tr>';
                $('#history_table').append(str);
            })
        })
    })
})

//очистка данных при закрытие модального окна
$(document).ready(function () {
    jQuery(function ($) {
        $('#order_historyModal').on('hidden.bs.modal', function (e) {
            $('#history_table').empty();
        })
    })
})