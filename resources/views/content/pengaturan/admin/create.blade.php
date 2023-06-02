@extends('layouts/contentNavbarLayout')

@section('title', 'Tambah Admin')

@section('content')
    <!-- create.blade.php -->
    <div class="container">
        <form method="POST" action="/admin">
            @csrf
            <div class="row mb-3">
                <div class="col">
                    <label for="name" class="form-label">Name:</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                </div>

                <div class="col">
                    <label for="username" class="form-label">Username:</label>
                    <input type="text" name="username" id="username" class="form-control" required>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="text" name="email" id="email" class="form-control" required>
                    </div>
                </div>
                <div class="col">
                    <div class="mb-3">
                        <label for="password" class="form-label">New Password:</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                    </div>
                </div>
            </div>



            <button type="submit" class="btn btn-primary my-3">Simpan</button>
        </form>
    </div>


@endsection
