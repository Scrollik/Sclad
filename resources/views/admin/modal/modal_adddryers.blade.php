{{--    Модальное окно регистрации нового пользователя--}}
<div class="modal fade" id="add_new_dryers" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Создание новой сушилки</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
            </div>
            <form action="{{route('dryers.store')}}" method="POST" id="register_dryers" >
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <div class="form-group">
                            <label for="name" class="form-label mt-3" >Название сушилки:</label>
                            <input type="text"  class="form-control" id="exampleInputEmail1"  placeholder="Сушилка Уличная 1" autofocus name="dryers_name" >
                            <span class="text-danger error-text name_dryers_error"></span>
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
<?php
