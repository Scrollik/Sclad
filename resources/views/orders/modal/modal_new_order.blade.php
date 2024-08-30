<div class="modal fade" id="newOrder" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Создание нового заказа</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
            </div>
            <form action="{{route('orders.store')}}" method="POST" id="new_send" >
                @csrf
                <div class="modal-body">
                    <div id="materials">
                        <div class="mb-1">
                            <div class="form-group">
                                <span class="text-danger error-text base_error mt-3 md-3"></span>
                                <label for="date_label" class="form-label mt-1" >Планируемая дата отправки заказа:</label>
                                <input for="date" type="date"  class="form-control" id="datepicker_send"  autofocus name="date" value="" required>
                                <span class="text-danger error-text date_error mt-3"></span>
                                <label for="owner_label" class="form-label mt-1" >Заказчик:</label>
                                <input for="owner" type="text"  class="form-control"  autofocus name="owner" value="" placeholder="Иванов Иван,г.Самара">
                                <span class="text-danger error-text owner_error mt-3"></span>
                            </div>
                            <h3>Состав заказа:</h3>
                                <table class="table table-bordered" id="materialTable">
                                    <tr>
                                        <th>Название материала</th>
                                        <th class="th_amount">Кол-во</th>
                                        <th>Действие</th>
                                    </tr>
                                    <tr id="material1">
                                        <td>
                                            <select class="form-control multiple-task" name="materials[material_id][1]">
                                                <optgroup label="Сухой Пиломатериал" id="dry_materials1">
                                                </optgroup>
                                                <optgroup label="Сырой Пиломатериал" id="raw_materials1">
                                                </optgroup>
                                            </select>
                                        </td>
                                        <td>
                                            <input class="form-control form-control-sm active" name="materials[amount][1]"  type="number" required>
                                        </td>
                                        <td>
                                            <a href="javascript:void(0)" id="del_mat" data-info="1" class="btn btn-danger  btn-sm">Удалить материал</a>
                                        </td>
                                    </tr>
                                </table>
                            <span class="text-danger error-text materials_error"></span>
                            <span class="text-danger error-text materials.1.amount_error"></span>
                                <div class="d-flex justify-content-end">
                                    <a href="javascript:void(0)" id="add_mat" data-url="{{route('orders.materials')}}" class="btn btn-warning  btn-sm">Добавить материал</a>
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
