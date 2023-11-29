//Внесение данных в таблицу модального окна состав поставки
$(document).ready(function (){
    $('body').on('click','#show_table',function(){
        var userURL = $(this).data('url');
        $.get(userURL,function (data){
            $('#delivery_contents').append('Поставка:'+data[0].date+'');
            $('#show_tableModal').modal('show');
            $.each(data,function (i,value){

                var str = '<tr id="material'+i+'">\n' +
                    '                                    <td>\n' +
                    ''+data[i].name_materials+' '+data[i].height+'x'+data[i].width+''+
                    '                                    </td>\n' +
                    '<td>' +
                    ''+data[i].amount+''+
                    '</td>'+
                    '</tr>';
                $('#del_table').append(str);

            })


        })
    })
})
// Очистка вносимых данных модального окна
$(document).ready(function() {
    jQuery(function($) {
        $('#show_tableModal').on('hidden.bs.modal', function(e) {
            $('#del_table>tbody').empty();
            $('.modal-header>#delivery_contents').empty();
        })
    })
})


