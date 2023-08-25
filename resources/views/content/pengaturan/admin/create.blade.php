@extends('layouts/contentNavbarLayout')

@section('title', 'Tambah Admin')

@section('content')
    <!-- create.blade.php -->
    <div class="container">
        <form method="POST" action="/admin" id="user-form">
            @csrf
            <label for="name" class="form-label">Name:</label>
            <input type="text" name="name" id="name" class="form-control" required>

            <label for="username" class="form-label">Username:</label>
            <input type="text" name="username" id="username" class="form-control" required>

            <label for="email" class="form-label">Email:</label>
            <input type="text" name="email" id="email" class="form-control" required>

            <label for="role" class="form-label">Role:</label>
            <select name="role" id="role" class="form-select" required>
                @foreach ($role as $r)
                    <option value="{{ $r->name }}">{{ $r->name }}</option>
                @endforeach
            </select>

            <label for="password" class="form-label">New Password:</label>
            <input type="password" name="password" id="password" class="form-control" required>

            <button type="submit" class="btn btn-primary my-3">Simpan</button>
        </form>
    </div>

@endsection

@push('myscript')
  <script type="text/javascript" src="{{ URL::asset ('/assets/_stacks/user_create.js') }}"></script>
@endpush