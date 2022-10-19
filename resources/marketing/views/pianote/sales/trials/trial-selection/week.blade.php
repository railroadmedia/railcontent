@extends('pianote.sales.trials.trial-selection.trial-selection-layout', [
"weekly" => true
])
@section('month-url')
    href="{{ url()->route('shopping-cart.add-to-cart', ['products' => ['PIANOTE-MEMBERSHIP-TRIAL' => 1 ], 'redirect' => '/order', 'locked' => 'true']) }}"
@endsection

@section('annual-url')
    href="{{ url()->route('shopping-cart.add-to-cart', ['products' => ['PIANOTE-MEMBERSHIP-TRIAL-7-DAY-ANNUAL' => 1 ], 'promo-code' => 'annual-trial', 'redirect' => '/order', 'locked' => 'true']) }}"
@endsection
