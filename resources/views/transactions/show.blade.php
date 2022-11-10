@extends('layouts.app')

@section('content')

<h3>Show transaction</h3>
<a href="/coins">Go back</a>

<table>
    <tr>
        <th>Coin</th>
        <th>Amount</th>
        <th>Price</th>
        <th>Type</th>
    </tr>
    <tr>
        <td>{{ $transaction->coin->name }}</td>
        <td>{{ $transaction->amount }}</td>
        <td>{{ ($transaction->price * $transaction->amount) }}</td>
        <td>{{ $transaction->type }}</td>
    </tr>
</table>

@endsection
