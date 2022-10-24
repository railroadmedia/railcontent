@extends('drumeo.sales.trials.trial-selection.trial-selection-layout', [
"weekly" => true
])
@section('month-url')
    href="{{ URL::Route('shopping-cart.to-cart.api') }}?products[DLM-Trial]=1,month,1&locked=true"
@endsection

@section('annual-url')
    href="{{ URL::Route('shopping-cart.to-cart.api') }}?products[DLM-Trial-Annual-7-Day]=1&locked=true"
@endsection
