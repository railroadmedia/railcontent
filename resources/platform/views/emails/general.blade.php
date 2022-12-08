@extends('emails.layout')

@section('page-body')
    <div style="">
        <?php dd($input);?>
        @if(!empty($input['user']['display_name']) && ($input['user']['display_name'] !== $input['user']['email']))
            <p>{{$input['user']['display_name']}} ({{$input['user']['email']}}) has sent the following message:</p>
        @else
            <p>{{$input['user']['email']}} has sent the following message:</p>
        @endif
        <p>{{$input['message']}}</p>
    </div>
@stop
