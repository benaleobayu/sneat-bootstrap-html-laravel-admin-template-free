@extends('layouts/contentNavbarLayout')

@section('title', 'Tambah '.Str::ucfirst($route))

@section('content')
    <div class="container">
        <form method="POST" action="{{ route('langganan.store') }}">
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
            <div id="flowers-container">
                <div id="card" class="card">
                    <div class="card-header d-flex align-items-center">
                        <h5>Pesanan</h5>
                        <button type="button" id="add-flower" class="btn btn-primary ms-auto">Tambah</button>

                    </div>
                    <div id="card-body" class="card-body">
                        <div class="row flower-input mb-3">
                            <div class="col-6">
                                <label for="flower_id" class="form-label">Bunga:</label>
                                <select name="flower_id[]" class="form-select flower-select" required>
                                    @foreach ($flowers as $flower)
                                        <option value="{{ $flower->id }}">{{ $flower->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-5">
                                <label for="total" class="form-label">Jumlah:</label>
                                <input type="number" name="total[]" class="form-control total-input" min="0"
                                    value="">
                            </div>
                            <div class="col-1">
                            </div>
                        </div>

                    </div>
                </div>
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

                <div class="col">
                    <label for="day_id" class="form-label">Hari:</label>
                    <select name="day_id" id="day_id" class="form-select" required>
                        <option value="">Pilih Hari</option>
                        @foreach ($days as $day)
                            <option value="{{ $day->id }}">{{ $day->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="mb-3">
                <label for="notes" class="form-label">Catatan:</label>
                <textarea name="notes" id="notes" class="form-control"></textarea>
            </div>
            <div class="col-md-4 mb-3">
                <label for="range" class="form-label">Jarak dari Kepodang:</label>
                <input type="text" name="range" id="range" class="form-control" >
                <small class="fw-light fst-italic">*Input dalam km (kilometer)</small>
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
