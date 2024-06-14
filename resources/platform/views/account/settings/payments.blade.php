@extends('partials.layout')

@section('meta')
    <title>Payments | Musora</title>
@endsection

@section('content')
    {{-- Payments Page Component --}}
    <payments
        :shopify-orders="{{ json_encode($shopifyOrders) }}"
    ></payments>
@endsection