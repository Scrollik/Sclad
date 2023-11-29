$(document).ready(function (){
    $('body').on('click','#edit_amount_material',function(){
        var materialURL = $(this).data('url');
        $.get(materialURL,function (data){
            $('#materials_amountModal').modal('show');
            $.each(data, function(i, item) {
                $('#amount_materials').val(data[i].amount);
                $('#id_raw').val(data[i].materials_id);

            })

        })
    })
})

$(function() {
    $("#edit_amount_materials").on('submit',function (e)
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
