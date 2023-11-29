$(function (){
    $('body').on('click','#confirm_dryers',function(){
        var materialURL = $(this).data('url');
        $.get(materialURL,function (data){
            $('#confirm_dryerModal').modal('show');
            $('#id_dryer').val(data);
        })
    })
})
