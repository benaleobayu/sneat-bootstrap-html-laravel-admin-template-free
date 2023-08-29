@extends('layouts/contentNavbarLayout')

@section('title', 'Daftar ' . ucfirst($route))

@section('content')

    @php
        $create = 'Create.' . Str::ucfirst($route);
    @endphp
    <div class="d-flex">
        <div class="top-addon ms-auto">
            <button class="btn btn-primary px-2" onclick="window.location='/{{ $route }}'"><i
                    class='bx bx-refresh'></i></button>
            @can($create)
                <button class="btn btn-success" onclick="window.location='/{{ $route }}/h/create'">Create</button>
            @endcan
        </div>
    </div>
    <div class="table mt-3">
        <table class="fluid-table w-100" cellpadding="10" cellspacing=0 border=1>
            <thead>
                <tr>
                    <th class="tab-id">ID</th>
                    <th>Hari Pesanan</th>
                    <th>Tanggal</th>
                    <th class="tab-act">Actions</th>
                </tr>
            </thead>
            <tbody>
                @if (count($data) > 0)
                    @php
                        $nomor = 1 + ($data->currentPage() - 1) * $data->perPage();
                    @endphp
                    @foreach ($data as $d)
                        <tr>
                            <td class="td-order">{{ $nomor++ }}</td>
                            <td class="td-order">{{ $d->name }}</td>
                            <td class="td-order">{{ $d->date_start }} s/d {{ $d->date_end }}</td>
                            @php
                                $view = 'View.' . Str::ucfirst($route);
                                $edit = 'Edit.' . Str::ucfirst($route);
                                $delete = 'Delete.' . Str::ucfirst($route);
                            @endphp
                            <td class="tab-act-value d-flex flex-nowrap">
                                @can($view)
                                    <button class="badge rounded bg-secondary" onclick="window.location='/{{ $route }}/{{ $d->slug }}'" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Lihat Pesanan"><i class='bx bx-show'></i></button>
                                    <button class="badge rounded bg-secondary" onclick="window.location='/{{ $route }}/{{ $d->slug }}/invoice'" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Invoice"><i class='bx bx-notepad'></i></button>
                                @endcan
                                @can($edit)
                                    <button class="badge rounded bg-primary" onclick="window.location='/pesanan/h/{{ $d->id }}/edit'" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Edit"><i class='bx bx-edit'></i></button>
                                @endcan
                                @can($delete)
                                    <button class="badge rounded bg-danger delete-btn" data-id="/hari/{{ $d->id }}" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Hapus"><i class="bx bx-trash delete-btn" data-id="/hari/{{ $d->id }}"></i></button>
                                @endcan
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
    <script type="text/javascript" src="{{ URL::asset('/assets/_stacks/order_import.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('/assets/_stacks/delete.js') }}"></script>
@endpush
