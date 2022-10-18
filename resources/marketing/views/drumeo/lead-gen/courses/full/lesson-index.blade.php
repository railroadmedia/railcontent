@extends('drumeo.lead-gen.lead-gen-layout-tw')

@section('styles')
    <link href="{{ asset('/assets/members-area/css/gulp/lead-gen-course.css') }}" rel="stylesheet">
    @yield('styles')
@stop

@section('content')
    <header class="header catalogue @yield('custom-header')">
        <div class="container mx-auto max-w-6xl" style="background-image:url(@yield('bg-image'));">
            <div class="course-logo" style="position: relative;">
                @yield('logo-text')
            </div>
        </div>
    </header>

    @include('lead-gen.courses.full._catalogues')
@stop
