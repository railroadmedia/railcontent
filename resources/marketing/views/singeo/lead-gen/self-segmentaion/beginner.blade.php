@extends('singeo.lead-gen.self-segmentaion.segmentation-layout')

@section('text', 'It helps to make sure you get the BEST singing lessons experience tailored to your needs. And while you’re waiting for your next lesson, why not check out these beginner-focused tips:')

@php
    $thumbs = [
        [
            "link" => "https://www.singeo.com/chorus/anyone-can-sing/",
            "img" => "https://img.youtube.com/vi/triTozzgPQU/maxresdefault.jpg",
            "title" => "Anyone Can Sing",
        ],
        [
            "link" => "https://www.singeo.com/chorus/how-to-sing/",
            "img" => "https://img.youtube.com/vi/XgIKv96JXhs/maxresdefault.jpg",
            "title" => "How To Sing - Vocal Lessons For Beginners",
        ],
        [
            "link" => "https://www.singeo.com/chorus/a-beginner-singing-lesson/",
            "img" => "https://img.youtube.com/vi/JzlAjfrgIfQ/maxresdefault.jpg",
            "title" => "Your First Beginner Voice Lesson",
        ],
    ];
@endphp
