@php
    //Test Data
    $isSubscriber = true;
    $page = Request::segment(1);
    $brand = request()->get('brand');
    //My Stats Data
    $nextLearningPathProgressPercent = "0";
    $nextLearningPathLevel = "1.1";
    $userMetrics = "[]";
@endphp

@php
 $currentDate = "2022-04-08 17:59:30";
$calendarId = "IJ142407";
$youtubeId = "8J2qWpQJtuA";
$timeCutoffMinutes = "30";
$eventCoachProfileUrl = "https://www.guitareo.com/members/coaches/carlos-borges";
$coachEvent = "{\"data\":[{\"id\":349060,\"popularity\":0,\"slug\":\"d-addario-question-answer\",\"type\":\"question-and-answer\",\"sort\":0,\"status\":\"scheduled\",\"language\":\"en-US\",\"brand\":\"guitareo\",\"total_xp\":\"150\",\"published_on\":\"2022-04-08 19:00:00\",\"created_on\":\"2022-03-09 07:33:59\",\"archived_on\":null,\"parent_id\":null,\"child_id\":null,\"fields\":[{\"id\":532819,\"content_id\":349060,\"key\":\"show_in_new_feed\",\"value\":\"1\",\"type\":\"boolean\",\"position\":1},{\"id\":532820,\"content_id\":349060,\"key\":\"title\",\"value\":\"Addario Question Answer\",\"type\":\"string\",\"position\":1},{\"id\":532821,\"content_id\":349060,\"key\":\"difficulty\",\"value\":\"All\",\"type\":\"string\",\"position\":1},{\"id\":532822,\"content_id\":349060,\"key\":\"xp\",\"value\":\"150\",\"type\":\"integer\",\"position\":1},{\"id\":532823,\"content_id\":349060,\"key\":\"topic\",\"value\":\"All\",\"type\":\"string\",\"position\":1},{\"id\":532824,\"content_id\":349060,\"key\":\"live_event_start_time\",\"value\":\"2022-04-08 19:00:00\",\"type\":\"datetime\",\"position\":1},{\"id\":532825,\"content_id\":349060,\"key\":\"live_event_end_time\",\"value\":\"2022-04-08 20:00:00\",\"type\":\"datetime\",\"position\":1},{\"id\":534750,\"content_id\":349060,\"key\":\"live_event_youtube_id\",\"value\":\"JHHOBAQxQqs\",\"type\":\"string\",\"position\":1},{\"id\":534221,\"content_id\":349060,\"key\":\"instructor\",\"value\":{\"id\":350036,\"popularity\":0,\"slug\":\"brian-vance\",\"type\":\"instructor\",\"sort\":0,\"status\":\"published\",\"language\":\"en-US\",\"brand\":\"guitareo\",\"total_xp\":\"150\",\"published_on\":\"2022-03-16 08:28:23\",\"created_on\":\"2022-03-16 08:28:24\",\"archived_on\":null,\"parent_id\":null,\"child_id\":null,\"fields\":[{\"id\":534209,\"content_id\":350036,\"key\":\"show_in_new_feed\",\"value\":\"1\",\"type\":\"boolean\",\"position\":1},{\"id\":534210,\"content_id\":350036,\"key\":\"name\",\"value\":\"Brian Vance\",\"type\":\"string\",\"position\":1},{\"id\":534211,\"content_id\":350036,\"key\":\"style\",\"value\":\"Rock\",\"type\":\"string\",\"position\":1},{\"id\":534213,\"content_id\":350036,\"key\":\"bands\",\"value\":\"Los Dos, Jam Sandwich\",\"type\":\"string\",\"position\":1},{\"id\":534217,\"content_id\":350036,\"key\":\"endorsements\",\"value\":\"None\",\"type\":\"string\",\"position\":1},{\"id\":534218,\"content_id\":350036,\"key\":\"focus\",\"value\":\"Addario\",\"type\":\"string\",\"position\":1},{\"id\":534219,\"content_id\":350036,\"key\":\"is_active\",\"value\":\"1\",\"type\":\"boolean\",\"position\":1},{\"id\":534220,\"content_id\":350036,\"key\":\"is_coach\",\"value\":\"1\",\"type\":\"boolean\",\"position\":1},{\"id\":534212,\"content_id\":350036,\"key\":\"style\",\"value\":\"Blues\",\"type\":\"string\",\"position\":2}],\"data\":[{\"id\":220246,\"content_id\":350036,\"key\":\"short_bio\",\"value\":\"&lt;p&gt;Nearly 30 years as a business professional experience in the Musical Instrument Industry, including Gibson USA, Mars Music and D\u2019Addario. Additionally, a seasoned professional musician who cut his teeth in Nashville, TN, as a studio and live guitarist, a published songwriter, and original band leader. Currently resides in New York and leads D\u2019Addario\u2019s Fretted Strings and Accessories division. &lt;\/p&gt;\",\"position\":1},{\"id\":220247,\"content_id\":350036,\"key\":\"long_bio\",\"value\":\"&lt;p&gt;Earned a Bachelor\u2019s degree in Music Business from Belmont University in Nashville and spent 10 years in the record industry before joining Gibson Guitars in 1994 where I was a Product Manager until 1999. Followed by a brief time at Mars Music in Ft. Lauderdale. At the time, Mars was a 2nd largest music retailer in the country. I led the website content development department (gear and artists) until joining D\u2019Addario in 2001 as the Strings Product Manager. Today, I am the Vice President of D\u2019Addario\u2019s Guitar Strings\/Accessories division, responsible for managing all aspects of the brand from product development to global business to P&amp;amp;L. &lt;\/p&gt;&lt;p&gt;&amp;nbsp;&lt;\/p&gt;&lt;p&gt;My music career began seriously in Nashville in the 1980\u2019s where cut my professional teeth for 15 years as a published songwriter with EMI Music \u201996-99 and an experienced session\/live guitarist. Combined I have 35+ years of experience in the Music Business. Today I actively play (around 50 gigs a year) in two gigging groups, one is a Classic\/Modern Rock acoustic duo, the other a modern \u201cjam\u201d band influenced by bands as diverse as the Allman Brothers, Phish and Frank Zappa.&lt;\/p&gt;\",\"position\":1},{\"id\":220248,\"content_id\":350036,\"key\":\"head_shot_picture_url\",\"value\":\"https:\/\/d1923uyy6spedc.cloudfront.net\/brian vance 4-1647420125.png\",\"position\":1},{\"id\":220249,\"content_id\":350036,\"key\":\"coach_featured_image\",\"value\":\"https:\/\/d1923uyy6spedc.cloudfront.net\/brian vance 2-1647419931.png\",\"position\":1},{\"id\":220250,\"content_id\":350036,\"key\":\"coach_top_banner_image\",\"value\":\"https:\/\/d1923uyy6spedc.cloudfront.net\/brian vance 2-1647419957.png\",\"position\":1},{\"id\":220251,\"content_id\":350036,\"key\":\"coach_bottom_banner_image\",\"value\":\"https:\/\/d1923uyy6spedc.cloudfront.net\/brian vance 2-1647419977.png\",\"position\":1},{\"id\":220252,\"content_id\":350036,\"key\":\"coach_card_image\",\"value\":\"https:\/\/d1923uyy6spedc.cloudfront.net\/brian vance 3-1647420033.png\",\"position\":1},{\"id\":220372,\"content_id\":350036,\"key\":\"focus_text\",\"value\":\"Gear Tone\",\"position\":1}],\"permissions\":[]},\"type\":\"content\",\"position\":1}],\"data\":[{\"id\":220446,\"content_id\":349060,\"key\":\"original_thumbnail_url\",\"value\":\"https:\/\/d1923uyy6spedc.cloudfront.net\/qa-apr8th-2022-1-1648227121.jpg\",\"position\":1},{\"id\":220447,\"content_id\":349060,\"key\":\"thumbnail_url\",\"value\":\"https:\/\/d1923uyy6spedc.cloudfront.net\/qa-apr8th-2022-1-1648227124.jpg\",\"position\":1},{\"id\":219620,\"content_id\":349060,\"key\":\"description\",\"value\":\"&lt;p&gt;Join Brian from Addario live, ask all of your guitar-related questions and chat with fellow Guitareo students!&lt;\/p&gt;\",\"position\":1}],\"permissions\":[{\"id\":52,\"content_id\":349060,\"content_type\":null,\"permission_id\":52,\"brand\":\"guitareo\",\"name\":\"Guitareo Membership\"}],\"user_progress\":{\"483949\":[]},\"completed\":false,\"started\":false,\"progress_percent\":0,\"live_event_start_time\":\"2022-04-08 19:00:00\",\"live_event_end_time\":\"2022-04-08 20:00:00\",\"url\":\"https:\/\/www.guitareo.com\/members\/question-and-answer\/349060\",\"live_event_start_time_in_timezone\":\"2022-04-08 12:00:00\",\"live_event_end_time_in_timezone\":\"2022-04-08 13:00:00\",\"published_on_in_timezone\":\"2022-04-08 12:00:00\",\"like_count\":0,\"instructors\":[\"Brian Vance\"],\"coaches\":[{\"id\":350036,\"popularity\":0,\"slug\":\"brian-vance\",\"type\":\"instructor\",\"sort\":0,\"status\":\"published\",\"language\":\"en-US\",\"brand\":\"guitareo\",\"total_xp\":\"150\",\"published_on\":\"2022-03-16 08:28:23\",\"created_on\":\"2022-03-16 08:28:24\",\"archived_on\":null,\"parent_id\":null,\"child_id\":null,\"fields\":[{\"id\":534209,\"content_id\":350036,\"key\":\"show_in_new_feed\",\"value\":\"1\",\"type\":\"boolean\",\"position\":1},{\"id\":534210,\"content_id\":350036,\"key\":\"name\",\"value\":\"Brian Vance\",\"type\":\"string\",\"position\":1},{\"id\":534211,\"content_id\":350036,\"key\":\"style\",\"value\":\"Rock\",\"type\":\"string\",\"position\":1},{\"id\":534213,\"content_id\":350036,\"key\":\"bands\",\"value\":\"Los Dos, Jam Sandwich\",\"type\":\"string\",\"position\":1},{\"id\":534217,\"content_id\":350036,\"key\":\"endorsements\",\"value\":\"None\",\"type\":\"string\",\"position\":1},{\"id\":534218,\"content_id\":350036,\"key\":\"focus\",\"value\":\"Addario\",\"type\":\"string\",\"position\":1},{\"id\":534219,\"content_id\":350036,\"key\":\"is_active\",\"value\":\"1\",\"type\":\"boolean\",\"position\":1},{\"id\":534220,\"content_id\":350036,\"key\":\"is_coach\",\"value\":\"1\",\"type\":\"boolean\",\"position\":1},{\"id\":534212,\"content_id\":350036,\"key\":\"style\",\"value\":\"Blues\",\"type\":\"string\",\"position\":2}],\"data\":[{\"id\":220246,\"content_id\":350036,\"key\":\"short_bio\",\"value\":\"&lt;p&gt;Nearly 30 years as a business professional experience in the Musical Instrument Industry, including Gibson USA, Mars Music and D\u2019Addario. Additionally, a seasoned professional musician who cut his teeth in Nashville, TN, as a studio and live guitarist, a published songwriter, and original band leader. Currently resides in New York and leads D\u2019Addario\u2019s Fretted Strings and Accessories division. &lt;\/p&gt;\",\"position\":1},{\"id\":220247,\"content_id\":350036,\"key\":\"long_bio\",\"value\":\"&lt;p&gt;Earned a Bachelor\u2019s degree in Music Business from Belmont University in Nashville and spent 10 years in the record industry before joining Gibson Guitars in 1994 where I was a Product Manager until 1999. Followed by a brief time at Mars Music in Ft. Lauderdale. At the time, Mars was a 2nd largest music retailer in the country. I led the website content development department (gear and artists) until joining D\u2019Addario in 2001 as the Strings Product Manager. Today, I am the Vice President of D\u2019Addario\u2019s Guitar Strings\/Accessories division, responsible for managing all aspects of the brand from product development to global business to P&amp;amp;L. &lt;\/p&gt;&lt;p&gt;&amp;nbsp;&lt;\/p&gt;&lt;p&gt;My music career began seriously in Nashville in the 1980\u2019s where cut my professional teeth for 15 years as a published songwriter with EMI Music \u201996-99 and an experienced session\/live guitarist. Combined I have 35+ years of experience in the Music Business. Today I actively play (around 50 gigs a year) in two gigging groups, one is a Classic\/Modern Rock acoustic duo, the other a modern \u201cjam\u201d band influenced by bands as diverse as the Allman Brothers, Phish and Frank Zappa.&lt;\/p&gt;\",\"position\":1},{\"id\":220248,\"content_id\":350036,\"key\":\"head_shot_picture_url\",\"value\":\"https:\/\/d1923uyy6spedc.cloudfront.net\/brian vance 4-1647420125.png\",\"position\":1},{\"id\":220249,\"content_id\":350036,\"key\":\"coach_featured_image\",\"value\":\"https:\/\/d1923uyy6spedc.cloudfront.net\/brian vance 2-1647419931.png\",\"position\":1},{\"id\":220250,\"content_id\":350036,\"key\":\"coach_top_banner_image\",\"value\":\"https:\/\/d1923uyy6spedc.cloudfront.net\/brian vance 2-1647419957.png\",\"position\":1},{\"id\":220251,\"content_id\":350036,\"key\":\"coach_bottom_banner_image\",\"value\":\"https:\/\/d1923uyy6spedc.cloudfront.net\/brian vance 2-1647419977.png\",\"position\":1},{\"id\":220252,\"content_id\":350036,\"key\":\"coach_card_image\",\"value\":\"https:\/\/d1923uyy6spedc.cloudfront.net\/brian vance 3-1647420033.png\",\"position\":1},{\"id\":220372,\"content_id\":350036,\"key\":\"focus_text\",\"value\":\"Gear Tone\",\"position\":1}],\"permissions\":[],\"current_user_is_subscribed\":false,\"coach_profile_image\":\"https:\/\/d1923uyy6spedc.cloudfront.net\/brian vance 4-1647420125.png\",\"name\":\"Brian Vance\"}]}],\"meta\":{\"totalResults\":1,\"page\":1,\"limit\":10,\"filterOptions\":[]}}";
@endphp

