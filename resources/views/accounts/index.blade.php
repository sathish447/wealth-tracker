@extends('adminlte::page')

@section('title', 'Accounts')

@section('content_header')
<div class="d-flex justify-content-between">
    <h1>Accounts</h1>

    <a href="{{ route('accounts.create') }}"
       class="btn btn-primary">
        <i class="fas fa-plus"></i> Add Account
    </a>
</div>
@stop

@section('content')

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<div class="card">

    <div class="card-header">
        <h3 class="card-title">
            Accounts List
        </h3>
    </div>

    <div class="card-body">

        <table class="table table-bordered table-striped">

            <thead>
            <tr>
                <th>Name</th>
                <th>Type</th>
                <th>Institution</th>
                <th>Balance</th>
                <th>Status</th>
                <th width="250">Actions</th>
            </tr>
            </thead>

            <tbody>

            @forelse($accounts as $account)

                <tr>

                    <td>{{ $account->name }}</td>

                    <td>
                        {{ ucfirst(str_replace('_',' ',$account->account_type)) }}
                    </td>

                    <td>
                        {{ $account->institution_name ?? '-' }}
                    </td>

                    <td>
                        ₹{{ number_format($account->current_balance, 2) }}
                    </td>

                    <td>
                        @if($account->is_active)
                            <span class="badge bg-success">
                                Active
                            </span>
                        @else
                            <span class="badge bg-danger">
                                Disabled
                            </span>
                        @endif
                    </td>

                    <td>

                        <div class="btn-group">

                            <a href="{{ route('accounts.edit', $account->id) }}"
                               class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>

                            <form action="{{ route('accounts.toggle-status', $account->id) }}"
                                  method="POST"
                                  style="display:inline;">
                                @csrf

                                <button type="submit"
                                    class="btn btn-sm {{ $account->is_active ? 'btn-danger' : 'btn-success' }}">
                                    <i class="fas {{ $account->is_active ? 'fa-ban' : 'fa-check' }}"></i>
                                </button>
                            </form>

                            <form action="{{ route('accounts.destroy', $account->id) }}"
                                  method="POST"
                                  style="display:inline;"
                                  onsubmit="return confirm('Delete account?')">

                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="btn btn-secondary btn-sm">
                                    <i class="fas fa-trash"></i>
                                </button>

                            </form>

                        </div>

                    </td>

                </tr>

            @empty

                <tr>
                    <td colspan="6" class="text-center">
                        No Accounts Found
                    </td>
                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

</div>

@stop
