@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Order Petrol from Wholesaler
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#orderModal">
                            Order
                        </button>
                    </div>

                    <div class="card-body">
                        <div class="container mt-4">
                            @if(session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif

                            @if(session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif

                            <form id="orderForm" method="POST" action="{{ route('order.store') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="desiredDeliveryDate">Desired Delivery Date</label>
                                    <input type="date" class="form-control @error('desiredDeliveryDate') is-invalid @enderror" id="desiredDeliveryDate" name="desiredDeliveryDate" required>
                                    @error('desiredDeliveryDate')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="amountULP93">Amount ULP93</label>
                                    <input type="number" class="form-control" id="amountULP93" name="amountULP93" required>
                                </div>
                                <div class="form-group">
                                    <label for="amountULP95">Amount ULP95</label>
                                    <input type="number" class="form-control" id="amountULP95" name="amountULP95" required>
                                </div>
                                <div class="form-group">
                                    <label for="amountDiesel">Amount Diesel</label>
                                    <input type="number" class="form-control" id="amountDiesel" name="amountDiesel" required>
                                </div>
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <button type="submit" class="btn btn-primary">Place Order</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
