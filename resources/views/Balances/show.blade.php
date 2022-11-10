@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12 pt-2">
                <a href="/home" class="btn btn-outline-primary btn-sm">Go back</a>
                <div class="border rounded mt-5 pl-4 pr-4 pt-4 pb-4">
                    <h1 class="display-4">Show Balances</h1>


                    <table>
                        <tr>
                            <th>Coin</th>
                            <th>Amount</th>
                            <th>Gain/Loss</th>
                            <th>Percentage</th>
                        </tr>
                        @foreach($balances as $balance)
                            <tr>
                                <td>{{ $balance->coin->name }}</td>
                                <td>{{ $balance->totalCryptoAmount }}</td>
                                <td>{{ $balance->gainLoss }}</td>
                                <td>{{ $balance->percentageDifference }}</td>
                            </tr>
                        @endforeach
                    </table>

                </div>

            </div>
        </div>
    </div>
@endsection
