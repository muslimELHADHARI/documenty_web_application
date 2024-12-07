@extends('layout')
@section('content')
<div class="container py-5">
    <h3 class="text-center mb-4">Search Results</h3>
    @if($results->count() > 0)
    <ul class="list-unstyled">
        @foreach($results as $result)
            <li class="mb-4">
                <div class="card shadow-lg rounded-3 border-0">
                    <div class="card-header bg-primary text-white">
                        <strong>{{ $result->title }}</strong>
                    </div>
                    <div class="card-body">
                        <p class="text-muted mb-3">{{ Str::limit($result->description, 150) }}</p> <!-- Limiting description length for better design -->
                        
                        <a href="#!">
                            <img class="card-img-top img-fluid rounded-3 mb-3" src="{{ Storage::url($result->cover_path) }}" alt="Cover Image" style="max-width: 200px; height: auto;" />
                        </a>
                        
                        <a class="btn btn-outline-primary rounded-pill" href="{{ route('items.show', $result->id) }}" role="button" style="padding: 10px 20px; font-size: 14px;">
                            More...
                        </a>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
    @else
        <p class="text-center">No results found for your search.</p>
    @endif
</div>
@endsection

@push('scripts') 
<script>
    $('#button-search').on('click', function() {
        var query = $('input[name="query"]').val();
        if (query) {
            window.location.href = "{{ route('search') }}?query=" + query;
        }
    });
</script>
@endpush
