$(function () {
    $('body').on('click', '#show_table', function () {
        var materialURL = $(this).data('url');
        $("#confirm_form").attr('action', $(this).data('accept'));
        console.log($(this).data('url'));
        $.get(materialURL, function (data) {
            $('#show_tableModal').modal('show');
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
                $('#revision_table').append(str);
            })
        })
    })
})

$(document).ready(function () {
    jQuery(function ($) {
        $('#show_tableModal').on('hidden.bs.modal', function (e) {
            $('#revision_table>tbody').empty();
        })
    })
})
