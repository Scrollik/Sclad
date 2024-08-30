{{--    Модальное окно регистрации нового пользователя--}}
<div class="modal fade" id="sendingdryerModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Отправка на сушку</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
            </div>
            <form action="{{route('sclad_of_raws.store')}}" method="POST" id="new_send" >
                @csrf
                <div class="modal-body">
                    <div id="materials">
                        <div class="mb-1">
                            <div class="form-group">
                                <label for="date_label" class="form-label mt-1" >Дата отправки:</label>
                                <input for="date" type="date"  class="form-control" id="datepicker_send"  autofocus required name="date" value="">
                                <span class="text-danger error-text date_error mt-3"></span>
                                <label for="dryers_label" class="form-label mt-3" >Выберите в какую сушилку:</label>
                                <select name="id_dryers" id="select_dryers" class="form-control mt-1">
                                    @foreach($dryers as $dryer)
                                        <option value="{{$dryer->id}}">{{$dryer->dryersName}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <h3>Состав отправки:</h3>
                            <table class="table table-bordered" id="materialTable">
                                <tr>
                                    <th>Название материала</th>
                                    <th>Количество</th>
                                    <th>Действие</th>
                                </tr>
{{--                                //]--}}
                                <tr id="material1">
                                    <td> <select name="raw_materials[material_id][1]" id="select_raw_material1" class="form-control">
                                        </select>
                                        <span class="text-danger error-text raw_materials1_error"></span>
                                    </td>
                                    <td>
                                        <input class="form-control form-control-sm active" name="raw_materials[amount][1]"  type="number" required>
                                        <span class="text-danger error-text raw_materials.1.amount_error"></span>
                                        <span class="raw_materials.1.amount"></span>
                                    </td>

                                    <td>
                                        <a href="javascript:void(0)" id="del_mat" data-info="1" class="btn btn-danger  btn-sm">Удалить материал</a>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <a href="javascript:void(0)" id="add_mat" data-url="{{route('sclad_of_raw.formodal')}}" class="btn btn-warning  btn-sm">Добавить материал</a>
                    </div>
                    <span class="text-danger error-text raw_materials_error" ></span>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                    <button type="submit" class="btn btn-primary " id="register_delivery">Создать отправку</button>
                </div>
            </form>

        </div>
    </div>
</div>
{{--    Конец Модальное окно регистрации нового пользователя--}}
