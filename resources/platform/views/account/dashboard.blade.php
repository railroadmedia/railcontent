@php
    $showCompleteYourAccountButton = !user()->hasCompletedOnboarding();

    $headerData = [
        'title' => $dashboardUser->display_name,
        'description' => null,
        'heroImg' => $dashboardUser->profile_picture_url,
        'heroImgClasses' => 'user-avatar' . ' ' . (in_array($currentUser['access_level'], ['coach', 'edge', 'lifetime', 'team', 'guitar', 'piano']) ? 'subscriber' : '') . ' ' . $brand . ' ' . $currentUser['access_level'],
        'progress' => null,
        'contentId' => null,
        'infoData' => ['Musora Member Since ' . \Carbon\Carbon::parse($dashboardUser->created_at)->format('Y')],
        'ctas' => null
    ];

    if (!empty($currentUser['avatar'])) {
        $headerData['heroImg'] = $currentUser['avatar'];
    }

    $ctaText = $showCompleteYourAccountButton ? 'Complete Your Account' : 'Update Your Account';
    $ctaUrlSuffix = $showCompleteYourAccountButton ? '&update=2' : '';

    $ctaUrl = "/onboarding?brand={$brand}{$ctaUrlSuffix}";

    $headerData['ctas'][] = [
        'type' => 'PageHeaderPrimaryCta',
        'props' => [
            'text' => $ctaText,
            'url' => $ctaUrl,
            'showAllAlways' => true,
            'isPrimary' => true,
        ]
    ];

    $headerDataJson = json_encode($headerData);
    $headerDataObj = json_decode($headerDataJson);

@endphp

@extends('partials.layout')

@section('meta')
    <title>{{ $dashboardUser->display_name }} | Musora</title>
@endsection

@section('content')
    <dashboard
        :header-data="{{ json_encode($headerDataObj) }}"
        :is-current-users-profile="{{ json_encode($isCurrentUsersProfile) }}"
        :next-learning-path-level="{{ $nextLearningPathLevel }}"
        :next-learning-path-progres-percent="{{ $nextLearningPathProgressPercent }}"
        :user-metrics="{{ json_encode($userMetrics) }}"
        :dashboard-user="{{ json_encode($dashboardUser) }}"
    ></dashboard>
@endsection
