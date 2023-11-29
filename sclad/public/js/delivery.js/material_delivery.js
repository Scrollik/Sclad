var a = 1;
$(function (){
    $('body').on('click','#create_delivery',function(){
        var materialURL = $(this).data('url');
        $.get(materialURL,function (data){
            $('#deliveryModal').modal('show');
            $.each(data, function(i, item) {
                var string = ''+data[i].name_materials+' '+data[i].height+'x'+data[i].width+' '
                $('#select_material'+a).append($('<option>',{value:data[i].id,text:string}));
            })
        })
    })
})


$(function() {
    $('body').on('click','#add_mat',function(){
        var materialURL = $(this).data('url');
        $.get(materialURL,function (data){
            $.each(data, function(i, item) {
                var string = ''+data[i].name_materials+' '+data[i].height+'x'+data[i].width+' '
                $('#select_material'+a).append($('<option>',{value:data[i].id,text:string }));
            });
        })
        ++a;
        var str = '<tr id="material'+a+'">\n' +
            '                                    <td> <select name="material['+a+'][material_id]" id="select_material'+a+'" class="form-control">\n' +
            '                                        </select>\n' +
            '<span class="text-danger error-text material['+a+'][material_id]"></span>\n'+
            '                                    </td>\n' +
            '                                    <td>\n' +
            '                                        <input class="form-control" name="material['+a+'][amount]" type="number">\n' +
            '<span class="text-danger error-text material.'+a+'.amount_error"></span>\n'+
            '                                    </td>\n' +
            '<td>' +
            '<p onclick="deleteProduct(this)"  class="btn btn-outline-danger btn-sm mt-3" data-info="'+a+'"style="cursor: pointer">Удалить материал</p>'+
            '</td>'+
            '</tr>';
        $('#materialTable').append(str);
    })
})
// Удаление нового продукта
$(function() {
    $('body').on('click','#del_deliv_mat',function(){
        var elem = $(this).data('info');
        var del = document.getElementById("material"+elem);
        $(del).empty();

    })
})
// Удаление нового продукта
$(function() {
    $("#new_delivery").on('submit',function (e)
    {
        e.preventDefault();
        $.ajax({
            method:$(this).attr('method'),
            url:$(this).attr('action'),
            data:new FormData(this),
            processData: false,
            dataType:'json',
            contentType:false,
            beforeSend:function (){
                $(document).find('span.error-text').text('');
            },
            success:function (data) {
                if (data.status === 0) {
                    $.each(data.error, function (prefix, val) {
                        alert  (prefix);
                        $('span.' + prefix + '_error').text(val[0]);
                    })
                } else{
                    location.reload();
                }

            }
        })
     })


})

//очистка данных при закрытие модального окна
$(document).ready(function() {
    jQuery(function($) {
        $('#deliveryModal').on('hidden.bs.modal', function(e) {
            $('#materialTable>tbody').empty();
        })
    })
})

