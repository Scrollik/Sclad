@extends('layouts.master_main')
@section('content')
    <div class="table-responsive" id="table_delivery">
        <input  class="form-control" type="text" id="myInput" onkeyup="myFunction()" placeholder="Поиск">
        <table class="table table-bordered mt-3 table-sortable" id="myTable2">
    <h1 class="text-center">Поставки</h1>
    <div class="row " >
        <div class="col">
            <a href="javascript:void(0)" id="create_delivery" data-url="{{route('supplies.create')}}" class="btn btn-outline-success btn-sm">Новая поставка</a>
        </div>
        <div class="col col-lg-2">
            <a href="javascript:void(0)" id="delete_delivery" data-url="{{route ('supplies.destroy',0)}}" class="btn btn-outline-danger  btn-sm mx-3">Удалить все поставки</a>
        </div>
    </div>
    <tr>
        <th>
            Дата поставки
        </th>
        <th>
            Действие
        </th>
    </tr>
    <tbody id="bodyTable">
    @forelse($delivery as $supply)
        <tr>
            <td class="dateTd">{{$supply->date->isoFormat('D MMMM YYYY')}}</td>
            <td>
                    <div class="btn-group-vertical" role="group">
                        <a href="javascript:void(0)" id="show_table" data-url="{{route('supplies.show',$supply->id_delivery)}}" class="btn btn-warning  btn-sm">Просмотр поставки</a>
                        <a href="javascript:void(0)" id="delete_delivery" data-url="{{route ('supplies.destroy',$supply->id_delivery)}}" class="btn btn-danger  btn-sm mt-1">Удалить поставку</a>
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
    <script src="{{asset('js/delivery.js/modal_table.js')}}"></script>
    <script src="{{asset('js/delivery.js/material_delivery.js')}}"></script>
    <script src="{{asset('js/delivery.js/confirm.js')}}"></script>
{{--    Полностью рабочий скрипт по поиску записей по буквам--}}
    <script>
        $(document).ready(function(){
            $("#myInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#bodyTable tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
{{--    Полностью рабочий скрипт по поиску записей по буквам--}}
@endsection
