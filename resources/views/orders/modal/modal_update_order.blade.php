<div class="modal fade" id="updateOrder" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Редактирование заказа</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
            </div>
            <form action="{{route('orders.update')}}" method="POST" id="update_order_form" >
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div id="materials">
                        <div class="mb-1">
                            <div class="form-group">
                                <input type="hidden" value="" name="id" id="order_id">
                                <label for="date_label" class="form-label mt-1" >Планируемая дата отправки заказа:</label>
                                <input type="date"  class="form-control" id="datepicker_send"  autofocus name="date" value="" required>
                                <span class="text-danger error-text date_error mt-3"></span>
                                <label for="owner_label" class="form-label mt-1" >Заказчик:</label>
                                <input type="text"  class="form-control"  autofocus name="owner" value="" placeholder="Иванов Иван,г.Самара" id="customer">
                                <span class="text-danger error-text owner_error mt-3"></span>
                                <span class="text-danger error-text materials_error mt-3"></span>
                            </div>
                            <h3>Состав заказа:</h3>
                                <table class="table table-bordered" id="materialOrderTable">
                                    <tr>
                                        <th>Название материала</th>
                                        <th class="th_amount">Кол-во</th>
                                        <th>Действие</th>
                                    </tr>
                                </table>
                                <div class="d-flex justify-content-end">
                                    <a href="javascript:void(0)" id="add_material" data-url="{{route('orders.materials')}}" class="btn btn-warning  btn-sm">Добавить материал</a>
                                </div>
                        </div>
                    </div>
                    <span class="text-danger error-text raw_materials_error" ></span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                    <button type="submit" class="btn btn-primary " id="register_delivery">Создать заказ</button>
                </div>
            </form>

        </div>
    </div>
</div>
