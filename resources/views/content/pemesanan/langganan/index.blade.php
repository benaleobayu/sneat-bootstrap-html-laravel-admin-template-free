@extends('layouts/contentNavbarLayout')

@section('title', 'Langganan')

@section('content')
    <div class="top-addon">
        <button class="btn btn-success" onclick="window.location='/langganan/create'">Create</button>
    </div>

    <div class="table mt-3">
        <table class="fluid-table w-100" cellpadding="10" cellspacing=0 border=1>
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
                @if (count($data) > 0)
                @php
                    $nomor = 1 + ($data->currentPage() - 1) * $data->perPage();
                @endphp
                @foreach ($data as $d)
                    @php
                        $flowersCount = $d->flowers->count();
                    @endphp
                    <tr>
                        <td>{{ $nomor++ }}</td>
                        <td>
                            @if ($flowersCount > 1)
                                @for ($i = 0; $i < $flowersCount; $i++)
                                    <div class="fw-bold">{{ $d->name }}</div>
                                @endfor
                            @else
                                <div class="fw-bold">{{ $d->name }}</div>
                            @endif
                            <div class="fw-bold"><span class="fw-normal">Alamat :</span> {{ $d->address }},
                                {{ $d->regencies->name }}, {{ $d->regencies->city }} <br>
                                <span class="fw-normal">Telp :</span> {{ $d->phone }}
                            </div>
                        </td>
                        <td>
                            @foreach ($d->flowers as $flower)
                                <div>{{ $flower->name }}</div>
                            @endforeach
                        </td>
                        <td>
                            @foreach ($d->flowers as $flower)
                                <div>{{ $flower->pivot->total }}</div>
                            @endforeach
                        </td>
                        <td>
                            @if ($flowersCount > 1)
                                @for ($i = 0; $i < $flowersCount; $i++)
                                    <div>{{ $d->regencies->name }}</div>
                                @endfor
                            @else
                                <div>{{ $d->regencies->name }}</div>
                            @endif
                        </td>
                        <td>{{ $d->notes }}</td>
                        <td>{{ $d->pic }}</td>
                        <td>
                            <button class="badge rounded bg-secondary"
                                onclick="window.location='/langganan/{{ $d->id }}'"><i
                                    class='bx bx-show'></i></button>
                            <button class="badge rounded bg-primary"
                                onclick="window.location='/langganan/{{ $d->id }}/edit'"><i
                                    class='bx bx-edit'></i></button>
                            <form class="d-inline" action="/langganan/{{ $d->id }}" method="post">
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
