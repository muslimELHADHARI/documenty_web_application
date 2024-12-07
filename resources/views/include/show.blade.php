@extends('layout')
@section('title', $item->title)
@section('content')
<section class="h-100 gradient-form" style="background-color: #f8f9fa;">
    <div class="container my-5">
        <div class="row">
            <div class="col-lg-8">
                <!-- Item Details -->
                <div class="card shadow-lg rounded-3 border-0 mb-4">
                    <img class="card-img-top rounded-3" src="{{ Storage::url($item->cover_path) }}" alt="{{ $item->title }}" />
                    <div class="card-body">
                        <div class="small text-muted">{{ $item->created_at->format('F j, Y') }}</div>
                        <h1 class="card-title mt-3">{{ $item->title }}</h1>
                        <p class="card-text mt-4">{{ $item->description }}</p>
                        <a href="{{ Storage::url($item->file_path) }}" class="btn btn-primary rounded-pill mt-3" target="_blank" style="padding: 10px 20px;">Download Document</a>
                    </div>
                </div>
            </div>

            <!-- Sidebar with Author Info -->
            <div class="col-lg-4">
                <div class="card shadow-lg rounded-3 border-0 mb-4">
                    <div class="card-header bg-primary text-white">
                        <strong>Additional Info</strong>
                    </div>
                    <div class="card-body">
                        <h5 class="mb-3">Author Details</h5>
                        <p><strong>Name:</strong> {{ $item->user->name }}</p>
                        <p><strong>Email:</strong> {{ $item->user->email }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
