@extends('singeo.lead-gen.self-segmentaion.segmentation-layout')

@section('text', 'It helps to make sure you get the BEST singing lessons experience tailored to your needs. And while you’re waiting for your next lesson (or gig), why not check out these lessons to get performance-ready:')

@php
    $thumbs = [
        [
            "link" => "https://www.singeo.com/chorus/are-you-a-good-singer/",
            "img" => "https://img.youtube.com/vi/iEDnz5UIEz4/maxresdefault.jpg",
            "title" => "What The Great Singers Have In Common",
        ],
        [
            "link" => "https://www.singeo.com/chorus/5-goals-for-singers/",
            "img" => "https://img.youtube.com/vi/8OpkTIGKj5E/maxresdefault.jpg",
            "title" => "How To Be A Successful Singer",
        ],
        [
            "link" => "https://www.singeo.com/chorus/the-best-female-vocalists-sheleas-influences/",
            "img" => "https://img.youtube.com/vi/WdKTwf-n2l8/maxresdefault.jpg",
            "title" => "The Best Female Vocalist",
        ],
    ];
@endphp
