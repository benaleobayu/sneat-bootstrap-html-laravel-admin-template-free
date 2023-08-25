@extends('layouts/contentNavbarLayout')

@section('title', 'Daftar Bunga')

@section('content')
<div class="d-flex">
    <div class="top-addon ms-auto">
        <button class="btn btn-primary" onclick="window.location='/{{ $route }}'"><i class='bx bx-refresh'></i></button>
        <button class="btn btn-success" onclick="window.location='/{{ $route }}/create'">Create</button>
    </div>
</div>

    <div class="table mt-3">
        <table class="fluid-table w-100" cellpadding="10" cellspacing=0 border=1>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>Harga</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @if (count($data) > 0)
                    @php
                        $nomor = 1 + ($data->currentPage() - 1) * $data->perPage();
                    @endphp
                    @foreach ($data as $d)
                        <tr>
                            <td>{{ $nomor++ }}</td>
                            <td>{{ $d->code }}</td>
                            <td>{{ $d->name }}</td>
                            <td>{{ $d->price }}</td>
                            <td>
                                <button class="badge rounded bg-primary" onclick="window.location='/{{ $route }}/{{ $d->id }}/edit'"><i class='bx bx-edit'></i></button>
                                <button class="badge rounded bg-danger delete-btn" data-id="/{{ $route }}/{{ $d->id }}" ><i class="bx bx-trash delete-btn" data-id="/{{ $route }}/{{ $d->id }}"></i></button>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td class="p-0">
                            <h1 class="position-absolute top-50 start-50">No Results</h1>
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>

    {{ $data->links() }}
@endsection

@push('myscript')
<script type="text/javascript" src="{{ URL::asset ('/assets/_stacks/delete.js') }}"></script>
@endpush