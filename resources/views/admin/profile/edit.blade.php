@extends('admin.layouts.master')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div>
            <a href="{{ route('profile#view') }}" class="btn btn-dark text-white">Back</a>
        </div>

        <!-- DataTales Example -->
        <div class="card shadow mb-4 col">
            <div class="card-header py-3">
                <div class="">
                    <div class="">
                        <h6 class="m-0 font-weight-bold text-primary">Admin Profile ( <span
                                class="text-danger">{{ $profile->role != null ? $profile->role : 'User' }} Role</span> )
                        </h6>
                    </div>
                </div>
            </div>
            <form action="{{ route('profile#update') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="card-body">
                    <div class="row">
                        <div class="col-3">
                            <!-- Image Display -->
                            <img class="img-profile img-thumbnail w-75" id="output" src="{!! $profile->profile != null
                                ? asset('profileImages/' . $profile->profile)
                                : asset('defaultImage/profileImg.png') !!}">

                            <!-- File Input -->
                            <input type="file" name="image" accept="image/*" class="form-control mt-1"
                                onchange="loadFile(event)">

                        </div>
                        <div class="col">

                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">
                                            Name</label>
                                        <input type="text" name="name"
                                            class="form-control @error('name')
                                            is-invalid
                                        @enderror"
                                            placeholder="Name..."
                                            value="{{ old('name', $profile->name != null ? $profile->name : $profile->nickname) }}">
                                        @error('name')
                                            <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">
                                            Email</label>
                                        <input type="text" name="email"
                                            class="form-control @error('email')
                                            is-invalid
                                        @enderror"
                                            value="{{ old('email', $profile->email) }}" placeholder="Email...">
                                        @error('email')
                                            <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">
                                            Phone</label>
                                        <input type="text" name="phone"
                                            class="form-control @error('phone')
                                            is-invalid
                                        @enderror"
                                            value="{{ old('phone', $profile->phone) }}" placeholder="09xxxxxx">
                                        @error('phone')
                                            <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">
                                            Address</label>
                                        <input type="text" name="address"
                                            class="form-control @error('address')
                                            is-invalid
                                        @enderror"
                                            value="{{ old('address', $profile->address) }}" placeholder="Address">
                                        @error('address')
                                            <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <input type="submit" value="Update" class="btn btn-primary mt-3">
                        </div>
                    </div>
                </div>
            </form>
        </div>

    </div>
@endsection
