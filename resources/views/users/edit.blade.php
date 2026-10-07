@extends('adminlte::page')

@section('title', 'Edit Member')

@section('content_header') <h1>Edit Family Member</h1>
@stop

@section('content')

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Update Member</h3>
    </div>

```
<form action="{{ route('users.update', $user->id) }}" method="POST">

    @csrf
    @method('PUT')

    <div class="card-body">

        <div class="mb-3 form-group">
            <label>Name</label>

            <input type="text"
                   name="name"
                   class="form-control @error('name') is-invalid @enderror"
                   value="{{ old('name', $user->name) }}">

            @error('name')
                <span class="invalid-feedback">
                    {{ $message }}
                </span>
            @enderror
        </div>

        <div class="mb-3 form-group">
            <label>Email</label>

            <input type="email"
                   name="email"
                   class="form-control @error('email') is-invalid @enderror"
                   value="{{ old('email', $user->email) }}">

            @error('email')
                <span class="invalid-feedback">
                    {{ $message }}
                </span>
            @enderror
        </div>

        <div class="mb-3 form-group">
            <label>Role</label>

            <input type="text"
                   class="form-control"
                   value="{{ ucfirst($user->role) }}"
                   readonly>
        </div>

        <div class="mb-3 form-group">
            <label>Status</label>

            <input type="text"
                   class="form-control"
                   value="{{ $user->is_active ? 'Active' : 'Disabled' }}"
                   readonly>
        </div>

    </div>

    <div class="card-footer">

        <button type="submit" class="btn btn-success">
            Update Member
        </button>

        <a href="{{ route('users.index') }}"
           class="btn btn-secondary">
            Cancel
        </a>

    </div>

</form>
```

</div>

@stop
