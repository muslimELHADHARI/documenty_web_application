@extends('layout')
@section('title', 'Edit Profile')
@section('content')
<section class="h-100 gradient-form" style="background-color: #f8f9fa;">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card shadow-sm rounded-3 mb-4 border-0">
                    <div class="card-header text-center bg-light">
                        <h3 class="h5">Edit Profile</h3>
                    </div>
                    <div class="card-body">

                        <!-- Success and Error Messages -->
                        @if(session()->has('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                        @endif

                        @if($errors->any())
                        <div class="alert alert-danger">
                            @foreach($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                        @endif
                        <!-- Edit Profile Form -->
                           <!-- Spoofing the PUT method -->
                           <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                           <input type="hidden" name="_method" value="POST">                          
                           @csrf
                            <div class="form-outline mb-4">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', Auth::user()->name) }}" required />
                            </div>

                            <div class="form-outline mb-4">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" id="email" name="email" class="form-control" value="{{ old('email', Auth::user()->email) }}" required />
                            </div>

                            <div class="form-outline mb-4">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" id="password" name="password" class="form-control" placeholder="Leave blank if unchanged" />
                            </div>

                            <div class="form-outline mb-4">
                                <label for="profile_pic" class="form-label">Profile Picture</label>
                                <input type="file" id="profile_pic" name="profile_pic" class="form-control" />
                            </div>

                            <button type="submit" class="btn btn-primary w-100">Save Changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