@extends('partials.layout')

@section('meta')
    <title>Home | Musora</title>
@endsection

@section('content')

    <page-container>

        {{-- v-cloak: Wait Until Page Container has loaded --}}
        <div v-cloak>

            @if ($isSubscriber)

                <div class="tw-container tw-mx-auto tw-px-4 dark:tw-text-white">

                    {{-- Carousel --}}
                    <header-carousel></header-carousel>
                    
                    <!-- Home Card Links -->
                    <home-card-links brand="{{ $brand }}"></home-card-links>
                    
                    {{-- Continue Section --}}
                    <catalog-section
                        title="Continue"
                        type="video"
                        isVisible=""
                        :data="[]"
                    ></catalog-section>

                    {{-- New Section --}}
                    <catalog-section
                        title="New"
                        type="video"
                        isVisible=""
                        :data="[]"
                    ></catalog-section>

                    {{-- Popular Conversations --}}
                    <catalog-section
                        title="Popular Conversations"
                        type="forum"
                        brand="{{ $brand }}"
                        isVisible=""
                        :data="[]"
                    ></catalog-section>

                    {{-- From Subscribed Coaches --}}
                    <catalog-section
                        title="From Subscribed Coaches"
                        type="video"
                        isVisible=""
                        :data="[]"
                    ></catalog-section>

                    {{-- Subscribed Coaches --}}
                    <catalog-section
                        title="Subscribed Coaches"
                        type="coach"
                        isVisible=""
                        :data="[]"
                    ></catalog-section>

                    {{-- My Playlists --}}
                    <catalog-section
                        title="My Playlists"
                        type="playlist"
                        isVisible=""
                        :data="[]"
                    ></catalog-section>

                    {{-- Live Banner --}}
                    <coach-event 
                        brand="{{ $brand }}" 
                        :preloaded-content='{{ $coachEvent }}'
                        current-date-string="{{ $currentDate }}" 
                        subscription-calendar-id="{{ $calendarId }}"
                        youtube-event-id="{{ $youtubeId }}" 
                        :time-cutoff-minutes="{{ $timeCutoffMinutes }}"
                        event-coach-profile-url="{{ $eventCoachProfileUrl }}"
                    ></coach-event>

                    {{-- Upcoming Events --}}
                    <catalog-section
                        title="Upcoming Events"
                        type="video"
                        isVisible=""
                        :data="[]"
                    ></catalog-section>

                    {{-- My Stats --}}
                    <stats-section
                        brand="{{ $brand }}"
                        :next-learning-path-progress-percent="{{ $nextLearningPathProgressPercent }}"
                        next-learning-path-level="{{ $nextLearningPathLevel }}"
                        :userMetrics="{{ $userMetrics }}"
                    ></stats-section>
                </div>

            @endif
            
        </div>
        
    </page-container>
@endsection



