@extends('adminlte::page')

@section('title', 'Create Investment')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Create Investment</h1>

        <a href="{{ route('investments.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i>
            Back
        </a>
    </div>
@stop

@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Please fix the following errors:</strong>

        <ul class="mb-0 mt-2">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="card">

    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-money-bill-wave"></i>
            Investment Details
        </h3>
    </div>

    <form action="{{ route('investments.store') }}" method="POST">

        @csrf

        <div class="card-body">

            {{-- Basic Information --}}
            <h5 class="text-primary mb-3">
                <i class="fas fa-info-circle"></i>
                Basic Information
            </h5>

            <div class="row">

                {{-- Investment Name --}}
                <div class="col-md-6">
                    <div class="form-group">
                        <label>
                            Investment Name
                            <span class="text-danger">*</span>
                        </label>

                        <input type="text"
                               name="invest_name"
                               class="form-control"
                               value="{{ old('invest_name') }}"
                               placeholder="e.g. TMB RD, SBI FD, PPF">

                        @error('invest_name')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>

                {{-- Investment Type --}}
                <div class="col-md-6">
                    <div class="form-group">
                        <label>
                            Investment Type
                            <span class="text-danger">*</span>
                        </label>

                        <select name="type" class="form-control">

                            <option value="">Select Investment Type</option>

                            <option value="fd"
                                {{ old('type') == 'fd' ? 'selected' : '' }}>
                                Fixed Deposit (FD)
                            </option>

                            <option value="rd"
                                {{ old('type') == 'rd' ? 'selected' : '' }}>
                                Recurring Deposit (RD)
                            </option>

                            <option value="equity"
                                {{ old('type') == 'equity' ? 'selected' : '' }}>
                                Equity
                            </option>

                            <option value="mutual_fund"
                                {{ old('type') == 'mutual_fund' ? 'selected' : '' }}>
                                Mutual Fund
                            </option>

                            <option value="ppf"
                                {{ old('type') == 'ppf' ? 'selected' : '' }}>
                                PPF
                            </option>

                            <option value="nsc"
                                {{ old('type') == 'nsc' ? 'selected' : '' }}>
                                NSC
                            </option>

                            <option value="bond"
                                {{ old('type') == 'bond' ? 'selected' : '' }}>
                                Bond
                            </option>

                            <option value="other"
                                {{ old('type') == 'other' ? 'selected' : '' }}>
                                Other
                            </option>

                        </select>

                        @error('type')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>

                {{-- Institution --}}
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Institution Name</label>

                        <input type="text"
                               name="institution_name"
                               class="form-control"
                               value="{{ old('institution_name') }}"
                               placeholder="e.g. TMB Bank, SBI, PPF">

                        @error('institution_name')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>

                {{-- Account Number --}}
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Account / Reference Number</label>

                        <input type="text"
                               name="account_number"
                               class="form-control"
                               value="{{ old('account_number') }}"
                               placeholder="Optional">

                        @error('account_number')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>

                {{-- Status --}}
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Status</label>

                        <select name="status" class="form-control">

                            <option value="active"
                                {{ old('status', 'active') == 'active' ? 'selected' : '' }}>
                                Active
                            </option>

                            <option value="matured"
                                {{ old('status') == 'matured' ? 'selected' : '' }}>
                                Matured
                            </option>

                            <option value="closed"
                                {{ old('status') == 'closed' ? 'selected' : '' }}>
                                Closed
                            </option>

                            <option value="cancelled"
                                {{ old('status') == 'cancelled' ? 'selected' : '' }}>
                                Cancelled
                            </option>

                        </select>

                        @error('status')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>

            </div>

            <hr>

            {{-- Investment Period --}}
            <h5 class="text-primary mb-3">
                <i class="fas fa-calendar-alt"></i>
                Investment Period
            </h5>

            <div class="row">

                {{-- Start Date --}}
                <div class="col-md-4">
                    <div class="form-group">
                        <label>
                            Start Date
                            <span class="text-danger">*</span>
                        </label>

                        <input type="date"
                               name="start_date"
                               class="form-control"
                               value="{{ old('start_date') }}">

                        @error('start_date')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>

                {{-- Maturity Date --}}
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Maturity Date</label>

                        <input type="date"
                               name="maturity_date"
                               class="form-control"
                               value="{{ old('maturity_date') }}">

                        @error('maturity_date')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>

                {{-- Duration --}}
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Total Duration (Months)</label>

                        <input type="number"
                               name="total_duration_month"
                               class="form-control"
                               min="1"
                               value="{{ old('total_duration_month') }}"
                               placeholder="e.g. 24">

                        @error('total_duration_month')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>

            </div>

            <hr>

            {{-- Amount Details --}}
            <h5 class="text-primary mb-3">
                <i class="fas fa-rupee-sign"></i>
                Amount Details
            </h5>

            <div class="row">

                {{-- Principal --}}
                <div class="col-md-4">
                    <div class="form-group">
                        <label>
                            Principal Amount
                            <span class="text-danger">*</span>
                        </label>

                        <input type="number"
                               step="0.01"
                               min="0"
                               name="principal_amount"
                               class="form-control"
                               value="{{ old('principal_amount') }}"
                               placeholder="₹ 0.00">

                        @error('principal_amount')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>

                {{-- Installment --}}
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Installment Amount</label>

                        <input type="number"
                               step="0.01"
                               min="0"
                               name="installment_amount"
                               class="form-control"
                               value="{{ old('installment_amount') }}"
                               placeholder="₹ 0.00">

                        @error('installment_amount')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>

                {{-- Frequency --}}
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Payment Frequency</label>

                        <select name="frequency" class="form-control">

                            <option value="">Select Frequency</option>

                            <option value="one_time"
                                {{ old('frequency') == 'one_time' ? 'selected' : '' }}>
                                One Time
                            </option>

                            <option value="monthly"
                                {{ old('frequency') == 'monthly' ? 'selected' : '' }}>
                                Monthly
                            </option>

                            <option value="quarterly"
                                {{ old('frequency') == 'quarterly' ? 'selected' : '' }}>
                                Quarterly
                            </option>

                            <option value="half_yearly"
                                {{ old('frequency') == 'half_yearly' ? 'selected' : '' }}>
                                Half Yearly
                            </option>

                            <option value="yearly"
                                {{ old('frequency') == 'yearly' ? 'selected' : '' }}>
                                Yearly
                            </option>

                        </select>

                        @error('frequency')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>

            </div>

            <div class="row">

                {{-- Interest Rate --}}
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Interest / Expected Return (%)</label>

                        <input type="number"
                               step="0.0001"
                               min="0"
                               name="interest_rate"
                               class="form-control"
                               value="{{ old('interest_rate') }}"
                               placeholder="e.g. 7.25">

                        @error('interest_rate')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>

                {{-- Expected Maturity --}}
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Expected Maturity Amount</label>

                        <input type="number"
                               step="0.01"
                               min="0"
                               name="expected_maturity_amount"
                               class="form-control"
                               value="{{ old('expected_maturity_amount') }}"
                               placeholder="₹ 0.00">

                        @error('expected_maturity_amount')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>

            </div>

            <hr>

            {{-- Payment Details --}}
            <h5 class="text-primary mb-3">
                <i class="fas fa-credit-card"></i>
                Payment Details
            </h5>

            <div class="row">

                {{-- Payment Type --}}
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Investment Payment Type</label>

                        <select name="invest_payment_type" class="form-control">

                            <option value="">Select</option>

                            <option value="online"
                                {{ old('invest_payment_type') == 'online' ? 'selected' : '' }}>
                                Online
                            </option>

                            <option value="manual"
                                {{ old('invest_payment_type') == 'manual' ? 'selected' : '' }}>
                                Manual
                            </option>

                            <option value="cash"
                                {{ old('invest_payment_type') == 'cash' ? 'selected' : '' }}>
                                Cash
                            </option>

                        </select>

                        @error('invest_payment_type')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>

                {{-- Payment Mode --}}
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Payment Mode</label>

                        <select name="payment_mode" class="form-control">

                            <option value="">Select</option>

                            <option value="upi"
                                {{ old('payment_mode') == 'upi' ? 'selected' : '' }}>
                                UPI
                            </option>

                            <option value="bank_transfer"
                                {{ old('payment_mode') == 'bank_transfer' ? 'selected' : '' }}>
                                Bank Transfer
                            </option>

                            <option value="net_banking"
                                {{ old('payment_mode') == 'net_banking' ? 'selected' : '' }}>
                                Net Banking
                            </option>

                            <option value="debit_card"
                                {{ old('payment_mode') == 'debit_card' ? 'selected' : '' }}>
                                Debit Card
                            </option>

                            <option value="cash"
                                {{ old('payment_mode') == 'cash' ? 'selected' : '' }}>
                                Cash
                            </option>

                            <option value="other"
                                {{ old('payment_mode') == 'other' ? 'selected' : '' }}>
                                Other
                            </option>

                        </select>

                        @error('payment_mode')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>

                {{-- Payment Source --}}
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Payment Source</label>

                        <select name="payment_source" class="form-control">

                            <option value="">Select</option>

                            <option value="salary"
                                {{ old('payment_source') == 'salary' ? 'selected' : '' }}>
                                Salary
                            </option>

                            <option value="savings"
                                {{ old('payment_source') == 'savings' ? 'selected' : '' }}>
                                Savings
                            </option>

                            <option value="bank_account"
                                {{ old('payment_source') == 'bank_account' ? 'selected' : '' }}>
                                Bank Account
                            </option>

                            <option value="cash"
                                {{ old('payment_source') == 'cash' ? 'selected' : '' }}>
                                Cash
                            </option>

                            <option value="other"
                                {{ old('payment_source') == 'other' ? 'selected' : '' }}>
                                Other
                            </option>

                        </select>

                        @error('payment_source')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>

            </div>

            {{-- Auto Debit --}}
            <div class="form-group">

                <div class="custom-control custom-checkbox">

                    <input type="checkbox"
                           name="auto_debit"
                           value="1"
                           class="custom-control-input"
                           id="auto_debit"
                           {{ old('auto_debit') ? 'checked' : '' }}>

                    <label class="custom-control-label" for="auto_debit">
                        Enable Auto Debit
                    </label>

                </div>

                @error('auto_debit')
                    <span class="text-danger">
                        {{ $message }}
                    </span>
                @enderror

            </div>

            <hr>

            {{-- Notes --}}
            <h5 class="text-primary mb-3">
                <i class="fas fa-sticky-note"></i>
                Additional Information
            </h5>

            <div class="form-group">

                <label>Notes</label>

                <textarea name="notes"
                          rows="4"
                          class="form-control"
                          placeholder="Add any additional information...">{{ old('notes') }}</textarea>

                @error('notes')
                    <span class="text-danger">
                        {{ $message }}
                    </span>
                @enderror

            </div>

        </div>

        <div class="card-footer">

            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i>
                Save Investment
            </button>

            <a href="{{ route('investments.index') }}"
               class="btn btn-secondary">

                <i class="fas fa-times"></i>
                Cancel

            </a>

        </div>

    </form>

</div>

@stop
