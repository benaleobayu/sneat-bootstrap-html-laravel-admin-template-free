@extends('layouts/contentNavbarLayout')

@section('title', 'Tambah ' .Str::ucfirst($route))

@section('content')
    <div class="container">
        <form method="POST" action="/{{ $route }}">
            @csrf
            <div class="row mb-3">
                <div class="col-md-12">
                    <label for="name" class="form-label">Nama :</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                </div>

                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="slug" class="form-label">Slug:</label>
                        <input type="text" name="slug" id="slug" class="form-control" required>
                    </div>
                </div>
                 <div class="col-md-6">
                    <div class="mb-3">
                        <label for="date_start" class="form-label">Tanggal Mulai</label>
                        <input type="date" name="date_start" id="date_start" class="form-control" required>
                    </div>
                </div>
                 <div class="col-md-6">
                    <div class="mb-3">
                        <label for="date_end" class="form-label">Tanggal Akhir</label>
                        <input type="date" name="date_end" id="date_end" class="form-control" required>
                    </div>
                </div>
                
            </div>

            <x-btn-simpan route="{{ $route }}"/>

    </div>


@endsection
