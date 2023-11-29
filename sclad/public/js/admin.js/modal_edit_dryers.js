$(document).ready(function (){
    $('body').on('click','#show-dryers',function(){
        var dryerURL = $(this).data('url');
        $.get(dryerURL,function (data){
            $('#dryersModal').modal('show');
            $('#id_dryers').val(data.id);
            $('#name_dry').val(data.dryers_name);

        })
    })
})

$(function() {
    $("#edit_dryers").on('submit',function (e)
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



