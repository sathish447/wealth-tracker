@extends('adminlte::page')

@section('title', 'Edit Investment')

@section('content_header')

<div class="d-flex justify-content-between align-items-center">

    <h1>
        <i class="fas fa-edit"></i>
        Edit Investment
    </h1>

    <a href="{{ route('investments.index') }}"
       class="btn btn-secondary">

        <i class="fas fa-arrow-left"></i>
        Back

    </a>

</div>

@stop


@section('content')

@if($errors->any())

    <div class="alert alert-danger">

        <strong>Please fix the following errors:</strong>

        <ul class="mb-0">

            @foreach($errors->all() as $error)

                <li>{{ $error }}</li>

            @endforeach

        </ul>

    </div>

@endif


<form action="{{ route('investments.update', $investment->id) }}"
      method="POST">

    @csrf

    @method('PUT')


    {{-- Basic Information --}}
    <div class="card">

        <div class="card-header">

            <h3 class="card-title">
                <i class="fas fa-info-circle"></i>
                Basic Information
            </h3>

        </div>

        <div class="card-body">

            <div class="row">

                {{-- Investment Name --}}
                <div class="col-md-6">

                    <div class="form-group">

                        <label for="invest_name">
                            Investment Name
                        </label>

                        <input type="text"
                               name="invest_name"
                               id="invest_name"
                               class="form-control @error('invest_name') is-invalid @enderror"
                               value="{{ old('invest_name', $investment->invest_name) }}"
                               required>

                        @error('invest_name')
                            <span class="invalid-feedback">
                                {{ $message }}
                            </span>
                        @enderror

                    </div>

                </div>


                {{-- Investment Type --}}
                <div class="col-md-6">

                    <div class="form-group">

                        <label for="type">
                            Investment Type
                        </label>

                        <select name="type"
                                id="type"
                                class="form-control @error('type') is-invalid @enderror"
                                required>

                            <option value="">Select Type</option>

                            <option value="fd"
                                {{ old('type', $investment->type) == 'fd' ? 'selected' : '' }}>
                                Fixed Deposit (FD)
                            </option>

                            <option value="rd"
                                {{ old('type', $investment->type) == 'rd' ? 'selected' : '' }}>
                                Recurring Deposit (RD)
                            </option>

                            <option value="equity"
                                {{ old('type', $investment->type) == 'equity' ? 'selected' : '' }}>
                                Equity
                            </option>

                            <option value="mutual_fund"
                                {{ old('type', $investment->type) == 'mutual_fund' ? 'selected' : '' }}>
                                Mutual Fund
                            </option>

                            <option value="ppf"
                                {{ old('type', $investment->type) == 'ppf' ? 'selected' : '' }}>
                                PPF
                            </option>

                            <option value="nsc"
                                {{ old('type', $investment->type) == 'nsc' ? 'selected' : '' }}>
                                NSC
                            </option>

                            <option value="bond"
                                {{ old('type', $investment->type) == 'bond' ? 'selected' : '' }}>
                                Bond
                            </option>

                            <option value="other"
                                {{ old('type', $investment->type) == 'other' ? 'selected' : '' }}>
                                Other
                            </option>

                        </select>

                    </div>

                </div>


                {{-- Institution --}}
                <div class="col-md-6">

                    <div class="form-group">

                        <label for="institution_name">
                            Institution / Bank
                        </label>

                        <input type="text"
                               name="institution_name"
                               id="institution_name"
                               class="form-control"
                               value="{{ old('institution_name', $investment->institution_name) }}"
                               placeholder="Example: SBI">

                    </div>

                </div>


                {{-- Account Number --}}
                <div class="col-md-6">

                    <div class="form-group">

                        <label for="account_number">
                            Account / Investment Number
                        </label>

                        <input type="text"
                               name="account_number"
                               id="account_number"
                               class="form-control"
                               value="{{ old('account_number', $investment->account_number) }}">

                    </div>

                </div>


                {{-- Status --}}
                <div class="col-md-6">

                    <div class="form-group">

                        <label for="status">
                            Status
                        </label>

                        <select name="status"
                                id="status"
                                class="form-control"
                                required>

                            <option value="active"
                                {{ old('status', $investment->status) == 'active' ? 'selected' : '' }}>
                                Active
                            </option>

                            <option value="matured"
                                {{ old('status', $investment->status) == 'matured' ? 'selected' : '' }}>
                                Matured
                            </option>

                            <option value="closed"
                                {{ old('status', $investment->status) == 'closed' ? 'selected' : '' }}>
                                Closed
                            </option>

                            <option value="cancelled"
                                {{ old('status', $investment->status) == 'cancelled' ? 'selected' : '' }}>
                                Cancelled
                            </option>

                        </select>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- Investment Period --}}
    <div class="card">

        <div class="card-header">

            <h3 class="card-title">
                <i class="fas fa-calendar-alt"></i>
                Investment Period
            </h3>

        </div>

        <div class="card-body">

            <div class="row">

                {{-- Start Date --}}
                <div class="col-md-4">

                    <div class="form-group">

                        <label for="start_date">
                            Start Date
                        </label>

                        <input type="date"
                               name="start_date"
                               id="start_date"
                               class="form-control"
                               value="{{ old('start_date', optional($investment->start_date)->format('Y-m-d')) }}"
                               required>

                    </div>

                </div>


                {{-- Maturity Date --}}
                <div class="col-md-4">

                    <div class="form-group">

                        <label for="maturity_date">
                            Maturity Date
                        </label>

                        <input type="date"
                               name="maturity_date"
                               id="maturity_date"
                               class="form-control"
                               value="{{ old('maturity_date', optional($investment->maturity_date)->format('Y-m-d')) }}">

                    </div>

                </div>


                {{-- Duration --}}
                <div class="col-md-4">

                    <div class="form-group">

                        <label for="total_duration_month">
                            Duration (Months)
                        </label>

                        <input type="number"
                               name="total_duration_month"
                               id="total_duration_month"
                               class="form-control"
                               min="1"
                               value="{{ old('total_duration_month', $investment->total_duration_month) }}">

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- Amount Details --}}
    <div class="card">

        <div class="card-header">

            <h3 class="card-title">
                <i class="fas fa-rupee-sign"></i>
                Amount Details
            </h3>

        </div>

        <div class="card-body">

            <div class="row">

                {{-- Principal --}}
                <div class="col-md-4">

                    <div class="form-group">

                        <label for="principal_amount">
                            Principal Amount
                        </label>

                        <input type="number"
                               step="0.01"
                               name="principal_amount"
                               id="principal_amount"
                               class="form-control"
                               value="{{ old('principal_amount', $investment->principal_amount) }}"
                               required>

                    </div>

                </div>


                {{-- Installment --}}
                <div class="col-md-4">

                    <div class="form-group">

                        <label for="installment_amount">
                            Installment Amount
                        </label>

                        <input type="number"
                               step="0.01"
                               name="installment_amount"
                               id="installment_amount"
                               class="form-control"
                               value="{{ old('installment_amount', $investment->installment_amount) }}">

                    </div>

                </div>


                {{-- Frequency --}}
                <div class="col-md-4">

                    <div class="form-group">

                        <label for="frequency">
                            Frequency
                        </label>

                        <select name="frequency"
                                id="frequency"
                                class="form-control">

                            <option value="">Select Frequency</option>

                            <option value="one_time"
                                {{ old('frequency', $investment->frequency) == 'one_time' ? 'selected' : '' }}>
                                One Time
                            </option>

                            <option value="monthly"
                                {{ old('frequency', $investment->frequency) == 'monthly' ? 'selected' : '' }}>
                                Monthly
                            </option>

                            <option value="quarterly"
                                {{ old('frequency', $investment->frequency) == 'quarterly' ? 'selected' : '' }}>
                                Quarterly
                            </option>

                            <option value="half_yearly"
                                {{ old('frequency', $investment->frequency) == 'half_yearly' ? 'selected' : '' }}>
                                Half Yearly
                            </option>

                            <option value="yearly"
                                {{ old('frequency', $investment->frequency) == 'yearly' ? 'selected' : '' }}>
                                Yearly
                            </option>

                        </select>

                    </div>

                </div>


                {{-- Interest Rate --}}
                <div class="col-md-6">

                    <div class="form-group">

                        <label for="interest_rate">
                            Interest Rate (%)
                        </label>

                        <input type="number"
                               step="0.0001"
                               name="interest_rate"
                               id="interest_rate"
                               class="form-control"
                               value="{{ old('interest_rate', $investment->interest_rate) }}">

                    </div>

                </div>


                {{-- Expected Maturity --}}
                <div class="col-md-6">

                    <div class="form-group">

                        <label for="expected_maturity_amount">
                            Expected Maturity Amount
                        </label>

                        <input type="number"
                               step="0.01"
                               name="expected_maturity_amount"
                               id="expected_maturity_amount"
                               class="form-control"
                               value="{{ old('expected_maturity_amount', $investment->expected_maturity_amount) }}">

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- Payment Details --}}
    <div class="card">

        <div class="card-header">

            <h3 class="card-title">
                <i class="fas fa-credit-card"></i>
                Payment Details
            </h3>

        </div>

        <div class="card-body">

            <div class="row">

                {{-- Payment Type --}}
                <div class="col-md-4">

                    <div class="form-group">

                        <label for="invest_payment_type">
                            Payment Type
                        </label>

                        <select name="invest_payment_type"
                                id="invest_payment_type"
                                class="form-control">

                            <option value="">Select Payment Type</option>

                            <option value="online"
                                {{ old('invest_payment_type', $investment->invest_payment_type) == 'online' ? 'selected' : '' }}>
                                Online
                            </option>

                            <option value="manual"
                                {{ old('invest_payment_type', $investment->invest_payment_type) == 'manual' ? 'selected' : '' }}>
                                Manual
                            </option>

                            <option value="cash"
                                {{ old('invest_payment_type', $investment->invest_payment_type) == 'cash' ? 'selected' : '' }}>
                                Cash
                            </option>

                        </select>

                    </div>

                </div>


                {{-- Payment Mode --}}
                <div class="col-md-4">

                    <div class="form-group">

                        <label for="payment_mode">
                            Payment Mode
                        </label>

                        <select name="payment_mode"
                                id="payment_mode"
                                class="form-control">

                            <option value="">Select Payment Mode</option>

                            <option value="upi"
                                {{ old('payment_mode', $investment->payment_mode) == 'upi' ? 'selected' : '' }}>
                                UPI
                            </option>

                            <option value="bank_transfer"
                                {{ old('payment_mode', $investment->payment_mode) == 'bank_transfer' ? 'selected' : '' }}>
                                Bank Transfer
                            </option>

                            <option value="net_banking"
                                {{ old('payment_mode', $investment->payment_mode) == 'net_banking' ? 'selected' : '' }}>
                                Net Banking
                            </option>

                            <option value="debit_card"
                                {{ old('payment_mode', $investment->payment_mode) == 'debit_card' ? 'selected' : '' }}>
                                Debit Card
                            </option>

                            <option value="cash"
                                {{ old('payment_mode', $investment->payment_mode) == 'cash' ? 'selected' : '' }}>
                                Cash
                            </option>

                            <option value="other"
                                {{ old('payment_mode', $investment->payment_mode) == 'other' ? 'selected' : '' }}>
                                Other
                            </option>

                        </select>

                    </div>

                </div>


                {{-- Payment Source --}}
                <div class="col-md-4">

                    <div class="form-group">

                        <label for="payment_source">
                            Payment Source
                        </label>

                        <select name="payment_source"
                                id="payment_source"
                                class="form-control">

                            <option value="">Select Source</option>

                            <option value="salary"
                                {{ old('payment_source', $investment->payment_source) == 'salary' ? 'selected' : '' }}>
                                Salary
                            </option>

                            <option value="savings"
                                {{ old('payment_source', $investment->payment_source) == 'savings' ? 'selected' : '' }}>
                                Savings
                            </option>

                            <option value="bank_account"
                                {{ old('payment_source', $investment->payment_source) == 'bank_account' ? 'selected' : '' }}>
                                Bank Account
                            </option>

                            <option value="cash"
                                {{ old('payment_source', $investment->payment_source) == 'cash' ? 'selected' : '' }}>
                                Cash
                            </option>

                            <option value="other"
                                {{ old('payment_source', $investment->payment_source) == 'other' ? 'selected' : '' }}>
                                Other
                            </option>

                        </select>

                    </div>

                </div>


                {{-- Auto Debit --}}
                <div class="col-md-12">

                    <div class="form-group">

                        <div class="custom-control custom-checkbox">

                            <input type="checkbox"
                                   name="auto_debit"
                                   value="1"
                                   id="auto_debit"
                                   class="custom-control-input"
                                   {{ old('auto_debit', $investment->auto_debit) ? 'checked' : '' }}>

                            <label class="custom-control-label"
                                   for="auto_debit">

                                Enable Auto Debit

                            </label>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- Notes --}}
    <div class="card">

        <div class="card-header">

            <h3 class="card-title">
                <i class="fas fa-sticky-note"></i>
                Notes
            </h3>

        </div>

        <div class="card-body">

            <div class="form-group">

                <textarea name="notes"
                          class="form-control"
                          rows="4"
                          placeholder="Enter notes...">{{ old('notes', $investment->notes) }}</textarea>

            </div>

        </div>

    </div>


    {{-- Buttons --}}
    <div class="mb-4">

        <button type="submit"
                class="btn btn-success">

            <i class="fas fa-save"></i>
            Update Investment

        </button>

        <a href="{{ route('investments.index') }}"
           class="btn btn-secondary">

            <i class="fas fa-times"></i>
            Cancel

        </a>

    </div>

</form>

@stop
