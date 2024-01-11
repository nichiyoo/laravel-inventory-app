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
                            Add New Assets
                        </h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="page-body">
            <div class="container-xl">
                <div class="row row-cards">
                    <div class="col-12">
                        <form action="{{ route('assets.store') }}" method="POST" class="card">
                            @csrf
                            @method('POST')
                            <div class="card-header">
                                <h4 class="card-title">Form</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="mb-3 row">
                                            <label class="col-3 col-form-label required">Asset Name</label>
                                            <div class="col">
                                                <input id="name" name="name" type="text"
                                                    class="form-control @error('name') is-invalid @enderror"
                                                    autocomplete="off" value="{{ old('name') }}" required autofocus
                                                    aria-describedby="nameHelp" placeholder="Asset Name" />
                                                <small class="form-hint">
                                                    Complete name of the asset as it appears on the invoice.
                                                </small>
                                                @error('name')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label class="col-3 col-form-label required">Asset Description</label>
                                            <div class="col">
                                                <textarea id="description" name="description" type="text"
                                                    class="form-control @error('description') is-invalid @enderror" autocomplete="off"
                                                    aria-describedby="descriptionHelp" placeholder="Asset Description" autofocus rows="5" required>{{ old('description') }}</textarea>
                                                <small class="form-hint">
                                                    Describe the asset in detail, make it as descriptive as possible.
                                                </small>
                                                @error('description')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label class="col-3 col-form-label required">Asset Price</label>
                                            <div class="col">
                                                <input id="price" name="price" type="number"
                                                    class="form-control @error('price') is-invalid @enderror"
                                                    autocomplete="off" value="{{ old('price') }}" required autofocus
                                                    aria-describedby="priceHelp" placeholder="Asset Price" />
                                                <small class="form-hint">
                                                    Price of the asset, in Rupiah.
                                                </small>
                                                @error('price')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label class="col-3 col-form-label required">Asset Stock</label>
                                            <div class="col">
                                                <input id="stock" name="stock" type="number"
                                                    class="form-control @error('stock') is-invalid @enderror"
                                                    autocomplete="off" value="{{ old('stock') }}" required autofocus
                                                    aria-describedby="stockHelp" placeholder="Asset Stock" />
                                                <small class="form-hint">
                                                    Stock of the asset, must be greater than 0.
                                                </small>
                                                @error('stock')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label class="col-3 col-form-label required">Asset Category</label>
                                            <div class="col">
                                                <select id="category" name="category"
                                                    class="form-select @error('category') is-invalid @enderror"
                                                    aria-label="Asset Category" required>
                                                    <option value="" selected disabled>Choose one</option>
                                                    <option value="Hardware"
                                                        {{ old('category') == 'Hardware' ? 'selected' : '' }}>Hardware
                                                    </option>
                                                    <option value="Software"
                                                        {{ old('category') == 'Software' ? 'selected' : '' }}>Software
                                                    </option>
                                                    <option value="Peripheral"
                                                        {{ old('category') == 'Peripheral' ? 'selected' : '' }}>Peripheral
                                                    </option>
                                                </select>
                                                <small class="form-hint">
                                                    Category of the asset.
                                                </small>
                                                @error('image')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-end">
                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-primary">
                                        Submit
                                    </button>
                                    <button type="reset" class="btn btn-ghost-secondary">
                                        Reset
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
