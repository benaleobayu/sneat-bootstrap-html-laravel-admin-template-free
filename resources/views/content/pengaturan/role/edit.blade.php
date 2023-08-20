@extends('layouts/contentNavbarLayout')

@section('title', 'Daftar Roles')

@section('content')
    <div class="container">
        <div class="card mb-3">
            <div class="card-body pb-2">
                <h1>Edit Role</h1>
            </div>
        </div>
        <form method="POST" action="{{ route('roles.store') }}/{{ $role->id }}">
            @csrf
            @method('PUT')
            <div class="form-group mb-3">
                <label class="fw-bold" for="name">Role Name</label>
                <input type="text" name="name" id="name" class="form-control w-50" value="{{ old('name', $role->name) }}" required>
            </div>
            <div class="form-group mb-3">
                <input type="checkbox" id="check-all" class="form-check-input">
                <label>Checklist All Permissions</label>
            </div>
            <div class="card mb-3">
                <div class="card-body">
                    
                <table class="w-100" cellpadding="10" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Read</th>
                            <th>Create</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($permissions as $permission)
                        <tr>
                                @php
                                    $parts = explode('.', $permission->name);
                                    
                                    $beforeDot = $parts[0]; // Bagian sebelum titik
                                    $afterDot = $parts[1]; // Bagian setelah titik
                                @endphp
                                <td>
                                    <div class="form-check">
                                        <input type="checkbox" name="permissions[]" value="{{ $permission->name }}"
                                            class="form-check-input">
                                        <label class="form-check-label">{{ $afterDot }}</label>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-check">
                                        <input type="checkbox" name="permissions[]" value="{{ $permission->name }}"
                                            class="form-check-input">
                                        <label class="form-check-label">{{ $permission->name }}</label>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-check">
                                        <input type="checkbox" name="permissions[]" value="{{ $permission->name }}"
                                            class="form-check-input">
                                        <label class="form-check-label">{{ $permission->name }}</label>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-check">
                                        <input type="checkbox" name="permissions[]" value="{{ $permission->name }}"
                                            class="form-check-input">
                                        <label class="form-check-label">{{ $permission->name }}</label>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-check">
                                        <input type="checkbox" name="permissions[]" value="{{ $permission->name }}"
                                            class="form-check-input">
                                        <label class="form-check-label">{{ $permission->name }}</label>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                    </tbody>
                </table>
            </div>

        </div>
            <div class="d-flex px-3">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <button type="btn" class="btn btn-secondary ms-auto" onclick="window.location='/daerah'">Kembali</button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const checkAll = document.getElementById('check-all');
            const permissionCheckboxes = document.querySelectorAll('input[name="permissions[]"]');

            checkAll.addEventListener('change', function() {
                permissionCheckboxes.forEach(checkbox => {
                    checkbox.checked = checkAll.checked;
                });
            });
        });
    </script>
@endsection
