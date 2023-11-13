{{-- order/order.blade.php --}}
@extends('layouts.app')  {{-- You might need to adjust this based on your actual layout file --}}

@section('content')
    <div>
        @if($runOutBeforeDelivery)
        <p>Will stock run out before delivery: Yes</p>
        @else
            <p>Will stock run out before delivery: No</p>
        @endif
        <p>Projected Cost: {{ $projectedCost }}</p>
        <p>Projected Stock After Delivery:</p>
        <ul>
            @foreach ($remainingStock as $type => $amount)
                <li>{{ $type }}: {{ $amount }}</li>
            @endforeach
        </ul>
        <p>Projected Total Capital: {{ $projectedTotalCapital }}</p>
        {{-- Add more content as needed --}}
    </div>
@endsection
