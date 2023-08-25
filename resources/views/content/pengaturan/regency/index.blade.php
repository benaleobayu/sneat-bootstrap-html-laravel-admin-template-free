@extends('layouts/contentNavbarLayout')

@section('title', 'Daftar ' . ucfirst($route))

@section('content')

    <x-btn-create route="{{ $route }}"/>

    <div class="table mt-3">
        <table class="fluid-table w-100" cellpadding="10" cellspacing=0 border=1>
            <thead>
                <tr>
                    <th class="tab-id">ID</th>
                    <th>Daerah</th>
                    <th>Kota</th>
                    <th>Update At</th>
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
                            <td>{{ $nomor++ }}</td>
                            <td>{{ $d->name }}</td>
                            <td>{{ $d->city }}</td>
                            <td>{{ $d->updated_at }}</td>
                            <x-btn-action route="{{ $route }}"  id="{{ $d->id }}"/>
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