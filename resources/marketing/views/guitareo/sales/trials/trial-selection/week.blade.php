@extends('guitareo.sales.trials.trial-selection.trial-selection-layout', [
"weekly" => true
])
@section('month-url')
    href="/ecommerce/add-to-cart?products[GUITAREO-7-DAY-TRIAL-ONE-TIME]=1&redirect=/order&locked=true"
@endsection

@section('annual-url')
    href="/ecommerce/add-to-cart?products[guitareo-annual-recurring-7-day-trial-membership]=1&redirect=/order&locked=true&promo-code=annual-trial"
@endsection
