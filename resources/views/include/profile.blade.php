@extends('layout')
@section('title','Profile')
@section('content')
<section class="h-100 gradient-form" style="background-color: #f8f9fa;">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <!-- Page content -->
    <div class="container py-5">
        <div class="row">
            <!-- Profile Info Section -->
            <div class="col-lg-4">
                <div class="card shadow-sm rounded-3 mb-4 border-0">
                    <div class="card-header text-center" style="background-color: #f1f3f5;">
                        <img src="{{ Storage::url(Auth::user()->profile_pic) }}" class="rounded-circle mb-3" alt="Profile Picture" width="120" height="120"/>
                        <h3 class="h5">{{ $user->name }}</h3>
                        <p class="text-muted">{{ $user->email }}</p>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <strong>Joined:</strong> {{ $user->created_at->format('F d, Y') }}
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <strong>Role:</strong>
                                @if($user->is_admin)
                                <a href="{{ route('admin.dashboard') }}" class="badge bg-success text-decoration-none outline-0 focus-none" style="box-shadow: none;">
                                    Admin</a>
                                
                                @else
                                    <span class="badge bg-danger">
                                        User
                                    </span>
                                @endif
                            </li>
                            
                            
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                @if($location)
                                <strong>Location:</strong> {{ $location->countryName }}
                            @else
                            <strong>Location:</strong> Not found
                            @endif
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- Settings Section -->
                <div class="card shadow-sm rounded-3 mb-4 border-0">
                    <div class="card-header bg-light">Settings</div>
                    <div class="card-body text-center">
                        <a href="{{ route('profile.edit') }}" class="btn btn-outline-primary mb-3 w-100">Edit Profile</a>
                        <a href="{{ route('logout') }}" class="btn btn-danger w-100">Logout</a>
                    </div>
                </div>
            </div>

            <!-- Activity Section -->
            <div class="col-lg-8">
                <div class="card shadow-sm rounded-3 mb-4 border-0">
                    <div class="card-header bg-light">Recent Activities</div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            @foreach($activities as $activity)
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="text-muted small">{{ $activity->created_at->diffForHumans() }}</div>
                                <p class="mb-0">{{ $activity->description }}</p>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <!-- Document Uploads Section -->
                <div class="card shadow-sm rounded-3 mb-4 border-0">
                    <div class="card-header bg-light">Uploaded Documents</div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            @foreach($documents as $document)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <a href="{{ Storage::url($document->file_path) }}" target="_blank" class="text-decoration-none">{{ $document->title }}</a>
                                <div class="text-muted small">Uploaded on {{ $document->created_at->format('F d, Y') }}</div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JS -->
</section>
@endsection
