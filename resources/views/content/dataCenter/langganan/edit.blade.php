@extends('layouts/contentNavbarLayout')

@section('title', "Edit $name")

@section('content')
    <!-- create.blade.php -->
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
                    <input type="text" name="phone" id="phone" class="form-control"
                        value="{{ old('phone', $data->phone) }}" required>
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
                                    <button type="button" class="btn btn-danger delete-flower ">X</button>
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

            <button type="submit" class="btn btn-primary my-3">Simpan</button>
        </form>
    </div>
    <script>
        // Fetch JSON data for flowers
        var flowersData = <?php echo json_encode($flowers); ?>;

        // Populate select element with flowers data
        var flowerSelect = document.querySelector('.flower-select');
        for (var i = 0; i < flowersData.length; i++) {
            var option = document.createElement('option');
            option.value = flowersData[i].id;
            option.textContent = flowersData[i].name;
            flowerSelect.appendChild(option);
        }

        document.getElementById('add-flower').addEventListener('click', function() {
            var container = document.getElementById('flowers-container');
            var container = document.getElementById('card');
            var container = document.getElementById('card-body');
            var row = document.createElement('div');
            row.classList.add('row', 'flower-input', 'my-3');

            var col1 = document.createElement('div');
            col1.classList.add('col-6');
            var labelFlower = document.createElement('label');
            labelFlower.classList.add('form-label');
            labelFlower.textContent = 'Bunga';
            col1.appendChild(labelFlower);
            var newFlowerSelect = flowerSelect.cloneNode(true);
            newFlowerSelect.required = true;
            col1.appendChild(newFlowerSelect);

            var col2 = document.createElement('div');
            col2.classList.add('col-5');
            var labelTotal = document.createElement('label');
            labelTotal.classList.add('form-label');
            labelTotal.textContent = 'Jumlah';
            col2.appendChild(labelTotal);
            var totalInput = document.createElement('input');
            totalInput.setAttribute('type', 'number');
            totalInput.setAttribute('name', 'total[]');
            totalInput.classList.add('form-control', 'total-input');
            totalInput.setAttribute('min', '0');
            totalInput.value = '0';
            col2.appendChild(totalInput);

            var col3 = document.createElement('div');
            col3.classList.add('col-1', 'd-flex', 'align-items-end');
            var deleteButton = document.createElement('button');
            deleteButton.setAttribute('type', 'button');
            deleteButton.classList.add('btn', 'btn-danger', 'delete-flower');
            deleteButton.textContent = 'X';
            col3.appendChild(deleteButton);

            row.appendChild(col1);
            row.appendChild(col2);
            row.appendChild(col3);
            container.appendChild(row);
        });

        // Delete button functionality
        document.addEventListener('click', function(event) {
            if (event.target.classList.contains('delete-flower')) {
                var flowerRow = event.target.closest('.flower-input');
                flowerRow.remove();
            }
        });
    </script>

@endsection
