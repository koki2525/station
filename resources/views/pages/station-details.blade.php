@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <div class="container mt-4">
                <h1>Stock Levels</h1>

                <br>
                <a href="{{ route('order.create') }}" class="btn btn-primary">Place Order</a>
                <br><br>

                <h1>Tank Capacities</h1>

                <table class="table table-bordered">
                    <thead class="thead-dark">
                    <tr>
                        <th>Product</th>
                        <th>Capacity (litres)</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>ULP93</td>
                        <td>{{ $station->ulp93_capacity }}</td>
                    </tr>
                    <tr>
                        <td>ULP95</td>
                        <td>{{ $station->ulp95_capacity }}</td>
                    </tr>
                    <tr>
                        <td>Diesel</td>
                        <td>{{ $station->diesel_capacity }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
