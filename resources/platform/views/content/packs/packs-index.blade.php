@extends('partials.layout', ['trackingSectionName' => 'packs'])

@section('meta')
    <title>{{ ucfirst($brand) }} Packs | Musora</title>
@endsection

@section('content')
    <pack-index></pack-index>
@endsection
