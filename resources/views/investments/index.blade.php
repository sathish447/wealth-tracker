@extends('adminlte::page')

@section('title', 'Investments')

@section('content_header')

<div class="d-flex justify-content-between align-items-center">

    <h1>
        <i class="fas fa-money-bill-wave"></i>
        Investments
    </h1>

    <a href="{{ route('investments.create') }}"
       class="btn btn-primary">

        <i class="fas fa-plus"></i>
        Add Investment

    </a>

</div>

@stop


@section('content')

{{-- Success Message --}}
@if(session('success'))

    <div class="alert alert-success alert-dismissible fade show">

        <i class="fas fa-check-circle"></i>

        {{ session('success') }}

        <button type="button"
                class="close"
                data-dismiss="alert">

            <span>&times;</span>

        </button>

    </div>

@endif


{{-- Error Message --}}
@if(session('error'))

    <div class="alert alert-danger alert-dismissible fade show">

        <i class="fas fa-exclamation-circle"></i>

        {{ session('error') }}

        <button type="button"
                class="close"
                data-dismiss="alert">

            <span>&times;</span>

        </button>

    </div>

@endif


{{-- Summary --}}
<div class="row">

    {{-- Total Investments --}}
    <div class="col-lg-3 col-md-6">

        <div class="small-box bg-info">

            <div class="inner">

                <h3>
                    {{ $investments->count() }}
                </h3>

                <p>Total Investments</p>

            </div>

            <div class="icon">
                <i class="fas fa-chart-line"></i>
            </div>

        </div>

    </div>


    {{-- Total Principal --}}
    <div class="col-lg-3 col-md-6">

        <div class="small-box bg-success">

            <div class="inner">

                <h3>
                    ₹{{ number_format($investments->sum('principal_amount'), 2) }}
                </h3>

                <p>Total Invested</p>

            </div>

            <div class="icon">
                <i class="fas fa-rupee-sign"></i>
            </div>

        </div>

    </div>


    {{-- Installment Amount --}}
    <div class="col-lg-3 col-md-6">

        <div class="small-box bg-warning">

            <div class="inner">

                <h3>
                    ₹{{ number_format($investments->sum('installment_amount'), 2) }}
                </h3>

                <p>Total Installment</p>

            </div>

            <div class="icon">
                <i class="fas fa-calendar-check"></i>
            </div>

        </div>

    </div>


    {{-- Remaining Payment --}}
    <div class="col-lg-3 col-md-6">

        <div class="small-box bg-danger">

            <div class="inner">

                <h3>
                    ₹{{ number_format($investments->sum('remaining_payment_amount'), 2) }}
                </h3>

                <p>Remaining Payment</p>

            </div>

            <div class="icon">
                <i class="fas fa-wallet"></i>
            </div>

        </div>

    </div>

</div>


