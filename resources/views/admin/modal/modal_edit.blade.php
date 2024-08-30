<div class="modal fade" id="empModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Редактирование данных сотрудника </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
            </div>
            <form action="{{route('admin_panel.update')}}" method="POST" id="edit_users">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <input type="hidden" id="id" name="id" value="{{$user->id}}">
                        <div class="form-group">
                            <label for="email" class="form-label ">Эл.Почта сотрудника:</label>
                            <input type="email" class="form-control " id="email" aria-describedby="emailHelp" placeholder="sip-stroy@gmail.com" name="email" value="" >
                            <span class="text-danger error-text email_error"></span>
                        </div>
                        <div class="form-group">
                            <label for="name" class="form-label " >Имя сотрудника:</label>
                            <input type="text"  class="form-control " id="name"  placeholder="Иван" autofocus name="name" value="">
                            <span class="text-danger error-text name_error"></span>
                        </div>
                        <div class="form-group">
                            <p>Выберите роль сотрудника:</p>
                            <select id="editRole" name="role" class="form-select" aria-label="Default select example">
                                @foreach($roles as $role)
                                    <option value={{$role->id}}>{{$role->nameRole}}</option>
                                @endforeach
                            </select>
                        </div>
                            <div class="mb-3">
                                <div class="form-group">
                                <h5>Смена пароля(необязательно):</h5>
                                <label for="password" class="form-label ">Пароль:</label>
                                <input type="password" class="form-control " id="exampleInputPassword1" placeholder="Минимум 8 символов" name="password">
                            </div>
                        </div>
                        </div>
                    </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                    <button type="submit" class="btn btn-primary ">Подтвердить изменения</button>
                </div>
            </form>
        </div>
    </div>
</div>
