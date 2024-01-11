@extends('layouts.app')

@section('content')
    <div class="page-wrapper">
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <div class="page-pretitle">
                            Assets
                        </div>
                        <h2 class="page-title">
                            {{ request()->query('category') ? request()->query('category') : 'All' }} Assets
                        </h2>
                    </div>

                    <div class="col-auto ms-auto d-flex align-items-center">
                        @php
                            $categories = ['Hardware', 'Software', 'Peripheral'];
                        @endphp
                        <span class="me-3">Filter by Category</span>
                        <select class="form-select w-auto">
                            <option value="All">All</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category }}"
                                    {{ request()->routeIs('assets.index') && request()->query('category') == $category ? 'selected' : '' }}>
                                    {{ $category }}
                                </option>
                            @endforeach
                        </select>

                        <form action="{{ route('assets.export', request()->query()) }}" method="POST">
                            @csrf
                            <input type="hidden" name="category" value="{{ request()->query('category') }}">
                            <button type="submit" class="btn btn-primary ms-3">
                                <i class="fa fa-download"></i>
                                Download
                            </button>
                        </form>
                    </div>

                    @push('scripts')
                        <script>
                            document.addEventListener("DOMContentLoaded", function() {
                                const select = document.querySelector('select');
                                select.addEventListener('change', function() {
                                    window.location.href = `{{ route('assets.index') }}?category=${select.value}`;
                                });
                            });
                        </script>
                    @endpush
                </div>
            </div>
        </div>

        <div class="page-body">
            <div class="container-xl">
                @if (session('success'))
                    <div class="col-12 mb-4">
                        <div class="alert alert-success" role="alert">
                            <div class="d-flex">
                                <div><i class="ti ti-check icon alert-icon"></i></div>
                                <div>
                                    <h4 class="alert-title">Success</h4>
                                    <div class="text-secondary">{{ session('success') }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                @if (session('error'))
                    <div class="col-12 mb-4">
                        <div class="alert alert-danger" role="alert">
                            <div class="d-flex">
                                <div><i class="ti ti-x icon alert-icon"></i></div>
                                <div>
                                    <h4 class="alert-title">Error</h4>
                                    <div class="text-secondary">{{ session('error') }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="col-12 mb-4">
                    <div class="card">
                        <div class="table-responsive">
                            <table class="table table-vcenter table-mobile-md card-table">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Category</th>
                                        <th>Price</th>
                                        <th>Stock</th>
                                        <th>Created At</th>
                                        <th class="w-1">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($assets as $asset)
                                        <tr>
                                            <td data-label="Name" style="min-width: 150px;">
                                                <span>{{ $asset->name }}</span>
                                            </td>
                                            <td data-label="Description" style="min-width: 300px;">
                                                <span>{{ $asset->description }}</span>
                                            </td>
                                            <td data-label="Category" style="min-width: 100px;">
                                                <span class="badge bg-blue text-blue-fg">{{ $asset->category }}</span>
                                            </td>
                                            <td data-label="Price" style="min-width: 150px;">
                                                <span>
                                                    {{ sprintf('Rp. %s', number_format($asset->price, 0, ',', '.')) }}
                                                </span>
                                            </td>
                                            <td data-label="Stock" style="min-width: 100px;">
                                                <span>{{ $asset->stock }}</span>
                                            </td>
                                            <td data-label="Created At" style="min-width: 150px;">
                                                <span>{{ $asset->created_at->diffForHumans() }}</span>
                                            </td>
                                            <td data-label="Action" style="min-width: 150px;">
                                                <div class="btn-list flex-nowrap">
                                                    <a href="{{ route('assets.edit', $asset->id) }}"
                                                        class="btn btn-ghost-primary">
                                                        Edit
                                                    </a>
                                                    <form action="{{ route('assets.destroy', $asset->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-ghost-danger">
                                                            Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-12 mb-4 d-flex justify-content-end">
                    {{ $assets->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