{{-- Investment List --}}
<div class="card">

    <div class="card-header">

        <h3 class="card-title">

            <i class="fas fa-list"></i>

            Investment List

        </h3>

        <div class="card-tools">

            <span class="badge badge-success">

                Active:
                {{ $investments->where('status', 'active')->count() }}

            </span>

            <span class="badge badge-primary">

                Matured:
                {{ $investments->where('status', 'matured')->count() }}

            </span>

            <span class="badge badge-secondary">

                Closed:
                {{ $investments->where('status', 'closed')->count() }}

            </span>

        </div>

    </div>


    <div class="card-body table-responsive p-0">

        <table class="table table-bordered table-striped table-hover">

            <thead>

            <tr>

                <th>#</th>

                <th>Investment</th>

                <th>Type</th>

                <th>Institution</th>

                <th>Principal</th>

                <th>Installment</th>

                <th>Paid</th>

                <th>Remaining</th>

                <th>Start Date</th>

                <th>Maturity</th>

                <th>Status</th>

                <th>Auto Debit</th>

                <th width="150">Actions</th>

            </tr>

            </thead>


            <tbody>

            @forelse($investments as $investment)

                <tr>

                    {{-- # --}}
                    <td>
                        {{ $loop->iteration }}
                    </td>


                    {{-- Investment Name --}}
                    <td>

                        <strong>
                            {{ $investment->invest_name }}
                        </strong>

                    </td>


                    {{-- Type --}}
                    <td>

                        @php
                            $typeLabels = [
                                'fd' => 'FD',
                                'rd' => 'RD',
                                'equity' => 'Equity',
                                'mutual_fund' => 'Mutual Fund',
                                'ppf' => 'PPF',
                                'nsc' => 'NSC',
                                'bond' => 'Bond',
                                'other' => 'Other',
                            ];
                        @endphp

                        <span class="badge badge-info">

                            {{ $typeLabels[$investment->type] ?? ucfirst(str_replace('_', ' ', $investment->type)) }}

                        </span>

                    </td>


                    {{-- Institution --}}
                    <td>

                        {{ $investment->institution_name ?? '-' }}

                    </td>


                    {{-- Principal --}}
                    <td>

                        ₹{{ number_format($investment->principal_amount, 2) }}

                    </td>


                    {{-- Installment --}}
                    <td>

                        @if($investment->installment_amount)

                            ₹{{ number_format($investment->installment_amount, 2) }}

                            @if($investment->frequency)

                                <small class="text-muted">

                                    / {{ ucfirst(str_replace('_', ' ', $investment->frequency)) }}

                                </small>

                            @endif

                        @else

                            -

                        @endif

                    </td>


                    {{-- Paid Months --}}
                    <td>

                        {{ $investment->paid_month_count ?? 0 }}

                        @if($investment->total_duration_month)

                            / {{ $investment->total_duration_month }}

                        @endif

                    </td>


                    {{-- Remaining --}}
                    <td>

                        ₹{{ number_format($investment->remaining_payment_amount ?? 0, 2) }}

                    </td>


                    {{-- Start Date --}}
                    <td>

                        {{ $investment->start_date?->format('d-m-Y') ?? '-' }}

                    </td>


                    {{-- Maturity Date --}}
                    <td>

                        {{ $investment->maturity_date?->format('d-m-Y') ?? '-' }}

                    </td>


                    {{-- Status --}}
                    <td>

                        @switch($investment->status)

                            @case('active')

                                <span class="badge badge-success">
                                    Active
                                </span>

                                @break

                            @case('matured')

                                <span class="badge badge-primary">
                                    Matured
                                </span>

                                @break

                            @case('closed')

                                <span class="badge badge-secondary">
                                    Closed
                                </span>

                                @break

                            @case('cancelled')

                                <span class="badge badge-danger">
                                    Cancelled
                                </span>

                                @break

                            @default

                                <span class="badge badge-warning">
                                    {{ ucfirst($investment->status) }}
                                </span>

                        @endswitch

                    </td>


                    {{-- Auto Debit --}}
                    <td class="text-center">

                        @if($investment->auto_debit)

                            <span class="badge badge-success">

                                <i class="fas fa-check"></i>

                                Yes

                            </span>

                        @else

                            <span class="badge badge-secondary">

                                <i class="fas fa-times"></i>

                                No

                            </span>

                        @endif

                    </td>


                    {{-- Actions --}}
                    <td>

                        <div class="btn-group">

                            {{-- View --}}
                            <a href="{{ route('investments.show', $investment->id) }}"
                               class="btn btn-info btn-sm"
                               title="View">

                                <i class="fas fa-eye"></i>

                            </a>


                            {{-- Edit --}}
                            <a href="{{ route('investments.edit', $investment->id) }}"
                               class="btn btn-warning btn-sm"
                               title="Edit">

                                <i class="fas fa-edit"></i>

                            </a>


                            {{-- Delete --}}
                            <form action="{{ route('investments.destroy', $investment->id) }}"
                                  method="POST"
                                  style="display:inline;">

                                @csrf

                                @method('DELETE')

                                <button type="submit"
                                        class="btn btn-danger btn-sm"
                                        title="Delete"
                                        onclick="return confirm('Are you sure you want to delete this investment?')">

                                    <i class="fas fa-trash"></i>

                                </button>

                            </form>

                        </div>

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="13" class="text-center py-4">

                        <i class="fas fa-money-bill-wave fa-2x text-muted mb-2"></i>

                        <h5>No Investments Found</h5>

                        <p class="text-muted">
                            You haven't added any investments yet.
                        </p>

                        <a href="{{ route('investments.create') }}"
                           class="btn btn-primary">

                            <i class="fas fa-plus"></i>

                            Add Investment

                        </a>

                    </td>

                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

</div>

@stop
