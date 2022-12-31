@extends('drumeo.sales.trials.trial-selection.trial-selection-layout', [
"weekly" => true
])
@section('month-url')
    href="/ecommerce/add-to-cart?products[DLM-Trial]=1,month,1&locked=true"
@endsection

@section('annual-url')
    href="/ecommerce/add-to-cart?products[DLM-Trial-Annual-7-Day]=1&locked=true"
@endsection
