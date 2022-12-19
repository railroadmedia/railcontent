@extends('singeo.lead-gen.self-segmentaion.segmentation-layout')

@section('text', 'It helps to make sure you get the BEST singing lessons experience tailored to your needs. And while you’re waiting for your next lesson, why not check out these lessons to improve your technique:')

@php
    $thumbs = [
        [
            "link" => "https://www.singeo.com/chorus/how-to-hit-the-high-notes/",
            "img" => "https://img.youtube.com/vi/YSBL7PKfIoI/maxresdefault.jpg",
            "title" => "How To Hit The High Notes",
        ],
        [
            "link" => "https://www.singeo.com/chorus/increase-your-vocal-range/",
            "img" => "https://img.youtube.com/vi/cCLo_HT-sng/maxresdefault.jpg",
            "title" => "How To Increase Your Vocal Range",
        ],
        [
            "link" => "https://www.singeo.com/chorus/how-to-sing-fast/",
            "img" => "https://img.youtube.com/vi/nukTVN6lo8Q/maxresdefault.jpg",
            "title" => "Vocal Control - Sing Faster & Better",
        ],
    ];
@endphp
