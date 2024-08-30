$(document).ready(function () {
    $('body').on('click', '#take_drying_history', function () {
        var materialURL = $(this).data('url');
        $.get(materialURL, function (data) {
            $('#drying_historyModal').modal('show');
            $.each(data, function (i, value) {
                var str = '<tr id="history' + i + '">\n' +
                    '                                    <td>\n' +
                    '' + data[i].date + '' +
                    '                                    </td>\n' +
                    '<td>' +
                    '' + data[i].dryerId + '' +
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
        $('#drying_historyModal').on('hidden.bs.modal', function (e) {
            $('#history_table').empty();
        })
    })
})