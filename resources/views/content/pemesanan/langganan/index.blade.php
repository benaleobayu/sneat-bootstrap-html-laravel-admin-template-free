@extends('layouts/contentNavbarLayout')

@section('title', 'Langganan')

@section('content')
    <div class="top-addon">
        <button type="button" class="btn btn-success">Create</button>
    </div>

    <div class="table">
        <table class="fluid-table w-100" cellpadding="10" cellspacing=0 >
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Bunga</th>
                    <th>Jumlah</th>
                    <th>Daerah</th>
                    <th>Catatan</th>
                    <th>PIC</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    @foreach ($data as $d)
                    <td>{{ $d->id }}</td>
                    @endforeach
                </tr>
            </tbody>
        </table>
    </div>
@endsection
