@extends('emails.layout')

@section('page-body')
<style>
    h3{font-size:1.3em}
</style>
<div>
    @php
        // check if this is an associate array, or just sequential
        $isAssociative = array_keys($input) !== range(0, count($input) - 1);
    @endphp
    @foreach($input as $key => $entry)
        @if($isAssociative)
            <h3>{{ $key }}</h3>
        @endif
        @foreach($entry as $entryKey => $entryValue)
            <p>{{ $entryKey }}:</p>
            <pre> {!! $entryValue !!}</pre>
        @endforeach
        <br>
    @endforeach
</div>
@stop
