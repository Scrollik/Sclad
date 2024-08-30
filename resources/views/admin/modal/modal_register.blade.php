{{--    Модальное окно регистрации нового пользователя--}}
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Регистрация нового сотрудника</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
            </div>
            <form action="{{route('admin_panel.store')}}" method="POST" id="register_users" >
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <div class="form-group">
                            <label for="email" class="form-label">Эл.Почта сотрудника:</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="sip-stroy@gmail.com" name="email" value="{{old('name_sotr')}}">
                            <span class="text-danger error-text email_error"></span>
                        </div>

                        <div class="form-group">
                            <label for="name" class="form-label mt-3" >Имя сотрудника:</label>
                            <input type="text"  class="form-control" id="exampleInputEmail1"  placeholder="Иван" autofocus name="name_sotr" value="{{old('name_sotr')}}">
                            <span class="text-danger error-text name_sotr_error"></span>
                        </div>

                        <div class="form-group">
                            <p>Выберите роль сотрудника:</p>
                            <select name="role_rab" class="form-select" aria-label="Default select example">
                                @foreach($roles as $role)
                                    <option value="{{$role->id}}">{{$role->nameRole}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-group">
                            <label for="password" class="form-label ">Пароль:</label>
                            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Минимум 8 символов" name="password">
                            <span class="text-danger error-text password_error"></span>
                        </div>
                        <div class="form-group">
                            <label for="password_confirmed " class="form-label">Повторите пароль:</label>
                            <input type="password" class="form-control" id="exampleInputPassword1" name="password_confirmation">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                    <button type="submit" class="btn btn-primary " id="btn_register">Зарегистрировать</button>
                </div>
            </form>

        </div>
    </div>
</div>
{{--    Конец Модальное окно регистрации нового пользователя--}}
