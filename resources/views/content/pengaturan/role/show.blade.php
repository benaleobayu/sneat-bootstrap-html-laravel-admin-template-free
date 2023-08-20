@extends('layouts/contentNavbarLayout')

@section('title', 'Show Role')

@section('content')
    <div class="container">
        <h1>Show Role</h1>
            <div class="form-group">
                <label for="name">Role Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $role->name }}" disabled>
            </div>
            <div class="form-group">
                <label>Permissions</label>
                @foreach($permissions as $permission)
                    <div class="form-check">
                        <input type="checkbox" name="permissions[]" value="{{ $permission->name }}" class="form-check-input" @if($role->hasPermissionTo($permission->name)) checked @endif disabled>
                        <label class="form-check-label">{{ $permission->name }}</label>
                    </div>
                @endforeach
            </div>
            <button type="btn" class="btn btn-primary" onclick="window.location='/roles'">Kembali</button>
    </div>
@endsection
