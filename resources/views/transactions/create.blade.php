@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12 pt-2">
                <a href="/coins/list" class="btn btn-outline-primary btn-sm">Go back</a>
                <div class="border rounded mt-5 pl-4 pr-4 pt-4 pb-4">
                    <h1 class="display-4">Create transaction</h1>

                    <hr>

                    <form method="POST" action="/transactions">
                        @csrf
                        <div class="row">
                            <div class="control-group col-12">
                                <label for="title">{{ $coin }}</label>
                                <input type="hidden" id="coin" class="form-control" name="coin" value="{{ $coin }}" required>
                                <input type="text" id="amount" class="form-control" name="amount"placeholder="Amount" required>
                                <input type="hidden" id="type" class="form-control" name="type" value="buy" required>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="control-group col-12 text-center">
                                <button id="btn-submit" class="btn btn-primary">
                                    Submit
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

@endsection
