<div>
    <!-- Simplicity is the ultimate sophistication. - Leonardo da Vinci -->
    @php
        $view = 'View.' . Str::ucfirst($route);
        $edit = 'Edit.' . Str::ucfirst($route);
        $delete = 'Delete.' . Str::ucfirst($route);
    @endphp
    <td class="tab-act-value d-flex flex-nowrap">
        @can($view)
        <button class="badge rounded bg-secondary" onclick="window.location='/{{ $route }}/{{ $id }}'" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Detail"><i class='bx bx-show'></i></button>
        @endcan
        @can($edit)
        <button class="badge rounded bg-primary" onclick="window.location='/{{ $route }}/{{ $id }}/edit'" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Edit"><i class='bx bx-edit'></i></button>
        @endcan
        @can($delete)
        <button class="badge rounded bg-danger delete-btn" data-id="/{{ $route }}/{{ $id }}" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Hapus"><i class="bx bx-trash delete-btn" data-id="/{{ $route }}/{{ $id }}"></i></button>
        @endcan
    </td>
</div>
