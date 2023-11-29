@extends('layouts.master_main')
@section('content')
    <div class="table-responsive" id="table_delivery">

        <table class="table table-bordered mt-3 table-sortable" id="myTable2">
            <h1 class="text-center">Заказы</h1>
            <div class="row " >
                <div class="col">
                    <a href="javascript:void(0)" id="create_delivery" data-url="{{route('supplies.create')}}" class="btn btn-outline-success btn-sm">Новый заказ</a>
                </div>
                <div class="col col-lg-2">
                    <a href="javascript:void(0)" id="delete_delivery" data-url="{{route ('supplies.destroy',0)}}" class="btn btn-outline-warning  btn-sm mx-3">История заказов</a>
                </div>
            </div>
            <input  class="form-control mt-3" type="text" id="myInput" onkeyup="myFunction()" placeholder="Поиск">
            <tr>
                <th>
                    Дата поставки
                </th>
                <th>
                    Заказчик
                </th>
                <th>
                    Действие
                </th>
            </tr>
            <tbody id="bodyTable">

                <tr>
                    <td class="dateTd">22.11.2023</td>
                    <td>г.Самара</td>
                    <td>
                        <div class="btn-group-vertical" role="group">
                            <a href="javascript:void(0)" id="show_table"  class="btn btn-warning  btn-sm">Просмотр поставки</a>
                            <a href="javascript:void(0)" id="show_table"  class="btn btn-warning  btn-sm mt-1">Выполнить</a>
                            <a href="javascript:void(0)" id="delete_delivery" class="btn btn-danger  btn-sm mt-1">Удалить поставку</a>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    {{--    Подключение моадльных окон--}}


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
