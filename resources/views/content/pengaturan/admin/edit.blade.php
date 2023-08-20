@extends('layouts/contentNavbarLayout')

@section('title', 'Edit Admin')

@section('content')
    <div class="container">
        <form method="POST" action="/admin" id="user-form">
            @csrf
            <label for="name" class="form-label">Name:</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}" required>

            <label for="username" class="form-label">Username:</label>
            <input type="text" name="username" id="username" class="form-control" value="{{ old('username', $user->username) }}" required>

            <label for="email" class="form-label">Email:</label>
            <input type="text" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}" required>

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
    <script>
        $(document).ready(function() {
            $("#user-form").submit(function(e) {
                e.preventDefault();

                $.ajax({
                    type: "POST",
                    url: "/admin",
                    data: $(this).serialize(),
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: response.success,
                        }).then(function() {
                            window.location.href = '/admin';
                        });
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Validation Error',
                                text: xhr.responseJSON.error, // Menampilkan pesan kesalahan yang lebih spesifik
                            });
                        }
                    }
                });
            });
        });
    </script>


@endsection
