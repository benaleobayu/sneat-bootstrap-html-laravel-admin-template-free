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


            </div>

            <div class="mb-3">
                <label for="notes" class="form-label">Catatan:</label>
                <textarea name="notes" id="notes" class="form-control"></textarea>
            </div>
            <div class="d-flex my-3">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <button type="btn" class="btn btn-seconday ms-auto" onclick="window.location='/{{ $route }}'">Kembali</button>
            </div>
        </form>
    </div>


@endsection
