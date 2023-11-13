@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <h1>Petrol Station</h1>
                <p>Fuel Order Planner</p>

            <a href="{{ route('order.create') }}" class="btn btn-primary">Place Order</a>
            <br><br>

                <h2>Stock, Capacity, and Sales Comparison</h2>

                <div class="container">
                    <canvas id="myChart" width="400" height="200"></canvas>
                </div>
                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                <script>
                    // Your Chart.js configuration here...
                    var ctx = document.getElementById('myChart').getContext('2d');
                    var myChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: ['ULP93', 'ULP95', 'Diesel'],
                            datasets: [
                                {
                                    label: 'Capacity',
                                    data: {!! json_encode($capacities) !!},
                                    backgroundColor: ['rgba(255, 99, 132, 0.2)', 'rgba(0, 128, 0, 0.2)', 'rgba(0, 0, 255, 0.2)'],
                                    borderColor: ['rgba(255, 99, 132, 1)', 'rgba(0, 128, 0, 1)', 'rgba(0, 0, 255, 1)'],
                                    borderWidth: 1,
                                    barPercentage: 0.4,
                                    categoryPercentage: 0.5
                                },
                                {
                                    label: 'Stock',
                                    data: {!! json_encode($stocks) !!},
                                    backgroundColor: ['rgba(255, 99, 132, 0.6)', 'rgba(0, 128, 0, 0.6)', 'rgba(0, 0, 255, 0.6)'],
                                    borderColor: ['rgba(255, 99, 132, 1)', 'rgba(0, 128, 0, 1)', 'rgba(0, 0, 255, 1)'],
                                    borderWidth: 1,
                                    barPercentage: 0.4,
                                    categoryPercentage: 0.5
                                },
                                {
                                    label: 'Sales',
                                    data: {!! json_encode($sales) !!},
                                    backgroundColor: ['rgba(255, 206, 86, 0.6)', 'rgba(75, 192, 192, 0.6)', 'rgba(153, 102, 255, 0.6)'],
                                    borderColor: ['rgba(255, 206, 86, 1)', 'rgba(75, 192, 192, 1)', 'rgba(153, 102, 255, 1)'],
                                    borderWidth: 1,
                                    barPercentage: 0.4,
                                    categoryPercentage: 0.5
                                }
                            ]
                        },
                        options: {
                            scales: {
                                x: {
                                    stacked: false
                                },
                                y: {
                                    beginAtZero: true
                                }
                            },
                            plugins: {
                                legend: {
                                    display: false
                                }
                            }
                        }
                    });
                </script>
        </div>
    </div>
@endsection
