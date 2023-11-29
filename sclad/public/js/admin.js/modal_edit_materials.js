$(document).ready(function (){
    $('body').on('click','#show-materials',function(){
        var materialURL = $(this).data('url');
        $.get(materialURL,function (data){
            $('#materialsModal').modal('show');
                $('#id_materials').val(data.id);
                $('#name_mat').val(data.name_materials);
                $('#materials_width').val(data.width);
                $('#materials_height').val(data.height);

        })
    })
})

$(function() {
    $("#edit_materials").on('submit',function (e)
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
                        $('span.' + prefix + '_error').text(val[0]);
                    })
                }
                else{
                    location.reload();
                }
            }
        })
    })
})



