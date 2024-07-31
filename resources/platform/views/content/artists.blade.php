@extends('partials.layout')

@section('meta')
    <title> {{ ucfirst($brand) }} Artists | Musora</title>
@endsection

@section('content')
    <page-loader page="artists">
        <template #loading>
        </template>
        <template #page="{ pageData }">
            <artists :artists="pageData"></artists>
        </template>
    </page-loader>

@endsection
