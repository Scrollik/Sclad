@extends('layouts.master_main')
@section('content')
    <div class="table-responsive">
        <table class="table table-bordered mt-3 table-sortable" id="myTable">
            <h1 class="text-center">Склад сырого пиломатериала</h1>
            @can('role',auth()->user())
                <div class="row ">
                    <div class="col">
                        <a href="{{route('supplies.index')}}" class="btn btn-outline-primary  ">История поставок</a>
                    </div>
                    <div class="col col-lg-2">
                        <a href="javascript:void(0)" id="sending_dryer"
                           data-url="{{route('sclad_of_raw.formodal')}}" class="btn btn-outline-success">Отправить в
                            сушилку</a>
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
            @forelse($raws as $raw)
                <tr>
                    <td>Сырой {{$raw->material->nameMaterials}} {{$raw->material->height}}x{{$raw->material->width}}</td>
                    <td>{{$raw->amount}} шт.
                        ({{($raw->material->height/1000) * ($raw->material->width/1000) *6 * $raw->amount}}м3)
                    </td>
                    @can('role',auth()->user())
                        <td>
                            <div class="btn-group" role="group">
                                <a href="javascript:void(0)" id="edit_amount_material"
                                   data-url="{{route('sclad_of_raws.find',$raw->id)}}" class="btn btn-warning  btn-sm">Изменить
                                    количество</a>
                            </div>
                        </td>
                    @endcan
                </tr>
            @empty
                <td>Сырого материала нет</td>
            @endforelse
            </tbody>
        </table>
    </div>
    @can('role',auth()->user())
        @forelse($raws as $raw)
            @include('sclad_raw.modal.modal_amount_edit')
            @include('sclad_raw.modal.modal_sending_dryer')
        @empty
        @endforelse
    @endcan

@endsection
@section('script')
    <script src="{{asset('js/sclad_raws.js/edit_amount.js')}}"></script>
    <script src="{{asset('js/sclad_raws.js/sending_dryes.js')}}"></script>
@endsection
