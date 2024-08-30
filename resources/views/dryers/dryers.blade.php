@php
/**
 *@var \App\Data\MaterialData $item
 */
@endphp

@extends('layouts.master_main')
@section('content')
    <div class="row" id="row_table">
        @forelse($dryers as $dryer)
            <div class="col">
                <div class="table-responsive">
                    <table class="table table-bordered mt-3 table-sortable">
                        <h1 class="text-center">{{$dryer ->dryersName}}</h1>
                        <tr>
                            <th>
                                Название материала
                            </th>
                            <th>
                                Количество
                            </th>
                        </tr>
                        <tbody id="bodyTable">
{{--                        ->isoFormat('D MMMM YYYY')--}}
                        @forelse($dryersTable as $history)
                            @foreach($history->dryingMaterials->resolve() as $item)
                                    <tr>
                                        @if($history->dryerId == $dryer->id)
                                            <td>(Добавлен {{$history->date}}
                                                )Сырой {{$item->nameMaterials}} {{$item->height}}x{{$item->width}}</td>
                                            <td>{{$item->amount}} шт.
                                                ({{($item->height/1000) * ($item->width/1000) *6 * $item->amount}}
                                                м3)
                                            </td>
                                        @endif
                                    </tr>
                            @endforeach
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
            <div class="table-responsive">
                <table class="table table-bordered mt-3 table-sortable">
                    <h1 class="text-center">Пусто</h1>
                    <tr>
                        <th>
                            Название материала
                        </th>
                        <th>
                            Количество
                        </th>
                    </tr>
                    <tbody id="bodyTable">
                    @forelse($dryersTable as $item)
                        <tr>
                            @if($item->id_dryers == $dryer->id)
                                <td>Пусто</td>
                                <td>Пусто</td>
                            @endif
                        </tr>
                    @empty
                    @endforelse
                    </tbody>
                </table>
            </div>
        @endforelse


    </div>
    @forelse($dryers as $dryer)
        @include('dryers.modal.modal_confirm_dryers')
    @empty
    @endforelse

@endsection
@section('script')
    <script src="{{asset('js/dryers.js/table_dryers.js')}}"></script>
@endsection

