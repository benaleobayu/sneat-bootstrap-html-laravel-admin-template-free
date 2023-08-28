@extends('layouts/contentNavbarLayout')

@section('title', 'Edit Bunga')

@section('content')
    <div class="container">
        <form method="POST" action="/bunga/{{ $data->id }}">
            @csrf
            @method('PUT')
            <div class="row mb-3">
                <div class="col">
                    <label for="code" class="form-label">Code:</label>
                    <input type="text" name="code" id="code" class="form-control" value="{{ old('code', $data->code) }}" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label for="name" class="form-label">Name:</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $data->name) }}" required>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="mb-3">
                        <label for="price" class="form-label">Price:</label>
                        <input type="text" name="price" id="price" class="form-control" value="{{ old('price', $data->price) }}" required>
                    </div>
                </div>
            </div>

            <x-btn-simpan route="{{ $route }}"/>

        </form>
    </div>


@endsection
