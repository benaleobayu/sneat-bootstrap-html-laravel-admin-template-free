@extends('layouts/contentNavbarLayout')

@section('title', 'Edit daerah')

@section('content')
    <div class="container">
        <form method="POST" action="/daerah/{{ $data->id }}">
            @csrf
            @method('PUT')
            <div class="row mb-3">
                <div class="col">
                    <label for="name" class="form-label">Nama Daerah:</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $data->name) }}" required>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="mb-3">
                        <label for="city" class="form-label">Kota:</label>
                        <input type="text" name="city" id="city" class="form-control" value="{{ old('city', $data->city) }}" required>
                    </div>
                </div>
            </div>

            <x-btn-simpan route="{{ $route }}"/>

        </form>
    </div>


@endsection
