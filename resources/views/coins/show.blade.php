@extends('layouts.app')

@section('content')

<a href="/">Go back</a>
<h3>Show Coins</h3>

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
    </tr>

    @endforeach

</table>

@endsection
