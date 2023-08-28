@extends('layouts/contentNavbarLayout')

@section('title', "Edit $name")

@section('content')
    <div class="container">
        <form method="POST" action="/langganan/{{ $data->id }}">
            @csrf
            @method('PUT')
            <div class="row mb-3">
                <div class="col">
                    <label for="name" class="form-label">Name:</label>
                    <input type="text" name="name" id="name" class="form-control"
                        value="{{ old('name', $data->name) }}" required>
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
            <div id="flowers-container">
                <div id="card" class="card">
                    <div class="card-header d-flex align-items-center">
                        <h5>Pesanan</h5>
                        <button type="button" id="add-flower" class="btn btn-primary ms-auto">Tambah</button>
                    </div>
                    <div id="card-body" class="card-body">
                        @foreach ($data->flowers as $flowerz)
                            <div class="row flower-input mb-3">
                                <div class="col-6">
                                    <label for="flower_id" class="form-label">Bunga:</label>
                                    <select name="flower_id[]" class="form-select flower-select" required>
                                        @foreach ($flowers as $f)
                                            @if (old('flower_id[]', $flowerz->id) == $f->id)
                                                <option value="{{ $f->id }}" selected>{{ $f->name }}</option>
                                            @else
                                                <option value="{{ $f->id }}">{{ $f->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-5">
                                    <label for="total" class="form-label">Jumlah:</label>
                                    <input type="number" name="total[]" class="form-control total-input" min="0"
                                        value="{{ $flowerz->pivot->total }}">
                                </div>
                                <div class="col-1 d-flex align-items-end">
                                    <button type="button" class="btn btn-danger delete-flower "><i class="bx bx-trash"></i></button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label for="regencies_id" class="form-label">Daerah:</label>
                    <select name="regencies_id" id="regencies_id" class="form-select" required>
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
                    <select name="day_id" id="day_id" class="form-select" required>
                        <option value="">Pilih Hari</option>
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
                <textarea name="notes" id="notes" class="form-control">{{ old('notes', $data->notes) }}</textarea>
            </div> 
            
            <div class="mb-3">
                <label for="pic" class="form-label">Catatan:</label>
                <input type="text" name="pic" id="pic" class="form-control" value="{{ old('pic', $data->pic) }}" required>
            </div>

            <x-btn-simpan route="{{ $route }}"/>

        </form>
    </div>
    <script>
        // Fetch JSON data for flowers
        var flowersData = <?php echo json_encode($flowers); ?>;

    </script>

@endsection

@push('myscript')
<script type="text/javascript" src="{{ URL::asset ('/assets/_stacks/loop_order.js') }}"></script>
@endpush