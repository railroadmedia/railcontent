@extends('partials.layout')

@section('meta')
    <title> {{ ucfirst($brand) }} Artists | Musora</title>
@endsection

@section('content')
    <page-loader page="artists">
        <template #loading>
            <artists-skeleton></artists-skeleton>
        </template>
        <template #page="{ pageData }">
            <artists :artists="pageData"></artists>
        </template>
    </page-loader>
@endsection
