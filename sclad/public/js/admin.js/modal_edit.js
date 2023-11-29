$(document).ready(function (){
    $('body').on('click','.show-user',function(){
        var userURL = $(this).data('url');
        $.get(userURL,function (data){
            $('#empModal').modal('show');
            $('#id').val(data.id);
            $('input[name="email"]').val(data.email);
            $('#name').val(data.name);
            $('select#editRole').val(data.role);
        })
    })
})
$(document).ready(function() {
    jQuery(function($) {
        $('#empModall').on('hidden.bs.modal', function(e) {
            $(this).find('form')[0].reset();
        })
    })
})

$(function() {
    $("#edit_users").on('submit',function (e)
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



