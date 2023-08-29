@extends('layouts/contentNavbarLayout')

@section('title', 'Daftar ' . ucfirst($route))

@section('content')

    <div class="table mt-3">
        <table class="table table-striped table-hover fluid-table w-100 " cellpadding="10" cellspacing=0 border=1>
            <thead>
                <tr>
                    <th class="tab-id">ID</th>
                    <th>Route</th>
                    <th>Driver</th>
                    <th>Nama</th>
                    <th>Bunga</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                    <th>Ongkir</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody >
                @if (count($data) > 0)
                    @php
                        $nomor = 1 + ($data->currentPage() - 1) * $data->perPage();
                    @endphp
                    @foreach ($data as $d)
                        @php
                            $flowersCount = $d->flowers->count();
                        @endphp
                        <tr>
                            <td class="td-order">{{ $nomor++ }}</td>
                            <td class="td-order">{{ $d->route}}</td>
                            <td class="td-order">{{ $d->rider}}</td>
                            <td class="td-order">
                                @if ($flowersCount > 1)
                                    @for ($i = 0; $i < $flowersCount; $i++)
                                        <div class="fw-bold">{{ $d->name }}</div>
                                    @endfor
                                @else
                                    <div class="fw-bold">{{ $d->name }}</div>
                                @endif
                            </td>
                            <td class="td-nowrap">
                                @foreach ($d->flowers as $flower)
                                    <div>{{ $flower->name }}</div>
                                @endforeach
                            </td>
                            <td class="td-order">
                                @foreach ($d->flowers as $flower)
                                    <div>{{ $flower->pivot->total }}</div>
                                @endforeach
                            </td>
                            <td class="td-order">
                                @foreach ($d->flowers as $flower)
                                <?php $total = ($flower->pivot->total * $flower->price); ?> <!-- Menambahkan ($d->range * 3000) ke totalSum -->
                                <div>Rp. {{ number_format($total, 0, ',', '.') }}</div> <!-- Menampilkan total hasil akhir dalam format Rupiah -->
                                @endforeach
                            </td>
                            <td class="td-order">
                                <?php $ongkir = ($d->range * 3000); ?> <!-- Menambahkan ($d->range * 3000) ke totalSum -->
                                <div>Rp. {{ number_format($ongkir, 0, ',', '.') }}</div> <!-- Menampilkan total hasil akhir dalam format Rupiah -->
                            </td>
                            <td class="td-order">
                                <?php $totalSum = 0; ?> <!-- Membuat variabel penampung -->
                                @foreach ($d->flowers as $flower)
                                    <?php $subtotal = ($flower->pivot->total * $flower->price); ?> <!-- Menghitung subtotal untuk setiap bunga -->
                                    <?php $totalSum += $subtotal; ?> <!-- Menambahkan subtotal ke totalSum -->
                                    {{-- <div>Rp. {{ number_format($subtotal, 0, ',', '.') }}</div> <!-- Menampilkan subtotal dalam format Rupiah --> --}}
                                @endforeach
                                <?php $totalSum += ($d->range * 3000); ?> <!-- Menambahkan ($d->range * 3000) ke totalSum -->
                                <div>Rp. {{ number_format($totalSum, 0, ',', '.') }}</div> <!-- Menampilkan total hasil akhir dalam format Rupiah -->
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
