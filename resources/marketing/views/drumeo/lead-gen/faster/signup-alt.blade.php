@extends('drumeo.lead-gen.faster.signup-layout', [ 'layoutAlt' => true ])

@php
    $formId = "Drumeo - Engagement - Trigger - FWTGF - FB Web Form";
    $formName = "Fastest Way To Get Faster - Facebook";
    $headerImage = "https://drumeo-assets.s3.amazonaws.com/lead-gen/fwtgf/neon-hero-header.png";
    $headerImageM = 'https://drumeo-assets.s3.amazonaws.com/lead-gen/fwtgf/neon-hero-header-m.jpg';
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
