{{--    Модальное окно регистрации нового пользователя--}}
<div class="modal fade" id="add_new_material" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Создание нового материала</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
            </div>
            <form action="{{route('materials.store')}}" method="POST" id="register_materials" >
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <div class="form-group">
                            <label for="name" class="form-label mt-3" >Название пиломатериала:</label>
                            <input type="text"  class="form-control" id="exampleInputEmail1"  placeholder="Доска" autofocus name="name_materials" value="{{old('name_mat')}}">
                            <span class="text-danger error-text name_materials_error"></span>
                            <div class="input-group mb-3 mt-3">
                                <input type="number" class="form-control" placeholder="Высота" name="height" >
                                <span class="text-danger error-text height_error"></span>
                                <span class="input-group-text">X</span>
                                <input type="number" class="form-control" placeholder="Ширина" name="width">
                                <span class="text-danger error-text width_error"></span>
                            </div>
                        </div>
                    </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                    <button type="submit" class="btn btn-primary " id="btn_register">Зарегистрировать</button>
                </div>
                </div>
            </form>
        </div>
    </div>
</div>
{{--    Конец Модальное окно регистрации нового пользователя--}}
