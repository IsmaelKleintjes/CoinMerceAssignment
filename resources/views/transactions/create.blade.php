@extends('layouts.app')

@section('content')

<a href="/coins">Go back</a>
<h3>Create transaction</h3>

<form method="POST" action="/transactions">

@csrf

    <label for="title">{{ $coin }}</label>
    <input type="hidden" id="coin" class="form-control" name="coin" value="{{ $coin }}" required>
    <input type="text" id="amount" class="form-control" name="amount"placeholder="Amount" required>
    <input type="hidden" id="type" class="form-control" name="type" value="buy" required>

    <button id="btn-submit" class="btn btn-primary">
    Submit
    </button>
</form>

@endsection
