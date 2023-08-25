@extends('layouts/contentNavbarLayout')

@section('title', 'My Profile')

@section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Account Settings /</span> Account
    </h4>

    <div class="row">
        <div class="col-md-12">
            <ul class="nav nav-pills flex-column flex-md-row mb-3">
                <li class="nav-item"><a class="nav-link active" href="/myprofile"><i class="bx bx-user me-1"></i>
                        Account</a></li>
            </ul>
            <div class="card mb-4">
                <h5 class="card-header">Profile Details</h5>
                <!-- Account -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-2">
                            <div class=" d-block pt-3">
                                <img src="{{ asset('assets/img/avatars/1.png') }}" alt="user-avatar" class="object-fit-md-contain w-100 rounded " id="uploadedAvatar" />
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3 col-md-12">
                                <label for="firstName" class="form-label">First Name</label>
                                <input class="form-control" type="text" id="firstName" name="firstName" value="{{ $user->name }}" disabled />
                            </div>
                            <div class="mb-3 col-md-12">
                                <label for="firstName" class="form-label">Username</label>
                                <input class="form-control" type="text" id="firstName" name="firstName" value="{{ $user->username }}" disabled />
                            </div>
                            <div class="mb-3 col-md-12">
                                <label for="email" class="form-label">E-mail</label>
                                <input class="form-control" type="text" id="email" name="email" value="{{ $user->email }}" disabled />
                            </div>
                            <div class="mt-2">
                                <button type="btn" class="btn btn-primary me-2" onclick="window.location='/myprofile/{{ $user->id }}/edit'">Edit</button>
                                <button type="reset" class="btn btn-outline-secondary">Dashboard</button>
                            </div>
    
                        </div>

                    </div>
                </div>
                <!-- /Account -->
            </div>
            <div class="my-5">
            </div>
        </div>
    </div>
@endsection
