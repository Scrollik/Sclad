@extends('layouts.master_main')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <table class="table table-bordered mt-3 table-sortable">
                    <h1 class="text-center"><a href="{{route('sclad_of_raws')}}">Склад сырого пиломатериала</a></h1>
                    <tr>
                        <th scope="col">
                            Название материала
                        </th>
                        <th scope="col">
                            Количество
                        </th>
                    </tr>
                    <tbody id="bodyTable">
                    @forelse($raws as $raw)
                        <tr>
                            <td>Сырой {{$raw->name_materials}} {{$raw->height}}x{{$raw->width}} </td>
                            <td> {{$raw->sclad_of_raws->amount}} шт.
                                ({{($raw->height/1000) * ($raw->width/1000) *6 * $raw->sclad_of_raws->amount}}м3)
                            </td>
                        </tr>
                    @empty
                        <td>Сырого материала нет</td>
                    @endforelse
                    </tbody>
                </table>
            </div>
            <div class="col">
                <table class="table table-bordered mt-3 table-sortable">
                    <h1 class="text-center"><a href="{{route('sclad_of_dries')}}">Склад сухого пиломатериала</a></h1>
                    <tr>
                        <th scope="col">
                            Название материала
                        </th>
                        <th scope="col">
                            Количество
                        </th>
                    </tr>
                    <tbody id="bodyTable">
                    @forelse($dries as $drie)
                        <tr>
                            <td>Сухой {{$drie->name_materials}} {{$drie->height}}x{{$drie->width}}</td>
                            <td>{{$drie->sclad_of_dries->amount}} шт.
                                ({{($drie->height/1000) * ($drie->width/1000) *6 * $drie->sclad_of_dries->amount}}м3)
                            </td>
                        </tr>
                    @empty
                        <td>Сухого материала нет</td>
                    @endforelse
                    </tbody>
                </table>
            </div>
            <div class="col">
                <a href="{{route('dryer.index')}}">
                <table class="table table-bordered mt-3 table-sortable">
                    <h1 class="text-center"><a href="{{route('dryer.index')}}">Сушилки (Общее количество)</a></h1>
                    <tr>
                        <th scope="col">
                            Название материала
                        </th>
                        <th scope="col">
                            Количество
                        </th>
                    </tr>
                    <tbody id="bodyTable">
                    @forelse($suhs as $suh)
                            <tr>
                                <td>{{$suh->name_materials}} {{$suh->height}}x{{$suh->width}}</td>
                                <td> {{$suh->sum}} шт.
                                    ({{($suh->height/1000) * ($suh->width/1000) *6 * $suh->sum}}м3)
                                </td>
                            </tr>
                    @empty
                        <td>Сушилки пусты</td>
                        <td>Сушилки пусты</td>
                    @endforelse

                    </tbody>
                </table>
                </a>
            </div>

        </div>
    </div>
@endsection
@section('script')

@endsection

