@extends('layouts/contentNavbarLayout')

@section('title', 'Tambah bunga')

@section('content')
    <div class="container">
        <form method="POST" action="/bunga">
            @csrf
            <div class="row mb-3">
                <div class="col">
                    <label for="code" class="form-label">Code:</label>
                    <input type="text" name="code" id="code" class="form-control" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label for="name" class="form-label">Name:</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="mb-3">
                        <label for="price" class="form-label">Price:</label>
                        <input type="text" name="price" id="price" class="form-control" required>
                    </div>
                </div>
            </div>

            <x-btn-simpan route="{{ $route }}"/>

        </form>
    </div>


@endsection
