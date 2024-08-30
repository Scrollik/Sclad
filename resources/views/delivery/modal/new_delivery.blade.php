{{--    Модальное окно регистрации нового пользователя--}}
<div class="modal fade" id="deliveryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Регистрация новой поставки</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
            </div>
            <form action="{{route('supplies.store')}}" method="POST" id="new_delivery" >
                @csrf
                <div class="modal-body">
                    <div id="materials">
                        <div class="mb-3">
                            <div class="form-group">
                                <label for="amount" class="form-label mt-3" >Дата поставки:</label>
                                <input for="date" type="date"  class="form-control" id="datepicker"  autofocus name="date" value="" required>
                                <span class="text-danger error-text date_error"></span>

                                <label class="form-label mt-3" >Поставщик:</label>
                                <input  type="text"  class="form-control" autofocus name="supplier" value="" required placeholder="Наименование поставщика">
                                <span class="text-danger error-text supplier_error"></span>
                            </div>
                            <h3>Состав поставки:</h3>
                            <table class="table table-bordered" id="materialTable">
                                <tr>
                                    <th>Название материала</th>
                                    <th>Количество</th>
                                    <th>Действие</th>
                                </tr>
                                <tr id="material1">
                                    <td> <select name="material[1][material_id]" id="select_material1" class="form-control">
                                        </select>
                                        <span class="text-danger error-text material.[1].[material_id]_error"></span>
                                    </td>
                                    <td>
                                        <input class="form-control form-control-sm" name="material[1][amount]" type="number" required>
                                        <span class="text-danger error-text material.1.amount_error"></span>
                                        <span class="material.[1].[amount]"></span>
                                    </td>
                                    <td>
                                        <a href="javascript:void(0)" id="del_deliv_mat" data-info="1" class="btn btn-danger  btn-sm">Удалить материал</a>
                                    </td>
                                </tr>
                            </table>
                        </div>
                            </div>
                    <div class="d-flex justify-content-end">
                        <a href="javascript:void(0)" id="add_mat" data-url="{{route('supplies.create')}}" class="btn btn-warning  btn-sm">Добавить материал</a>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                    <button type="submit" class="btn btn-primary " id="register_delivery">Создать поставку</button>
                </div>
            </form>

        </div>
    </div>
</div>
{{--    Конец Модальное окно регистрации нового пользователя--}}
