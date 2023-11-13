@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card-body">

            <div class="container mt-4">
                <h1>Wholesaler Trucks</h1>

                <br>
                <a href="{{ route('order.create') }}" class="btn btn-primary">Place Order</a>
                <br><br>

                <table class="table table-bordered table-striped">
                    <thead class="thead-dark">
                    <tr>
                        <th>Truck Number</th>
                        @for ($i = 1; $i <= 7; $i++)
                            <th>Comp {{ $i }}</th>
                        @endfor
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($wholesalerTrucks['wholesaler_trailers'] as $truck)
                        <tr>
                            <td>{{ $truck['truck_number'] }}</td>
                            @foreach ($truck['compartments'] as $compartment)
                                <td>
                                    Capacity: {{ $compartment['capacity'] }}<br>
                                    Fuel Type: {{ $compartment['fuel_type'] }}
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
