@extends('layouts/contentNavbarLayout')

@section('title', 'Tambah ' . $route)

@section('content')
    <div class="container">
        <form method="POST" action="/{{ $route }}">
            @csrf
            <div class="row mb-3">
                <div class="col">
                    <label for="name" class="form-label">Name:</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                </div>

                <div class="col">
                    <label for="phone" class="form-label">Nomor Handphone:</label>
                    <input type="text" name="phone" id="phone" class="form-control" required>
                </div>
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Alamat:</label>
                <textarea type="text" name="address" id="address" class="form-control" required></textarea>
            </div>

            <div class="row mb-3">
                <div class="col">
                    <label for="regencies_id" class="form-label">Daerah:</label>
                    <select name="regencies_id" id="regencies_id" class="form-select" required>
                        <option value="">Pilih Daerah</option>
                        @foreach ($regencies as $regency)
                            <option value="{{ $regency->id }}">{{ $regency->name }}, {{ $regency->city }}</option>
                        @endforeach
                    </select>
                </div>


                
                <div class="col-md-12 mb-3">
                    <label for="notes" class="form-label">Catatan:</label>
                    <textarea name="notes" id="notes" class="form-control"></textarea>
                </div>
                
                <div class="col-md-4 mb-3">
                    <label for="range" class="form-label">Jarak dari Kepodang:</label>
                    <input type="text" name="range" id="range" class="form-control" required>
                    <small class="fw-light fst-italic">*Input dalam km (kilometer)</small>
                </div> 
            </div>

            
            <x-btn-simpan route="{{ $route }}"/>
        </form>
    </div>


@endsection
