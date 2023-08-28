@extends('layouts/contentNavbarLayout')

@section('title', 'Lihat ' . $route)

@section('content')
    <div class="container">
            <div class="row mb-3">
                <div class="col">
                    <label for="name" class="form-label">Name:</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $data->name) }}" disabled>
                </div>

                <div class="col">
                    <label for="phone" class="form-label">Nomor Handphone:</label>
                    <input type="text" name="phone" id="phone" class="form-control" value="{{ old('name', $data->phone) }}" disabled>
                </div>
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Alamat:</label>
                <textarea type="text" name="address" id="address" class="form-control" disabled>{{ old('name', $data->address) }}</textarea>
            </div>
            
            <div class="row mb-3">
                <div class="col">
                    <label for="regencies_id" class="form-label">Daerah:</label>
                    <input type="text" name="regencies_id" id="regencies_id" class="form-control" value="{{ old('name', $data->regencies->name) }}" disabled>
                </div>
                <div class="col">
                    <label for="regencies_id" class="form-label">Kota:</label>
                    <input type="text" name="regencies_id" id="regencies_id" class="form-control" value="{{ old('name', $data->regencies->city) }}" disabled>
                </div>


            </div>

            <div class="mb-3">
                <label for="notes" class="form-label" >Catatan:</label>
                <textarea name="notes" id="notes" class="form-control" disabled>{{ $data->notes }}</textarea>
            </div>
            
            <div class="col-md-4 mb-3">
                <label for="range" class="form-label">Jarak dari Kepodang:</label>
                <input type="text" name="range" id="range" class="form-control" value="{{ old('range', $data->range) }}" disabled>
                <small class="fw-light fst-italic">*Input dalam km (kilometer)</small>
            </div> 
            
            <div class="d-flex my-3">
                <button type="btn" class="btn btn-dark ms-auto" onclick="window.location='/{{ $route }}'">Kembali</button>
            </div>
    </div>


@endsection
