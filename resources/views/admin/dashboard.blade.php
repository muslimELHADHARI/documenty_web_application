@extends('layout')

@section('title', 'Admin Dashboard')

@section('content')
    <div class="container py-5">
        <!-- Dashboard Title -->
        <div class="row mb-4">
            <div class="col-12 text-center">
                <h1 class="display-4 font-weight-bold">Admin Dashboard</h1>
            </div>
        </div>

        <!-- Dashboard Stats -->
        <div class="row mb-4">
            <!-- Total Items -->
            <div class="col-md-4 mb-3">
                <div class="card shadow-lg rounded-3 border-0">
                    <div class="card-body text-center">
                        <h4 class="card-title">Total Items</h4>
                        <p class="card-text display-3 text-primary">{{ $totalCount }}</p>
                    </div>
                </div>
            </div>

            <!-- Total Categories -->
            <div class="col-md-4 mb-3">
                <div class="card shadow-lg rounded-3 border-0">
                    <div class="card-body text-center">
                        <h4 class="card-title">Categories</h4>
                        <p class="card-text display-3 text-warning">{{ count($categories) }}</p>
                    </div>
                </div>
            </div>

            <!-- Rejected Items (if applicable) -->
            <div class="col-md-4 mb-3">
                <div class="card shadow-lg rounded-3 border-0">
                    <div class="card-body text-center">
                        <h4 class="card-title">Items in Pending Status</h4>
                        <p class="card-text display-3 text-danger">{{ $pendingcount }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Chart & Items Table -->
        <div class="row">
            <!-- Chart -->
            <div class="col-md-6 mb-4">
                <div class="card shadow-lg rounded-3 border-0">
                    <div class="card-body">
                        <h5 class="card-title text-center">Category Distribution</h5>
                        <canvas id="categoryChart" style="max-width: 100%; height: 300px;"></canvas>
                    </div>
                </div>
            </div>

            <!-- Items Table -->
            <div class="col-md-6 mb-4">
                <div class="card shadow-lg rounded-3 border-0">
                    <div class="card-header bg-primary text-white text-center">
                        <strong>Items List</strong>
                    </div>
                    <div class="card-body">
                        <table class="table table-sm table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Created At</th>
                                    <th>Approved</th> <!-- Added column for approval -->
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @auth
                                @if(auth()->user()->is_admin)
                                @foreach ($items as $item)
                                    <tr class="align-middle">
                                        <td class="text-center">{{ $item->id }}</td>
                                        <td>{{ $item->title }}</td>
                                        <td class="text-center">{{ $item->created_at->format('F j, Y') }}</td>
                                        <td class="text-center">
                                            @if ($item->approved)
                                                <span class="badge bg-success" title="This item is approved">
                                                    <i class="fas fa-check-circle"></i> Approved
                                                </span>
                                            @else
                                                <span class="badge bg-warning" title="This item is pending">
                                                    <i class="fas fa-clock"></i> Pending
                                                </span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group" role="group" aria-label="Actions">
                                                @if (!$item->approved)
                                                    <!-- Approve Button -->
                                                    <a href="{{ route('admin.approveItem', $item->id) }}" class="btn btn-outline-success btn-sm" title="Approve this item">
                                                        <i class="fas fa-check-circle"></i> Approve
                                                    </a>
                                                @endif
                                                <!-- Remove Button -->
                                                <a href="{{ route('admin.deleteItem', $item->id) }}" class="btn btn-outline-danger btn-sm ml-2" onclick="return confirm('Are you sure you want to delete this item?')" title="Delete this item">
                                                    <i class="fas fa-trash-alt"></i> Remove
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                @endif
                                @endauth
                            </tbody>
                            
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pagination Links -->
        <div class="d-flex justify-content-center">
            {{ $items->links() }}
        </div>
    </div>

    <!-- Chart.js Script -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var ctx = document.getElementById('categoryChart').getContext('2d');
        var categoryChart = new Chart(ctx, {
            type: 'pie',  // Type of chart: Pie
            data: {
                labels: @json($categories),  // Categories passed from the controller
                datasets: [{
                    data: @json($counts),  // Counts of items for each category
                    backgroundColor: ['#FF5733', '#33FF57', '#3357FF', '#F0E68C', '#FF8C00'],  // Colors for each category
                    borderColor: '#fff',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.label + ': ' + tooltipItem.raw + ' items';
                            }
                        }
                    }
                }
            }
        });
    </script>
@endsection
