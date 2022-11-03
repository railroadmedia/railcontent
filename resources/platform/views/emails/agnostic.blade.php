@extends('emails.layout')

@section('page-body')
<style>
    h3{font-size:1.3em}
</style>
<div>
    @foreach($input as $key => $value)
        <p>{{ $key }}:</p>
        <pre> {{ $value }}</pre>
        <br>
    @endforeach
</div>
@stop
