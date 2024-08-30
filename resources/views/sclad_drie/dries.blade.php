@extends('layouts.master_main')
@section('content')
    <div class="table-responsive">
        <table class="table table-bordered mt-3 table-sortable">
            <h1 class="text-center">Склад сухого пиломатериала</h1>
            @can('role',auth()->user())
                <div class="row " >
                    <div class="col">
                        <a href="javascript:void(0)" id="take_drying_history"
                           data-url="{{route('sclad_of_dries.history')}}" class="btn btn-outline-primary">История сушок</a>
                    </div>
                </div>
            @endcan
            <tr>
                <th scope="col">
                    Название материала
                </th>
                <th scope="col">
                    Количество
                </th>
                @can('role',auth()->user())
                    <th scope="col">
                        Действие
                    </th>
                @endcan
            </tr>
            <tbody id="bodyTable">
            @forelse($dries as $drie)
                    <tr>
                        <td>Сухой {{$drie->material->resolve()->nameMaterials}} {{$drie->material->resolve()->height}}x{{$drie->material->resolve()->width}}</td>
                        <td>{{$drie->amount}} шт.
                            ({{($drie->material->resolve()->height/1000) * ($drie->material->resolve()->width/1000) *6 * $drie->amount}}м3)
                        </td>
                        @can('role',auth()->user())
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="javascript:void(0)" id="edit_amount_dries_material"
                                       data-url="{{route('sclad_of_dries.find',$drie->id)}}" class="btn btn-warning  btn-sm">Изменить
                                        количество</a>
                                </div>
                            </td>
                        @endcan
                    </tr>
            @empty
                <td>Сухого материала нет</td>
            @endforelse
            </tbody>
        </table>
    </div>
    @can('role',auth()->user())
        @forelse($dries as $drie)
            @include('sclad_drie.modal.modal_amount_edit')
            @include('sclad_drie.modal.modal_drying_history')
        @empty
        @endforelse
    @endcan


@endsection
@section('script')
    <script src="{{asset('js/sclad_dries.js/edit_amount.js')}}"></script>
    <script src="{{asset('js/sclad_dries.js/historyTable.js')}}"></script>
@endsection
