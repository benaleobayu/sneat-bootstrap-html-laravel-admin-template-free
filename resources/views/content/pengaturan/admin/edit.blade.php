@extends('layouts/contentNavbarLayout')

@section('title', 'Edit Admin')

@section('content')
    <div class="container">
        <form method="POST" action="/admin/{{ $user->id }}" id="user-form">
            @csrf
            @method('PUT')
            <label for="name" class="form-label">Name:</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}" required>

            <label for="username" class="form-label">Username:</label>
            <input type="text" name="username" id="username" class="form-control" value="{{ old('username', $user->username) }}" required>

            <label for="email" class="form-label">Email:</label>
            <input type="text" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}" required>

            <label for="role" class="form-label">Role:</label>
            <select name="role" id="role" class="form-select" required>
                @foreach ($role as $r)
                    @if (old('role', $user->roles) == $user->roles)
                      <option value="{{ $r->name }}" selected>{{ $r->name }}</option>
                    @else
                       <option value="{{ $r->name }}">{{ $r->name }}</option>
                    @endif
                @endforeach
            </select>

            <label for="password" class="form-label">New Password:</label>
            <input type="password" name="password" id="password" class="form-control">

            <button type="submit" class="btn btn-primary my-3">Simpan</button>
        </form>
    </div>
    


@endsection

@push('myscript')
  <script type="text/javascript" src="{{ URL::asset ('/assets/_stacks/user_edit.js') }}"></script>
@endpush