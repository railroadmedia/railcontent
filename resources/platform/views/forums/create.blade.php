@php
    $bodyClass = ($bodyClass ?? '') . ' sidebar';
@endphp

@extends('partials.layout')

@section('meta')
    <title>Create a Discussion | {{ $brand }}</title>
@endsection

@section('layout-scripts')
<script type="text/javascript">
  var wasSubmitted = false;    
    function checkBeforeSubmit(){
      if(!wasSubmitted) {
        wasSubmitted = true;
        return wasSubmitted;
      }
      return false;
    }    
</script>
@stop()

@section('content')

    <div class="tw-w-full tw-mx-auto 3xl:tw-max-w-screen-3xl 4xl:tw-max-w-screen-4xl tw-px-4 dark:tw-text-white tw-pt-8 tw-pb-14 forum-post">
        @include('partials.bladesora.members.forums.create-thread', [
            "brand" => $brand,
            "userAvatar" => user()->profile_picture_url,
            "forumUrl" => url()->route('forums.show-categories'),
            "formAction" => url()->route('railforums.thread.store'),
            "method" => 'PUT',
            "topicOptions" => $categories
        ])
    </div>

@endsection
