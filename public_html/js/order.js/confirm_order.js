$(document).ready(function () {
    $('body').on('click', '#confirm_order', function () {
        $("#confirm_order_form").attr('action', $(this).data('url'));
        $('#confirm_order_modal').modal('show');
        var str = 'Вы действительно хотите подвтердить выполнение заказа номер: ' + '' + $(this).data('id') + '?';
        $('#confirm').append(str);
    })
})
