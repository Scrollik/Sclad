@extends('layouts.master_main')
@section('content')
    <div class="table-responsive" id="table_delivery">
        <div>
            <h1 class="text-center">Ревезии</h1>
            <input class="form-control" type="text" id="myInput" onkeyup="myFunction()" placeholder="Поиск">
            <div class="row mt-3">
                <div class="col">
                    <a href="javascript:void(0)" id="create_revision" data-url="{{route('revisions.create')}}"
                       class="btn btn-outline-success btn-sm">Новая ревизия</a>
                </div>
                <div class="col col-lg-2">
                    <a href="javascript:void(0)" id="take_revision_history" data-url="{{route ('revision.history')}}"
                       class="btn btn-outline-warning  btn-sm mx-3">История ревизий</a>
                </div>
            </div>
        </div>

        <table class="table table-bordered mt-3 table-sortable scroll" id="myTable2">
            <thead>
            <tr>
                <th>
                    Дата поставки
                </th>
                <th>
                    Действие
                </th>
            </tr>
            </thead>
            <tbody id="bodyTable" class="overflow-auto">
            @forelse($revisions as $revision)
                <tr>
                    <td class="dateTd">{{$revision->date->isoFormat('D MMMM YYYY')}}</td>
                    <td>
                        <div class="btn-group-vertical" role="group">
                            <a href="javascript:void(0)" id="show_table"
                               data-url="{{route('revision.show',$revision->id)}}"
                               data-accept="{{route('revision.confirm',$revision->id)}}" class="btn btn-warning  btn-sm">Просмотр
                                ревезии</a>
                             <a href="javascript:void(0)" id="delete_revision"
                               data-url="{{route ('revision.destroy',$revision->id)}}"
                               class="btn btn-danger  btn-sm mt-1">Удалить ревезию</a>
                        </div>
                    </td>
                </tr>
            @empty
                <td>Ревизий нет</td>
            @endforelse
            </tbody>
        </table>
    </div>
    {{--    Подключение моадльных окон--}}
    @include('revision.modal.new_revision')
    @include('revision.modal.modal_history_revision')
    @include('revision.modal.modal_history_material')
    @if(!empty($revisions))
        @include('revision.modal.material_revision')
        @include('revision.modal.modal_confirm_delete')
    @endif

    {{--    Конец Подключение моадльных окон--}}
@endsection
@section('script')
    <script src="{{asset('js/revisions/material_revision.js')}}"></script>
    <script src="{{asset('js/revisions/confirm_revision.js')}}"></script>
    <script src="{{asset('js/revisions/modal_history_revision.js')}}"></script>
    <script src="{{asset('js/revisions/confirm_delete_revision.js')}}"></script>
    {{--    Полностью рабочий скрипт по поиску записей по буквам--}}
    <script src="{{asset('js/search_table.js')}}"></script>
    {{--    Полностью рабочий скрипт по поиску записей по буквам--}}
@endsection

