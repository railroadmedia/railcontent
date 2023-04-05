@extends('drumeo.lead-gen.faster.signup-layout',[ 'layoutAlt' => true, ])

@php
    $formId = "Drumeo - Engagement - Trigger - FWTGF - Web Form";
    $formName = "Fastest Way To Get Faster";
    $headerImage = "https://dpwjbsxqtam5n.cloudfront.net/lead-gen/fwtgf/neon-hero-header.png";
    $headerImageM = 'https://dpwjbsxqtam5n.cloudfront.net/lead-gen/fwtgf/neon-hero-header-m.jpg';
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
