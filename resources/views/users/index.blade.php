@extends('adminlte::page')

@section('title', 'Family Members')

@section('content_header')
<div class="d-flex justify-content-between">
    <h1>Family Members</h1>

    <a href="{{ route('users.create') }}"
       class="btn btn-primary">
        <i class="fas fa-plus"></i> Add Member
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
            Family Members List
        </h3>
    </div>

    <div class="card-body">

        <table class="table table-bordered table-striped">

            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th width="250">Actions</th>
                </tr>
            </thead>

            <tbody>

                @forelse($users as $user)

                    <tr>

                        <td>{{ $user->name }}</td>

                        <td>{{ $user->email }}</td>

                        <td>
                            <span class="badge bg-primary">
                                {{ ucfirst($user->role) }}
                            </span>
                        </td>

                        <td>

                            @if($user->is_active)
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

                                <a href="{{ route('users.edit', $user->id) }}"
                                   class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>

                                @if(auth()->id() != $user->id)

                                    <form action="{{ route('users.toggle-status', $user->id) }}"
                                          method="POST"
                                          style="display:inline;">
                                        @csrf

                                        <button type="submit"
                                                class="btn btn-sm {{ $user->is_active ? 'btn-danger' : 'btn-success' }}">
                                            <i class="fas {{ $user->is_active ? 'fa-ban' : 'fa-check' }}"></i>
                                        </button>
                                    </form>

                                    <form action="{{ route('users.destroy', $user->id) }}"
                                          method="POST"
                                          style="display:inline;"
                                          onsubmit="return confirm('Delete this member?')">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="btn btn-secondary btn-sm">
                                            <i class="fas fa-trash"></i>
                                        </button>

                                    </form>

                                @endif

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="5" class="text-center">
                            No Members Found
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@stop
