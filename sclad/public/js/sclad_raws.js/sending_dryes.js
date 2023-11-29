var a = 1;
$(function (){
    $('body').on('click','#sending_dryer',function(){
        var materialURL = $(this).data('url');
        $.get(materialURL,function (data){
            $('#sendingdryerModal').modal('show');
            $.each(data, function(i, item) {
                var string = ''+data[i].name_materials+' '+data[i].height+'x'+data[i].width+' '
                $('#select_raw_material'+a).append($('<option>',{value:data[i].id,text:string}));
                $('#select_dryers'+a).append($('<option>',{value:data[i].id,text:string}));
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
                $('#select_raw_material'+a).append($('<option>',{value:data[i].id,text:string }));
            });
        })
        ++a;
        var str = '<tr id="material'+a+'">\n' +
            '                                    <td> <select name="raw_materials['+a+'][material_id]" id="select_raw_material'+a+'" class="form-control">\n' +
            '                                        </select>\n' +
            '<span class="text-danger error-text raw_materials['+a+'][material_id]"></span>\n'+
            '                                    </td>\n' +
            '                                    <td id="test">\n' +
            '                                        <input class="form-control" name="raw_materials['+a+'][amount]" type="number">\n' +
            '<span class="text-danger error-text raw_materials.'+a+'.amount_error"></span>\n'+
            '                                    </td>\n' +
            '<td>' +
            '<a href="javascript:void(0)" id="del_mat" data-info="'+a+'" class="btn btn-danger  btn-sm">Удалить\n' +
            '                материал</a>'+

            '</td>'+
            '</tr>';
        $('#materialTable').append(str);
    })
})
// удлаение нового материала
$(function() {
    $('body').on('click','#del_mat',function(){
        var elem = $(this).data('info');
        var del = document.getElementById("material"+elem);
        $(del).empty();
    })
})
// Удаление нового продукта
$(function() {
    $("#new_send").on('submit',function (e)
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
                        console.log(val);
                        $('span[class="text-danger error-text '+prefix+'_error"]').text(val[0]);
                    })
                }else {
                    location.reload();
                }

            }
        })
    })


})

//очистка данных при закрытие модального окна
$(document).ready(function() {
    jQuery(function($) {
        $('#sendingdryerModal').on('hidden.bs.modal', function(e) {
            $('#materialTable>tbody').empty();
        })
    })
})

