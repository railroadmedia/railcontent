@extends('guitareo.lead-gen.acoustic-guitar-jumpstart.lesson-page-layout')

@php
    $title = 'What To Do Next';
    $video = '//player.vimeo.com/video/299280602';
    $previous = '/acoustic-guitar-jumpstart/course-index/7';
    $resources = '
        <div class="flex w-full">
            <div class="px-3 md:px-4 w-1/2">
                <a href="/trial" target="_blank" class="download-button outline big">Learn More About Guitareo</a>
            </div>
            <div class="px-3 md:px-4 w-1/2">
                <a href="{{ url()->route(\'shopping-cart.add-to-cart\', [
                    \'products\' => [\'GUITAREO-7-DAY-TRIAL-ONE-TIME\' => 1],
                    \'redirect\' => \'/order\', \'locked\' => \'true\']) }}" target="_blank" class="download-button big">
                    Start A Free Guitareo Trial
                </a>
            </div>
        </div>
    '
@endphp