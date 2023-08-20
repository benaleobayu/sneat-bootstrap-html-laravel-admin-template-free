@extends('layouts/contentNavbarLayout')

@section('title', 'Pengaturan Admin')

@section('content')
    <div class="d-flex">
        <div class="top-addon ms-auto">
            <button class="btn btn-primary" onclick="window.location='/{{ $route }}'"><i
                    class='bx bx-refresh'></i></button>
            <button class="btn btn-success" onclick="window.location='/{{ $route }}/create'">Create</button>
        </div>
    </div>
    <div class="table mt-3">
        <table class="fluid-table w-100" cellpadding="10" cellspacing=0 border=1>
            <thead>
                <tr>
                    <th class="tab-id">ID</th>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Role</th>
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
                            <td>{{ $d->username }}</td>
                            <td>{{ $d->email }}</td>
                            @foreach ($d->roles as $role)
                                <td>
                                    {{ $role->name }}
                                </td>
                            @endforeach
                            <td class="tab-act-value">
                                <button class="badge rounded bg-secondary"
                                    onclick="window.location='/admin/{{ $d->id }}'"><i
                                        class='bx bx-show'></i></button>
                                <button class="badge rounded bg-primary"
                                    onclick="window.location='/admin/{{ $d->id }}/edit'"><i
                                        class='bx bx-edit'></i></button>
                                {{-- <form action="/admin/{{ $d->id }}" method="post">
                                    @csrf
                                    @method('DELETE') --}}
                                    <button class="badge rounded bg-danger delete-btn" data-id="{{ $d->id }}"><i class='bx bx-trash'></i></button>
                                {{-- </form> --}}
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


    <script>
        // Menangani klik pada tombol hapus
        document.addEventListener('click', function (e) {
            if (e.target.classList.contains('delete-btn')) {
                const entityId = e.target.getAttribute('data-id');
    
                Swal.fire({
                    title: 'Konfirmasi',
                    text: 'Apakah Anda yakin ingin menghapus items ini?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Jika pengguna mengonfirmasi penghapusan, kirimkan permintaan penghapusan ke server
                        // Gantilah 'your-delete-endpoint' dengan endpoint penghapusan yang sesuai
                        fetch(`/admin/${entityId}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            }
                        }).then(response => {
                            if (response.ok) {
                                // Jika penghapusan berhasil, tampilkan pesan sukses
                                Swal.fire(
                                    'Terhapus!',
                                    'Item telah dihapus.',
                                    'success'
                                ).then(() => {
                                    // Jika penghapusan berhasil, perbarui tampilan atau lakukan tindakan lain yang sesuai
                                    window.location.reload(); // Ini akan memuat ulang halaman
                                });
                            } else {
                                // Jika penghapusan gagal, tampilkan pesan kesalahan
                                Swal.fire(
                                    'Gagal!',
                                    'Terjadi kesalahan saat menghapus item.',
                                    'error'
                                );
                            }
                        });
                    }
                });
            }
        });
    </script>
    
    @endsection
