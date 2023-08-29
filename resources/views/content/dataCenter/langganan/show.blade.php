@extends('layouts/contentNavbarLayout')

@section('title', "Lihat data $name")

@section('content')
    <div class="container">
        <div class="row mb-3">
            <div class="col">
                <label for="name" class="form-label">Name:</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $data->name }}" required
                    disabled readonly>
            </div>

            <div class="col">
                <label for="phone" class="form-label">Nomor Handphone:</label>
                <input type="text" name="phone" id="phone" class="form-control" value="{{ $data->phone }}"
                    required disabled readonly>
            </div>
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Alamat:</label>
            <textarea type="text" name="address" id="address" class="form-control" required disabled readonly>{{ $data->address }}</textarea>
        </div>
        <div id="flowers-container">
            <div id="card" class="card mb-3">
                <div class="card-header d-flex align-items-center">
                    <h5>Pesanan</h5>
                    <button type="button" id="add-flower" class="btn btn-primary ms-auto d-none">Tambah</button>

                </div>
                <div id="card-body" class="card-body">
                    @foreach ($data->flowers as $flower)
                        <div class="row flower-input mb-3">
                            <div class="col-6">
                                <label for="flower_id" class="form-label">Bunga:</label>
                                <input class="form-control" type="text" value="{{ $flower->name }}" disabled readonly>
                            </div>
                            <div class="col-5">
                                <label for="total" class="form-label">Jumlah:</label>
                                <input class="form-control" type="text" value="{{ $flower->pivot->total }}" disabled
                                    readonly>
                            </div>
                            <div class="col-1">
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="regencies_id" class="form-label">Daerah:</label>
                <select name="regencies_id" id="regencies_id" class="form-select" required disabled readonly>
                    <option value="">Pilih Daerah</option>
                    @foreach ($regencies as $regency)
                        @if (old('regencies_id', $data->regencies->id) == $regency->id)
                            <option value="{{ $regency->id }}" selected>{{ $regency->name }}</option>
                        @else
                            <option value="{{ $regency->id }}">{{ $regency->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            <div class="col">
                <label for="day_id" class="form-label">Hari:</label>
                <select name="day_id" id="day_id" class="form-select" required disabled readonly>
                    @foreach ($days as $day)
                        @if (old('day_id', $data->day->id) == $day->id)
                            <option value="{{ $day->id }}" selected>{{ $day->name }}</option>
                        @else
                            <option value="{{ $day->id }}">{{ $day->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>

        <div class="mb-3">
            <label for="notes" class="form-label">Catatan:</label>
            <textarea name="notes" id="notes" class="form-control" disabled readonly>{{ $data->notes }}</textarea>
        </div>
        <div class="col-md-4 mb-3">
            <label for="range" class="form-label">Jarak dari Kepodang:</label>
            <input type="text" name="range" id="range" class="form-control" value="{{ old('range', $data->range) }}" disabled>
            <small class="fw-light fst-italic">*Input dalam km (kilometer)</small>
        </div> 
    </div>


@endsection
