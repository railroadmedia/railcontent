@extends('drumeo.lead-gen.faster.signup-layout2')

@php
    $formId = "Drumeo - Engagement - Trigger - FWTGF - Web Form";
    $formName = "Fastest Way To Get Faster";
@endphp

@section('form1')
    @include("drumeo.lead-gen.partials.sign-up-form-tw", [
            "submitArrows" => true,
            "formId" => $formId,
            "formName" => $formName,
        ])
@stop

@section('form2')
    @include("drumeo.lead-gen.partials.sign-up-form-tw", [
            "stacked" => true,
            "formId" => $formId,
            "formName" => $formName,
        ])
@stop
