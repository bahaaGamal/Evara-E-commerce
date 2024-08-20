@extends('layout.app')

@section('title') Evara Dashboard @endsection

@section('content')

    <section class="content-main">
        <div class="content-header">
            <h1>Coupons</h1>
            <a href="{{ route('coupons.create') }}" class="btn btn-primary">Create Coupon</a>
        </div>
        <table class="table mt-3">
            <thead>
                <tr>
                    <th>Code</th>
                    <th>Discount Type</th>
                    <th>Discount Value</th>
                    <th>Usage Limit</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($coupons as $coupon)
                    <tr>
                        <td>{{ $coupon->code }}</td>
                        <td>{{ ucfirst($coupon->discount_type) }}</td>
                        <td>{{ $coupon->discount_value }}</td>
                        <td>{{ $coupon->usage_limit }}</td>
                        <td>{{date('d/m/Y', strtotime($coupon->start_date))}}</td>
                        <td>{{date('d/m/Y', strtotime($coupon->end_date))}}</td>
                        <td>
                            <a href="{{ route('coupons.edit', $coupon) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('coupons.destroy', $coupon) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>

@endsection
