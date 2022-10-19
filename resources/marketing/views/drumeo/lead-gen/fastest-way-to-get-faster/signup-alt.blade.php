@extends('drumeo.lead-gen.fastest-way-to-get-faster.signup-layout')

@php
    $formId = "Drumeo - Engagement - Trigger - FWTGF - FB Web Form";
    $formName = "Fastest Way To Get Faster - Facebook";
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
            "submitArrows" => true,
            "formId" => $formId,
            "formName" => $formName,
        ])
@stop
