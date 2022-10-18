@extends('drumeo.lead-gen.fastest-way-to-get-faster.signup-layout')

@php
    $formId = "Drumeo - Engagement - Trigger - FWTGF - Web Form";
    $formName = "Fastest Way To Get Faster";
@endphp

@section('form1')
    @include("lead-gen.partials.sign-up-form-tw", [
            "submitArrows" => true,
            "formId" => $formId,
            "formName" => $formName,
        ])
@stop

@section('form2')
    @include("lead-gen.partials.sign-up-form-tw", [
            "stacked" => true,
            "formId" => $formId,
            "formName" => $formName,
        ])
@stop
