@extends('layouts.app')

@section('content')

<a href="/">Go back</a>
<h3>Show Balances</h3>
<table>
    <tr>
        <th>Coin</th>
        <th>Amount</th>
        <th>Your value</th>
        <th>Gain/Loss</th>
        <th>Percentage</th>
    </tr>

    @if($balances)

    @foreach($balances->list as $balance)

        <tr>
            <td>{{ $balance->coin->name }}</td>
            <td>{{ $balance->totalCryptoAmount }}</td>
            <td>€ {{ $balance->currentValue }}</td>
            <td>€ {{ $balance->gainLoss }}</td>
            <td>{{ $balance->percentageDifference }} %</td>
        </tr>

    @endforeach

    @else

        <h3>No transactions found..</h3>

    @endif

</table>

@endsection
