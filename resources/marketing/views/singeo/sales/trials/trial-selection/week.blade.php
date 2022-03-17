@extends('singeo.sales.trials.trial-selection.trial-selection-layout', [
"weekly" => true
])
@section('month-url')
    href="/ecommerce/add-to-cart?products[singeo-monthly-recurring-7-day-trial-membership]=1&redirect=/order&locked=true"
@endsection

@section('annual-url')
    href="/ecommerce/add-to-cart?products[singeo-annual-recurring-7-day-trial-membership]=1&redirect=/order&locked=true&promo-code=annual-trial"
@endsection