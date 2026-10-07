@extends('adminlte::page')

@section('title', 'Add Member')

@section('content_header') <h1>Add Family Member</h1>
@stop

@section('content')

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Create Member</h3>
    </div>

```
<form action="{{ route('users.store') }}" method="POST">
    @csrf

    <div class="card-body">

        <div class="mb-3 form-group">
            <label>Name</label>

            <input type="text"
                   name="name"
                   class="form-control @error('name') is-invalid @enderror"
                   value="{{ old('name') }}"
                   placeholder="Enter Name">

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
                   value="{{ old('email') }}"
                   placeholder="Enter Email">

            @error('email')
                <span class="invalid-feedback">
                    {{ $message }}
                </span>
            @enderror
        </div>

        <div class="mb-3 form-group">
            <label>Password</label>

            <input type="password"
                   name="password"
                   class="form-control @error('password') is-invalid @enderror">

            @error('password')
                <span class="invalid-feedback">
                    {{ $message }}
                </span>
            @enderror
        </div>

        <div class="mb-3 form-group">
            <label>Confirm Password</label>

            <input type="password"
                   name="password_confirmation"
                   class="form-control">
        </div>

    </div>

    <div class="card-footer">
        <button type="submit" class="btn btn-primary">
            Save Member
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
