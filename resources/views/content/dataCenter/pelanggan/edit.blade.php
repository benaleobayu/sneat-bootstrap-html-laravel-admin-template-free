@extends('layouts/contentNavbarLayout')

@section('title', 'Tambah ' . $route)

@section('content')
    <div class="container">
        <form method="POST" action="{{ route('pelanggan.store') }}/{{ $data->id }}">
            @csrf
            @method('PUT')
            <div class="row mb-3">
                <div class="col">
                    <label for="name" class="form-label">Name:</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $data->name) }}" required>
                </div>

                <div class="col">
                    <label for="phone" class="form-label">Nomor Handphone:</label>
                    <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone', $data->phone) }}" required>
                </div>
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Alamat:</label>
                <textarea type="text" name="address" id="address" class="form-control" required>{{ old('address', $data->address) }}</textarea>
            </div>

            <div class="row mb-3">
                <div class="col">
                    <label for="regencies_id" class="form-label">Daerah:</label>
                    <select name="regencies_id" id="regencies_id" class="form-select" required>
                        <option value="">Pilih Daerah</option>
                        @foreach ($regencies as $r)
                                @if (old('regencies_id', $data->regencies->id) == $r->id)
                                    <option value="{{ $r->id }}" selected>{{ $r->name }}, {{ $r->city }}</option>
                                @else
                                    <option value="{{ $r->id }}">{{ $r->name }}, {{ $r->city }}</option>
                                @endif
                            @endforeach
                    </select>
                </div>


            </div>

            <div class="mb-3">
                <label for="notes" class="form-label">Catatan:</label>
                <textarea name="notes" id="notes" class="form-control">{{ old('notes', $data->notes) }}</textarea>
            </div>
            <div class="d-flex my-3">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <button type="btn" class="btn btn-dark ms-auto" onclick="window.location='/{{ $route }}'">Kembali</button>
            </div>
        </form>
    </div>


@endsection
