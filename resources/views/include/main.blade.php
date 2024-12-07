@extends('layout')
@section('title', 'Homepage')
@section('content')
<section class="h-100 gradient-form" style="background-color: #f7f7f7;">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

    <!-- Page content -->
    <div class="container py-5">
        <div class="row">
            <!-- Blog entries -->
            <div class="col-lg-8">
                <div class="card-header bg-primary text-white text-center fs-5">Latest Update</div>
                <!-- Featured blog post -->
                @php
                    $firstItem = $items->first(); // Get the first item from the collection
                @endphp

                @if ($firstItem)
                    <div class="card mb-4 shadow-lg rounded-3 border-0 overflow-hidden">
                        <a href="#!">
                            <img class="card-img-top" src="{{ Storage::url($firstItem->cover_path) }}" alt="Cover Image" />
                        </a>
                        <div class="card-body">
                            <div class="small text-muted">{{ $firstItem->created_at->format('F j, Y') }}</div>
                            <h2 class="card-title fs-4">{{ $firstItem->title }}</h2>
                            <p class="card-text">{{ \Illuminate\Support\Str::limit($firstItem->description, 150) }}</p>
                            <a class="btn btn-outline-primary rounded-pill" href="{{ route('items.show', $firstItem->id) }}">Read More →</a>
                        </div>
                    </div>
                @else
                    <p>No items available.</p>
                @endif

                <!-- Paginated items -->
                <div class="card-header bg-primary text-white text-center fs-5">All Updates</div>
                <div id="paginated-items" class="row d-flex justify-content-start"> 
                    <!-- Items will be dynamically inserted here -->
                </div>

                <!-- Pagination Controls -->
                <div class="d-flex justify-content-center mt-4">
                    <nav>
                        <ul class="pagination" id="pagination-controls"></ul>
                    </nav>
                </div>
            </div>

            <!-- Side widgets -->
            <div class="col-lg-4">
                <!-- Search widget -->
                <div class="card mb-4 shadow-lg rounded-3 border-0">
                    <div class="card-header text-center">Search</div>
                    <div class="card-body">
                        <form method="GET" action="{{ route('search') }}">
                            <div class="input-group">
                                <input class="form-control" type="text" name="query" placeholder="Search..." aria-label="Search" aria-describedby="button-search" />
                                <button class="btn btn-outline-primary" id="button-search" type="submit">Go!</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Random Quote Widget -->
                <div class="card mb-4 shadow-lg rounded-3 border-0">
                    <div class="card-header text-center">Random Quote</div>
                    <div class="card-body text-center">
                        <p id="quote-text" class="mb-4">Loading quote...</p>
                        <p id="quote-author"></p>
                        <button id="new-quote-btn" class="btn btn-outline-primary rounded-pill">Get New Quote</button>
                    </div>
                </div>
                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                <script>
                    $(document).ready(function() {
                        // Function to fetch a random quote
                        function fetchRandomQuote() {
                            $.ajax({
                                url: '/api/random-quote', // The API endpoint
                                type: 'GET',
                                success: function(response) {
                                    if (response && !response.error) {
                                        // Display the quote and author
                                        $('#quote-text').text('"' + response[0].q + '"');
                                        $('#quote-author').text('- ' + response[0].a);
                                    } else {
                                        $('#quote-text').text('Sorry, we could not load a quote.');
                                        $('#quote-author').text('');
                                    }
                                },
                                error: function() {
                                    $('#quote-text').text('Sorry, we could not load a quote.');
                                    $('#quote-author').text('');
                                }
                            });
                        }
                
                        fetchRandomQuote();
                
                        $('#new-quote-btn').on('click', function() {
                            fetchRandomQuote();
                        });
                    });
                </script>
                <!-- Add Document or Book widget -->
                <div class="card mb-4 shadow-lg rounded-3 border-0">
                    <div class="card-header text-center">Add Document or Book</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('store.item') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" class="form-control" id="title" name="title" required>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="cover" class="form-label">Upload Cover</label>
                                <input type="file" class="form-control" id="cover" name="cover" accept=".png,.jpeg,.jpg" required>
                            </div>
                            <div class="mb-3">
                                <label for="file" class="form-label">Upload Document/Book</label>
                                <input type="file" class="form-control" id="file" name="file" accept=".pdf,.doc,.docx,.epub" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100 rounded-pill">Add Item</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- jQuery and AJAX Script -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            const items = @json($items); // Pass the items collection to JavaScript
            const itemsPerPage = 4; // Number of items per page
            const paginatedItemsContainer = $('#paginated-items');
            const paginationControls = $('#pagination-controls');

            function renderItems(itemsToShow) {
                paginatedItemsContainer.empty(); // Clear current items
                itemsToShow.forEach(item => {
                    const itemHtml = `
                        <div class="col-lg-6 mb-4">
                            <div class="card h-100 shadow-lg rounded-3 border-0 overflow-hidden">
                                <a href="#!">
                                    <img class="card-img-top" src="${item.cover_path}" alt="${item.title}" />
                                </a>
                                <div class="card-body">
                                    <div class="small text-muted">${new Date(item.created_at).toLocaleDateString()}</div>
                                    <h2 class="card-title h4">${item.title}</h2>
                                    <p class="card-text">${item.description.substring(0, 150)}...</p>
                                    <a class="btn btn-outline-primary rounded-pill" href="/items/${item.id}">Read More →</a>
                                </div>
                            </div>
                        </div>
                    `;
                    paginatedItemsContainer.append(itemHtml);
                });
            }

            function renderPaginationControls(totalItems) {
                paginationControls.empty(); // Clear existing controls
                const totalPages = Math.ceil(totalItems / itemsPerPage);

                for (let i = 1; i <= totalPages; i++) {
                    const pageButton = `<li class="page-item"><a class="page-link" href="#" data-page="${i}">${i}</a></li>`;
                    paginationControls.append(pageButton);
                }
            }

            function paginate(page) {
                const startIndex = (page - 1) * itemsPerPage;
                const endIndex = startIndex + itemsPerPage;
                renderItems(items.slice(startIndex, endIndex));
            }

            // Initialize pagination
            renderPaginationControls(items.length);
            paginate(1);

            // Handle page click
            paginationControls.on('click', '.page-link', function(e) {
                e.preventDefault();
                const page = $(this).data('page');
                paginate(page);
                $('.page-item').removeClass('active'); // Remove active class
                $(this).parent().addClass('active'); // Highlight current page
            });

            // Mark the first page as active
            paginationControls.find('li:first-child').addClass('active');
        });
    </script>
</section>
@endsection
