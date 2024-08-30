@extends('layouts.master_main')
@section('content')
    <div class="table-responsive" id="table_delivery">
        <div>
            <h1 class="text-center">Поставки</h1>
            <input class="form-control" type="text" id="myInput" onkeyup="myFunction()" placeholder="Поиск">
            <div class="row mt-3">
                <div class="col">
                    <a href="javascript:void(0)" id="create_delivery" data-url="{{route('supplies.create')}}"
                       class="btn btn-outline-success btn-sm">Новая поставка</a>
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
                        Поставщик
                    </th>
                    <th>
                        Действие
                    </th>
                </tr>
                </thead>
                    <tbody id="bodyTable" class="overflow-auto">
                    @forelse($delivery as $supply)
                        <tr>
                            <td class="dateTd">{{$supply->date->isoFormat('D MMMM YYYY')}}</td>
                            <td> {{ $supply->supplier }}</td>
                            <td>
                                <div class="btn-group-vertical" role="group">
                                    <a href="javascript:void(0)" id="show_table_delivery"
                                       data-url="{{route('supplies.show',$supply->id)}}" class="btn btn-warning  btn-sm">Просмотр
                                        поставки</a>
                                    <a href="javascript:void(0)" id="delete_delivery"
                                       data-url="{{route ('supplies.destroy',$supply->id)}}"
                                       class="btn btn-danger  btn-sm mt-1">Удалить поставку</a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <td>Поставок нет</td>
                    @endforelse
                    </tbody>
            </table>
    </div>
    {{--    Подключение моадльных окон--}}
    @include('delivery.modal.new_delivery')


    @forelse($delivery as $supply)
        @include('delivery.modal.modal_show_table')
        @include('delivery.modal.modal_confirmed')
    @empty
    @endforelse

    {{--    Конец Подключение моадльных окон--}}
@endsection
@section('script')
    <script src="{{asset('js/delivery.js/material_delivery.js')}}"></script>
    <script src="{{asset('js/delivery.js/modal_table.js')}}"></script>
    <script src="{{asset('js/delivery.js/confirm.js')}}"></script>
    {{--    Полностью рабочий скрипт по поиску записей по буквам--}}
    <script src="{{asset('js/search_table.js')}}"></script>
    {{--    Полностью рабочий скрипт по поиску записей по буквам--}}
@endsection
