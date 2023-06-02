@extends('layouts/contentNavbarLayout')

@section('title', 'Pengaturan Admin')

@section('content')
    <div class="top-addon">
        <button class="btn btn-success" onclick="window.location='/admin/create'">Create</button>
    </div>

    <div class="table mt-3">
        <table class="fluid-table w-100" cellpadding="10" cellspacing=0 border=1>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>Email</th>
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
                            <td>{{ $d->name }}</td>
                            <td>{{ $d->username }}</td>
                            <td>{{ $d->email }}</td>
                            <td>
                                <button class="badge rounded bg-secondary"
                                    onclick="window.location='/admin/{{ $d->id }}'"><i class='bx bx-show'></i></button>
                                <button class="badge rounded bg-primary"
                                    onclick="window.location='/admin/{{ $d->id }}/edit'"><i
                                        class='bx bx-edit'></i></button>
                                <form class="d-inline" action="/admin/{{ $d->id }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="badge rounded bg-danger"><i class='bx bx-trash'></i></button>
                                </form>
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
