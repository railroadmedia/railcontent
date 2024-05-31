@extends('partials.layout')

@section('meta')
    <title>{{ ucfirst($brand) }} Student Focus | Musora</title>
@endsection

@section('content')
    <student-focus
        :lesson-types='@json($lessonTypes)'
    ></student-focus>
@endsection
