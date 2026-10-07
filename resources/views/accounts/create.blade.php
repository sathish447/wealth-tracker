@extends('adminlte::page')

@section('title', 'Create Account')

@section('content_header')
<h1>Create Account</h1>
@stop

@section('content')

<div class="card">

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <form action="{{ route('accounts.store') }}"
          method="POST">

        @csrf

        <div class="card-body">

            <div class="mb-3 form-group">
                <label>Account Name</label>

                <input type="text"
                       name="name"
                       class="form-control"
                       value="{{ old('name') }}">

                       @error('name')
    <span class="text-danger">
        {{ $message }}
    </span>
@enderror
            </div>

            <div class="mb-3 form-group">
                <label>Account Type</label>

                <select name="account_type"
                        class="form-control">

                    <option value="">Select</option>
                    <option value="savings">Savings</option>
                    <option value="current">Current</option>
                    <option value="cash">Cash</option>
                    <option value="wallet">Wallet</option>
                    <option value="credit_card">Credit Card</option>

                </select>

                @error('account_type')
    <span class="text-danger">
        {{ $message }}
    </span>
@enderror

            </div>

            <div class="mb-3 form-group">
                <label>Institution Name</label>

                <input type="text"
                       name="institution_name"
                       class="form-control">
            </div>

            <div class="mb-3 form-group">
                <label>Account Number</label>

                <input type="text"
                       name="account_number"
                       class="form-control">
            </div>

            <div class="mb-3 form-group">
                <label>Opening Balance</label>

                <input type="number"
                       step="0.01"
                       name="opening_balance"
                       class="form-control">
            </div>

            <div class="mb-3 form-group">
                <label>Notes</label>

                <textarea name="notes"
                          class="form-control"></textarea>
            </div>

        </div>

        <div class="card-footer">

            <button type="submit"
                    class="btn btn-primary">
                Save
            </button>

            <a href="{{ route('accounts.index') }}"
               class="btn btn-secondary">
                Cancel
            </a>

        </div>

    </form>

</div>

@stop
