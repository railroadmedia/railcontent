@extends('drumeo.sales.trials.trial-selection.trial-selection-layout', [
"weekly" => true
])
@section('month-url')
    href="/laravel/public/shopping-cart/api/query?products[DLM-Trial]=1,month,1&locked=true"
@endsection

@section('annual-url')
    href="/laravel/public/shopping-cart/api/query?products[DLM-Trial-Annual-7-Day]=1&locked=true"
@endsection
