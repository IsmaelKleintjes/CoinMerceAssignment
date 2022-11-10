@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12 pt-2">
                <a href="/home" class="btn btn-outline-primary btn-sm">Go back</a>
                <div class="border rounded mt-5 pl-4 pr-4 pt-4 pb-4">
                    <h1 class="display-4">Show Coins</h1>

                        <table>
                            <tr>
                                <th>Name</th>
                                <th>Symbol</th>
                                <th>Current price</th>
                                <th>Price change percentage 1h</th>
                                <th>Price change percentage 24h</th>
                                <th>Price change percentage 7d</th>
                            </tr>
                            @foreach($coins as $coin)
                            <tr>
                                <td>{{ $coin->coin->name }}</td>
                                <td>{{ $coin->coin->symbol }}</td>
                                <td>{{ $coin->currentPrice }}</td>
                                <td>{{ $coin->priceChangePercentage1h }}</td>
                                <td>{{ $coin->priceChangePercentage24h }}</td>
                                <td>{{ $coin->priceChangePercentage7d }}</td>
                                <td><a href="./transactions/{{ $coin->coin->coinGeckoId->id }}">Buy</a></td>


{{--                                {{dd($coin)}}--}}
                            </tr>
                            @endforeach
                        </table>

                </div>

            </div>
        </div>
    </div>
@endsection
