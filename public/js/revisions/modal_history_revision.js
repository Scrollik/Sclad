$(document).ready(function () {
    $('body').on('click', '#take_revision_history', function () {
        var materialURL = $(this).data('url');
        $.get(materialURL, function (data) {
            $('#history_revisionModal').modal('show');
            $.each(data, function (i, value) {
                var str = '<tr id="history' + i + '">\n' +
                    '                                    <td>\n' +
                    '' + data[i].date + '' +
                    '                                    </td>\n' +
                    '<td>' +
                    '<a href="javascript:void(0)" id="show_material" data-url="/revision/showRevision/' + data[i].id + '"\n' +
                    '                               class="btn btn-warning  btn-sm">Просмотр ревизии</a>' +
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
        $('#history_revisionModal').on('hidden.bs.modal', function (e) {
            $('#history_table').empty();
        })
    })
})


$(function () {
    $('body').on('click', '#show_material', function () {
        var materialURL = $(this).data('url');
        $.get(materialURL, function (data) {
            $('#show_tableHistoryModal').modal('show');
            $.each(data.data, function (i, item) {
                var type;
                if (item.type === 'dry')
                {
                    type = 'Сухой';
                }else{
                    type = 'Сырой';
                }
                var str = '<tr id="material' + i + '">\n' +
                    '                                    <td> ' + type + ' '+ item.material.nameMaterials +' ' + item.material.height + 'x' + item.material.width + ' \n'+
                    '                                    </td>\n' +
                    '                                    <td> '+ item.oldAmount +' \n' +
                    '                                    </td>\n' +
                    '                                    <td> '+ item.amount +' \n' +
                    '                                    </td>\n' +
                    '</tr>';
                $('#revision_history_table').append(str);
            })
        })
    })
})

$(document).ready(function () {
    jQuery(function ($) {
        $('#show_tableHistoryModal').on('hidden.bs.modal', function (e) {
            $('#revision_history_table>tbody').empty();
        })
    })
})
