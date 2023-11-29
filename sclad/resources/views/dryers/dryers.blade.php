@extends('layouts.master_main')
@section('content')
    <div class="row" id="row_table">
            @forelse($dryers as $dryer)
                <div class="col" >
                    <div class="table-responsive">
                        <table class="table table-bordered mt-3 table-sortable">
                            <h1 class="text-center">{{$dryer ->dryers_name}}</h1>
                            <tr>
                                <th>
                                    Название материала
                                </th>
                                <th>
                                    Количество
                                </th>
                            </tr>
                            <tbody id="bodyTable">
                                @forelse($dryers_table as $item)
                                    <tr>
                                        @if($item->id_dryers == $dryer->id)
                                                <td>(Добавлен {{$item->date->isoFormat('D MMMM YYYY')}})Сырой {{$item->name_materials}} {{$item->height}}x{{$item->width}}</td>
                                                <td>{{$item->amount}} шт.
                                                    ({{($item->height/1000) * ($item->width/1000) *6 * $item->amount}}м3)
                                                </td>
                                        @endif
                                    </tr>
                                @empty
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                        <div class="btn-group" role="group">
                            <a href="javascript:void(0)" id="confirm_dryers"
                               data-url="{{route('dryer.edit',$dryer->id)}}" class="btn btn-warning  btn-sm">Завершить сушку</a>
                        </div>
                </div>
            @empty
            @endforelse


    </div>

@include('dryers.modal.modal_confirm_dryers')

@endsection
@section('script')
    <script src="{{asset('js/dryers.js/table_dryers.js')}}"></script>
@endsection

