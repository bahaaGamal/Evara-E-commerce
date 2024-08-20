@extends('layout.app')

@section('title') Evara Dashboard @endsection

@section('content')

        <section class="content-main">
            <div class="content-header">
                <div>
                <h1 class="content-title card-title">Create Coupon</h1>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-md-9">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form method="POST" action="{{ route('coupons.store') }}" enctype="multipart/form-data">
                                @csrf

                                <div class="mb-4">
                                    <label for="code" class="form-label">Code</label>
                                    <input type="text" placeholder="Enter coupon code" class="form-control" name="code" value="{{ old('code') }}" required />
                                    @error('code')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label class="form-label">Discount Type</label>
                                    <select name="discount_type" class="form-select" required>
                                        <option value="percentage" {{ old('discount_type') == 'percentage' ? 'selected' : '' }}>Percentage</option>
                                        <option value="fixed" {{ old('discount_type') == 'fixed' ? 'selected' : '' }}>Fixed Amount</option>
                                    </select>
                                    @error('discount_type')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="discount_value" class="form-label">Discount Value</label>
                                    <input type="number" placeholder="Enter discount value" class="form-control" name="discount_value" step="0.01" value="{{ old('discount_value') }}" required />
                                    @error('discount_value')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="usage_limit" class="form-label">Usage Limit</label>
                                    <input type="number" placeholder="Enter usage limit" class="form-control" name="usage_limit" value="{{ old('usage_limit') }}" required />
                                    @error('usage_limit')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="start_date" class="form-label">Start Date</label>
                                    <input type="date" class="form-control" name="start_date" value="{{ old('start_date') }}" required />
                                    @error('start_date')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="end_date" class="form-label">End Date</label>
                                    <input type="date" class="form-control" name="end_date" value="{{ old('end_date') }}" required />
                                    @error('end_date')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="d-grid">
                                    <button class="btn btn-primary">Create Coupon</button>
                                </div>
                            </form>
                        </div>
                    </div> <!-- .row // -->
                </div> <!-- card body .// -->
            </div> <!-- card .// -->
        </section> <!-- content-main end// -->

@endsection
