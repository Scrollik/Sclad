@extends('layouts.master_main')
@section('content')
    <div class="table-responsive" id="table_delivery">

        <table class="table table-bordered mt-3 table-sortable table-responsive" id="myTable2">
            <h1 class="text-center">Заказы</h1>
            <div class="row ">
                <div class="col">
                    @can('role',auth()->user())
                        <a href="javascript:void(0)" id="new_order" data-url="{{route('orders.materials')}}"
                           class="btn btn-outline-success btn-sm">Новый заказ</a>
                    @endcan
                </div>
                <div class="col col-lg-2">
                    <a href="javascript:void(0)" id="take_order_history" data-url="{{route ('orders.history')}}"
                       class="btn btn-outline-warning  btn-sm mx-3">История отгрузок</a>
                </div>
            </div>
            <input class="form-control mt-3" type="text" id="myInput" onkeyup="myFunction()" placeholder="Поиск">
            <tr>
                <th>
                    Номер заказа
                </th>
                <th>
                    Планируемая дата отгрузки
                </th>
                <th>
                    Заказчик
                </th>
                <th>
                    Действие
                </th>
            </tr>
            <tbody id="bodyTable">
            @foreach($orders as $order)
                <tr>
                    <td> {{ $order->id }}</td>
                    <td class="dateTd">{{ $order->date->isoFormat('D MMMM YYYY') }}</td>
                    <td>{{ $order->customer }}</td>
                    <td>
                        <div class="btn-group-vertical" role="group">
                            <a href="javascript:void(0)" id="show_table" data-url="{{route('orders.show',$order->id)}}"
                               class="btn btn-warning  btn-sm">Просмотр заказа</a>
                            <a href="javascript:void(0)" id="update_order"
                               data-url="{{route('orders.show',$order->id)}}" data-material="{{route('orders.materials')}}"
                               data-date="{{$order->date->format('Y-m-d')}}" data-customer="{{$order->customer}}" data-id="{{ $order->id }}"
                               class="btn btn-warning  btn-sm mt-1">Редактировать заказ</a>
                            @can('role',auth()->user())
                                <a href="javascript:void(0)" id="confirm_order"
                                   data-url="{{route('orders.confirm',$order->id)}}" data-id="{{ $order->id }}"
                                   class="btn btn-warning  btn-sm mt-1">Подтвердить выполнение</a>
                                <a href="javascript:void(0)" id="delete_order"
                                   data-url="{{route('orders.destroy',$order->id)}}"
                                   class="btn btn-danger  btn-sm mt-1">Удалить
                                    заказ</a>
                            @endcan
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>



    {{--    Подключение моадльных окон--}}
    @include('orders.modal.modal_update_order')
    @include('orders.modal.modal_order_materials')
    @include('orders.modal.modal_confirmed_order')
    @include('orders.modal.modal_confirmed_end')
    @include('orders.modal.modal_history_order')
    @include('orders.modal.modal_update_order')
    @include('orders.modal.modal_new_order')

    {{--    Конец Подключение моадльных окон--}}
@endsection
@section('script')
    <script src="{{asset('js/order.js/update_order.js')}}"></script>
    <script src="{{asset('js/order.js/modal_new_order.js')}}"></script>
    <script src="{{asset('js/order.js/modal_order_material.js')}}"></script>
    <script src="{{asset('js/order.js/confirm_delete_order.js')}}"></script>
    <script src="{{asset('js/order.js/confirm_order.js')}}"></script>
    <script src="{{asset('js/order.js/modal_history_order.js')}}"></script>
    {{--    Полностью рабочий скрипт по поиску записей по буквам--}}
    <script src="{{asset('js/search_table.js')}}"></script>
    {{--    Полностью рабочий скрипт по поиску записей по буквам--}}
@endsection
