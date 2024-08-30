@extends('layouts.master_main')
@section('content')
    <div class="container">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2">
            <div class="col">
                <a href="{{ route('sclad_of_raws') }}">
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
                            <td>
                                Сырой {{$raw->material->resolve()->nameMaterials}} {{$raw->material->resolve()->height}}x{{$raw->material->resolve()->width}} </td>
                            <td> {{$raw->amount}} шт.
                                ({{($raw->material->resolve()->height/1000) * ($raw->material->resolve()->width/1000) *6 * $raw->amount}}
                                м3)
                            </td>
                        </tr>
                    @empty
                        <td>Сырого материала нет</td>
                    @endforelse
                    </tbody>
                </table>
                </a>
            </div>
            <div class="col">
                <a href="{{ route('sclad_of_dries') }}">
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
                            <td>
                                Сухой {{$drie->material->resolve()->nameMaterials}} {{$drie->material->resolve()->height}}x{{$drie->material->resolve()->width}}</td>
                            <td>{{$drie->amount}} шт.
                                ({{($drie->material->resolve()->height/1000) * ($drie->material->resolve()->width/1000) *6 * $drie->amount}}
                                м3)
                            </td>
                        </tr>
                    @empty
                        <td>Сухого материала нет</td>
                    @endforelse
                    </tbody>
                </table>
                </a>
            </div>
            <div class="col">
                <a href="{{route('dryer.index')}}">
                    <table class="table table-bordered mt-3 table-sortable">
                        <h1 class="text-center"><a href="{{route('dryer.index')}}">Общее количество Сушилки</a></h1>
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
                                <td>{{$suh['name']}} {{$suh['height']}}x{{$suh['width']}}</td>
                                <td> {{$suh['amount']}} шт.
                                    ({{($suh['height']/1000) * ($suh['width']/1000) *6 * $suh['amount']}}м3)
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

            <div class="col">
                <a href="{{route('orders.index')}}">
                    <table class="table table-bordered mt-3 table-sortable">
                        <h1 class="text-center"><a href="{{route('orders.index')}}"> Общее количество Заказы</a></h1>
                        <tr>
                            <th scope="col">
                                Название материала
                            </th>
                            <th scope="col">
                                Количество
                            </th>
                        </tr>
                        <tbody id="bodyTable">
                        @forelse($orders as $order)
                            <tr>
                                <td>{{$order['name']}} {{$order['height']}}x{{$order['width']}}</td>
                                <td> {{$order['amount']}} шт.
                                    ({{($order['height']/1000) * ($order['width']/1000) *6 * $order['amount']}}м3)
                                </td>
                            </tr>
                        @empty
                            <td>Заказов нет</td>
                            <td>Заказов нет</td>
                        @endforelse

                        </tbody>
                    </table>
                </a>
            </div>



        </div>
        <div class="col">
                <table class="table table-bordered mt-3 table-sortable">
                    <h1 class="text-center">Общее количество материала(все склады + сушилки)</h1>
                    <tr>
                        <th scope="col">
                            Название материала
                        </th>
                        <th scope="col">
                            Количество
                        </th>
                    </tr>
                    <tbody id="bodyTable">
                    @forelse($totalAmountWithDrying as $total)
                        <tr>
                            <td>{{$total['name']}} {{$total['height']}}x{{$total['width']}}</td>
                            <td> {{$total['amount']}} шт.
                                ({{($total['height']/1000) * ($total['width']/1000) *6 * $total['amount']}}м3)
                            </td>
                        </tr>
                    @empty
                        <td>Материала нет</td>
                    @endforelse
                    </tbody>
                </table>
        </div>
        <div class="col">
            <table class="table table-bordered mt-3 table-sortable">
                <h1 class="text-center">Итого</h1>
                <tr>
                    <th scope="col">
                        Название материала
                    </th>
                    <th scope="col">
                        Количество
                    </th>
                </tr>
                <tbody id="bodyTable">
                @forelse($totalAmount as $total)
                    <tr>
                        <td>{{$total['name']}} {{$total['height']}}x{{$total['width']}}</td>
                        <td> {{$total['amount']}} шт.
                            ({{($total['height']/1000) * ($total['width']/1000) *6 * $total['amount']}}м3)
                        </td>
                    </tr>
                @empty
                    <td>Материалов нет</td>
                    <td>Материалов нет</td>
                @endforelse

                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('script')

@endsection

