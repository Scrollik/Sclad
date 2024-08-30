@extends('layouts.master_main')
@section('content')
    <div class="px-4 py-4">
        <div class="col-md-12">
            <h1>Сотрудники</h1>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tbody>
                    <tr>
                        <th>
                            Роль
                        </th>
                        <th>
                            Имя
                        </th>
                        <th>
                            Действия
                        </th>
                    </tr>
                    @forelse($users as $user)
                        <tr>
                            @foreach($roles as $role)
                                @if($user->role === $role->id)
                                    <td>{{ $role->nameRole }}</td>
                                @endif
                            @endforeach
                            <td>{{ $user->name }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="javascript:void(0)" data-url="{{route('admin_panel.edit',$user->id)}}"
                                       class="btn btn-warning  btn-sm show-user">Редактировать</a>
                                    <a href="javascript:void(0)" id="delete_user"
                                       data-url="{{route ('admin_panel.destroy',$user->id)}}"
                                       class="btn btn-danger  btn-sm  mx-1">Удалить</a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <td>Пользователей нет</td>
                    @endforelse
                    </tbody>
                </table>
            </div>
            <button type="button" class="btn btn-primary mt-1" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Новый сотрудник
            </button>

            <h1>Пиломатериал</h1>
            <div class="table-responsive">
                <table class="table  table-bordered">
                    <tbody>
                    <tr>
                        <th>
                            #
                        </th>
                        <th>
                            Название
                        </th>
                        <th>
                            Действия
                        </th>
                    </tr>
                    @forelse($materials as $material)
                        <tr>
                            <td>{{ $material->id }}</td>
                            <td>{{ $material->nameMaterials }} {{$material->height}}x{{$material->width}}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="javascript:void(0)" id="show-materials"
                                       data-url="{{route('materials.edit',$material->id)}}"
                                       class="btn btn-warning  btn-sm">Редактировать</a>
                                    <a href="javascript:void(0)" id="delete_materials"
                                       data-url="{{route ('materials.destroy',$material->id)}}"
                                       class="btn btn-danger  btn-sm mx-1">Удалить</a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <td>Материалов нет</td>
                    @endforelse
                    </tbody>
                </table>
            </div>
            <button type="button" class="btn btn-warning mt-1" data-bs-toggle="modal"
                    data-bs-target="#add_new_material">
                Добавить новый пиломатериал
            </button>

            <h1>Сушилки</h1>
            <div class="table-responsive">
                <table class="table  table-bordered">
                    <tbody>
                    <tr>
                        <th>
                            Название
                        </th>
                        <th>
                            Действия
                        </th>
                    </tr>
                    @forelse($dryers as $dryer)
                        <tr>
                            <td>{{ $dryer->dryersName }} </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="javascript:void(0)" id="show-dryers"
                                       data-url="{{route('dryers.edit',$dryer->id)}}" class="btn btn-warning  btn-sm">Редактировать</a>
                                    <a href="javascript:void(0)" id="delete_dryers"
                                       data-url="{{route ('dryers.destroy',$dryer->id)}}"
                                       class="btn btn-danger  btn-sm mx-1">Удалить</a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <td>Сушилок нет</td>
                    @endforelse
                    </tbody>
                </table>
            </div>
            <button type="button" class="btn btn-warning mt-1" data-bs-toggle="modal" data-bs-target="#add_new_dryers">
                Добавить новую сушилку
            </button>
            {{--    Подключение модальных окон--}}


            @include('admin.modal.modal_register')
            @include('admin.modal.modal_addmaterials')
            @include('admin.modal.modal_adddryers')
            @forelse($users as $user)
                @include('admin.modal.modal_edit')
                @include('admin.modal.modal_confrimed')
            @empty
            @endforelse

            @forelse($materials as $material)
                @include('admin.modal.modal_confirmed_materials')
                @include('admin.modal.modal_edit_materials')
            @empty
            @endforelse
            @forelse($dryers as $dryer)
                @include('admin.modal.modal_confirmed_dryers')
                @include('admin.modal.modal_edit_dryers')
            @empty
            @endforelse
            {{--    Конец Подключение модальных окон--}}
        </div>
    </div>
@endsection
{{--Подключение скриптов--}}
@section('script')
    <script src="{{asset('js/admin.js/main.js')}}"></script>
    <script src="{{asset('js/admin.js/modal_register_materials.js')}}"></script>
    <script src="{{asset('js/admin.js/modal_register_dryers.js')}}"></script>
    @forelse($users as $user)
        <script src="{{asset('js/admin.js/modal_edit.js')}}"></script>
        <script src="{{asset('js/admin.js/confirm.js')}}"></script>
    @empty
    @endforelse

    @forelse($materials as $material)
        <script src="{{asset('js/admin.js/confirm_delete_materials.js')}}"></script>
        <script src="{{asset('js/admin.js/modal_edit_materials.js')}}"></script>
    @empty
    @endforelse

    @forelse($dryers as $dryer)
        <script src="{{asset('js/admin.js/confirm_delete_dryers.js')}}"></script>
        <script src="{{asset('js/admin.js/modal_edit_dryers.js')}}"></script>
    @empty
    @endforelse
@endsection
{{--Подключение скриптов--}}
