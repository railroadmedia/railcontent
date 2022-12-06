@extends('drumeo.drumshop.shop-page-layout')

@section('meta')
    @parent
    <title>Drumming System</title>
    <meta name="description" content="The complete Drumming System is the most comprehensive home study course for learning how to play the drums - with 20 DVDs, 21 CDs, and 5 instructional workbooks.">
    <meta property="og:image" content="https://i.vimeocdn.com/video/473146109-6c9a4ad098b7ea25e4a6f4f49f5450e265fce6549387eab7dadb60db5d0f6980-d_720" style="display: none;">
    <meta property="og:description" content="The complete Drumming System is the most comprehensive home study course for learning how to play the drums - with 20 DVDs, 21 CDs, and 5 instructional workbooks.">
    <meta property="og:url" content="https://www.drumeo.com/{{ Request::path() }}">
@stop()

@section('head')
    @parent
    <?php \App\Analytics\Tracker::trackProductImpression('DSYS2-DIGI'); ?>
@stop()

@section('top')
    @include('drumeo.drumshop._partials.slider', [
        "headerText" => "The <strong>ultimate encyclopedia</strong> of video drum lessons",
        "instructorName" => "Mike Michalkow",
        "videoSrc" => "//player.vimeo.com/video/93153615",
        "videoThumb" => "https://s3.amazonaws.com/drumeo-packs/Pack%20Images/Drumming%20System/thumbnail.jpg",
        "packBanner" => "https://s3.amazonaws.com/drumeo-packs/Pack%20Images/Drumming%20System/spread.png"
    ])

    @include('drumeo.drumshop._partials.sidebar', [
        "sku" => "DSYS2-DIGI",
        "instructor" => "Mike Michalkow's",
        "logo" => "https://dpwjbsxqtam5n.cloudfront.net/pack-logos/drumming-system-2-black.png",
        "fullPrice" => Prices::$dsOnlineFull,
        "price" => Prices::$dsOnlineRegular,
        "guaranteeBadge" => true,
        "soldOut" => true
    ])
@endsection

@section('bottom')
    @include('drumeo.drumshop._partials.features', [
        'features' => [
            [
                "icon" => "fa-list-ol",
                "heading" => "Encyclopedia Of Lessons",
                "text" => "The Drumming System includes step-by-step training for all levels, with 20 modules, 100+ songs, and 5 instructional workbooks."
            ],
            [
                "icon" => "fa-music",
                "heading" => "100+ Play-Alongs",
                "text" => "Half the fun of learning the drums is playing with a band, so the Drumming System includes play-alongs for every musical style."
            ],
            [
                "icon" => "fa-certificate",
                "heading" => "100% Guaranteed Results",
                "text" => "We think you’ll love these lessons, and that’s why you can try them risk-free with our 90-day guarantee!"
            ]
        ]
    ])

    @include('drumeo.drumshop._partials.specs',[
        "specsList" => [
            (object)[
            'specIcon' => 'fa-video',
            'specType' => 'Video:',
            'specValue' => '30 hours of video lessons'
            ],
            (object)[
            'specIcon' => 'fa-volume-up',
            'specType' => 'Audio:',
            'specValue' => '100 play-along songs'
            ],
            (object)[
            'specIcon' => 'fa-book',
            'specType' => 'Books:',
            'specValue' => '268 page PDF workbook'
            ],
            (object)[
            'specIcon' => 'fa-wifi',
            'specType' => 'Online:',
            'specValue' => 'Lifetime access to all content'
            ],
            (object)[
            'specIcon' => 'fa-user',
            'specType' => 'Skill:',
            'specValue' => 'From beginner to advanced'
            ]
        ],
        "featuresList" => [
            "The Drumming System includes 20 training modules and is widely considered the Ultimate Encyclopedia of Video Drum Lessons. You can jump around to the topics that interest you the most, including How To Play Drums By Ear, How To Practice Efficiently, Drum Theory & Notation, Hand Technique, Drum Rudiments, Foot Technique, Heavy Rock Lessons, Mixed Rock Lessons, Groove Rock Lessons, Jazz & Latin Lessons, Drum Fills, Dynamic Drumming, How To Build Speed, Drum Setup, Tuning & Gear Tips, Live Gig & Studio Drumming, Drum Soloing, Writing With A Band, and Hand Drumming & Percussion.",
            "You’ll also be able to put all of your lessons into action, with 100 play-along songs."
        ]
    ])

    @include('drumeo.drumshop._partials.instructor',[
        "instructorPhoto" => "https://s3.amazonaws.com/drumeo-packs/Instructors/mike-michalkow.jpg",
        "instructorBio" => "Mike Michalkow has been teaching drums and percussion for more than 20 years, having studied under master drummers Dom Famularo, Jim Chapin, Chuck Silverman, Thomas Lang, John “JR” Robinson, Peter Magadini, and Virgil Donati.\n\nHe has a wealth of experience to draw from having played in various original and cover bands, working on a popular cruise line as the orchestra drummer, and recording with songwriters and bands with styles ranging from prog-rock, latin, jazz, blues, pop, folk, celtic, country, metal, and R&B.\n\nMike’s comprehensive teaching methods have helped thousands of drummers around the world reach their goals, through his best-selling training packs including The Drumming System, Jazz Drumming System, Latin Drumming System, Moeller Method Secrets, and Total Rock Drummer."
    ])

    @include('drumeo.drumshop._partials.dvd-contents',[
        "spread" => "https://s3.amazonaws.com/drumeo-packs/Pack%20Images/Drumming%20System/spread.png",
        "dvdList" => [
        //How to Play Drums by Ear
        (object)[
            "dvdImage" => "https://s3.amazonaws.com/drumeo-packs/Pack+Images/Drumming+System/01.png",
            "dvdTitle" => "How to Play Drums By Ear",
            "dvdDescription" => "This module covers everything you need to start playing the drums for the very first time. No sheet music or theory is required. Everything is taught by ear. Topics in the module include: getting started, drum kit setup, posture, grip, basic foot technique, basic drum beats, basic drum fills, using a metronome, and playing along with a song."
            ],
        //How to Practice Efficiently
        (object)[
            "dvdImage" => "https://s3.amazonaws.com/drumeo-packs/Pack+Images/Drumming+System/02.png",
            "dvdTitle" => "How to Practice Efficiently",
            "dvdDescription" => "Practicing is an essential part of learning to play the drums. And this section is all about providing you with the information you need to create a balanced practice routine. It works hand-in-hand with the Practice Routine Generator (included in the workbooks) and covers topics like: why we practice, practicing tips and tricks, structuring practices, the casual schedule, the motivated schedule, the dedicated schedule, and more."
            ],
        //Drum Theory & Notation
        (object)[
            "dvdImage" => "https://s3.amazonaws.com/drumeo-packs/Pack+Images/Drumming+System/03.png",
            "dvdTitle" => "Drum Theory & Notation",
            "dvdDescription" => "Many drummers are intimidated by the concept of learning to read and write drum notation. This is due to the fact that drum theory is often seen as being very complicated and challenging. In this module, Mike makes learning theory and notation easy by breaking things down into simple steps. You'll learn how to read and write basic drum beats, and then move on to more complicated patterns. It's all designed in a progressive way to make things fun."
            ],
        //Hand Technique
        (object)[
            "dvdImage" => "https://s3.amazonaws.com/drumeo-packs/Pack+Images/Drumming+System/04.png",
            "dvdTitle" => "Hand Technique",
            "dvdDescription" => "Do you want to learn exactly how to hold the drumsticks for maximum speed, power, control, and endurance? In this module, Mike will show you exactly how to get the most out of every single stroke you play. Proper hand technique can completely change the way you play. You'll learn all the variations on matched grip, traditional grip, and finger control technique to ensure your hands don't hold back your drumming potential!"
            ],
        //Drum Rudiments
        (object)[
            "dvdImage" => "https://s3.amazonaws.com/drumeo-packs/Pack+Images/Drumming+System/05.png",
            "dvdTitle" => "Drum Rudiments",
            "dvdDescription" => "The drum rudiments are the building blocks to everything we play on the drums. Think of them as the letters that make up all the words (beats and fills) that we can play on the drums. This module teaches you all forty drum rudiments - and Mike demonstrates how to incorporate the six most popular rudiment patterns within your everyday drumming."
            ],
        //Foot Techniques
        (object)[
            "dvdImage" => "https://s3.amazonaws.com/drumeo-packs/Pack+Images/Drumming+System/06.png",
            "dvdTitle" => "Foot Techniques",
            "dvdDescription" => "Up and coming drummers tend to spend too much time on the hands, and can sometimes ignore the feet. Well, this module covers all the various foot techniques to make sure you get the most from all four limbs. You’ll learn bass drum techniques, independence, double bass drumming, hi-hat foot techniques, hi-hat independence, and more."
            ],
        //Heavy Rock Lessons
        (object)[
            "dvdImage" => "https://s3.amazonaws.com/drumeo-packs/Pack+Images/Drumming+System/07.png",
            "dvdTitle" => "Heavy Rock Lessons",
            "dvdDescription" => "Are you interested in playing heavy rock music? This module includes beginner to advanced grooves from sub-genres including: punk rock, heavy metal, speed metal, hard rock, grunge rock, and progressive rock."
            ],
        //Mixed Rock Lessons
        (object)[
            "dvdImage" => "https://s3.amazonaws.com/drumeo-packs/Pack+Images/Drumming+System/08.png",
            "dvdTitle" => "Mixed Rock Lessons",
            "dvdDescription" => "Interested in some other styles of Rock music? The mixed rock lessons module includes sub-genres like: folk rock, classic rock, country, and odd-time. As with the heavy rock module, these lessons are all step-by-step for beginner to advanced students."
            ],
        //Groove Rock Lessons
        (object)[
            "dvdImage" => "https://s3.amazonaws.com/drumeo-packs/Pack+Images/Drumming+System/09.png",
            "dvdTitle" => "Groove Rock Lessons",
            "dvdDescription" => "Want to learn to play the drums with more groove? This module covers some of the more groovy styles of rock including: blues, funk, reggae, and shuffle beats. Though these lessons are more ideal for intermediate and advanced drummers, they do start with patterns that are easy enough for beginners to learn and master."
            ],
        //Jazz & Latin Lessons
        (object)[
            "dvdImage" => "https://s3.amazonaws.com/drumeo-packs/Pack+Images/Drumming+System/10.png",
            "dvdTitle" => "Jazz & Latin Lessons",
            "dvdDescription" => "Interested in playing more than just rock music? This training module is absolutely jam-packed with lessons on both Jazz and Latin drumming patterns that are sure to take your playing to the next level. You'll learn to play with more groove, independence, and control as you master these fun and unique beats."
            ],
        //Drum Fills
        (object)[
            "dvdImage" => "https://s3.amazonaws.com/drumeo-packs/Pack+Images/Drumming+System/11.png",
            "dvdTitle" => "Drum Fills",
            "dvdDescription" => "Do you want to learn how to play amazing and creative drum fills like some of the drummers you look up to? This module will show you everything you need to know in order to play patterns for all styles of music! Mike starts out by teaching you the basic concepts of creating drum fills, and then shows you specific examples of how he uses fills to transition between beats."
            ],
        //Dynamic Drumming
        (object)[
            "dvdImage" => "https://s3.amazonaws.com/drumeo-packs/Pack+Images/Drumming+System/12.png",
            "dvdTitle" => "Dynamic Drumming",
            "dvdDescription" => "This module is jam packed with valuable tips to help you improve the way you play virtually all the beats you know. You'll learn how to take seemingly ordinary beats and turn them into powerful grooves. Mike covers important topics like: dynamics, ghost notes, accented notes, cross-sticking, open-close hi-hats, and how to modify a beat! These lessons will change the 'feel' of everything you play."
            ],
        //How To Build Speed
        (object)[
            "dvdImage" => "https://s3.amazonaws.com/drumeo-packs/Pack+Images/Drumming+System/13.png",
            "dvdTitle" => "Dynamic Drumming",
            "dvdDescription" => "Mike takes a closer look at hand technique, and shares some insider tips on how to build incredible speed with simple exercises that are proven to work. You'll start on the practice pad, and then take those concepts and implement them around the entire drum set while incorporating the feet!"
            ],
        //Drum Setup, Tuning & Gear Tips
        (object)[
            "dvdImage" => "https://s3.amazonaws.com/drumeo-packs/Pack+Images/Drumming+System/14.png",
            "dvdTitle" => "Drum Setup, Tuning & Gear Tips",
            "dvdDescription" => "Do you ever have questions about how to set up or tune your drums? This module has everything you need to get your kit setup and sounding great!  It covers how to setup 5-piece and 4-piece sets, and tips on expanding your drum set with various add-ons. You'll also get specific tips on how to make your snare drum, bass drum, and toms sounding their best."
            ],
        //Live Gig & Studio Drumming
        (object)[
            "dvdImage" => "https://s3.amazonaws.com/drumeo-packs/Pack+Images/Drumming+System/15.png",
            "dvdTitle" => "Live Gig & Studio Drumming",
            "dvdDescription" => "Do you ever want to be a working drummer? This module is packed with valuable tips for both live and studio playing situations. Mike shares everything he has learned over his 20+ years of drumming! Topics include: how to get gigs, reading drum charts, working with a band, sound-checking tips, and studio drumming tips. These lessons are a must for drummers that want to make the move from student to professional."
            ],
        //Drum Soloing
        (object)[
            "dvdImage" => "https://s3.amazonaws.com/drumeo-packs/Pack+Images/Drumming+System/16.png",
            "dvdTitle" => "Drum Soloing",
            "dvdDescription" => "Have you ever wanted to play an amazing drum solo? Maybe you have watched some of your favorite drummers play, and wondered how they were able to be so creative. In this module you’ll learn how to build a drum solo, soloing with shots, soloing with breaks, soloing over a vamp, and will wrap with Mike showcasing some of his drum solos for inspiration."
            ],
        //Writing With A Band
        (object)[
            "dvdImage" => "https://s3.amazonaws.com/drumeo-packs/Pack+Images/Drumming+System/19.png",
            "dvdTitle" => "Writing With A Band",
            "dvdDescription" => "Have you ever wondered what it takes to create a song? In this module, you'll be able to watch the entire writing process from start to finish, as the band creates and then performs six new tracks. This is a great way to learn how real music is composed, plus get a more intimate understanding of the play-along songs you'll be jamming along to!"
            ],
        //Hand Drumming & Percussion
        (object)[
            "dvdImage" => "https://s3.amazonaws.com/drumeo-packs/Pack+Images/Drumming+System/20.png",
            "dvdTitle" => "Hand Drumming & Percussion",
            "dvdDescription" => "Learning hand drum and percussion instruments can give you more options for creating music in the studio or performing live on stage - and Mike will provide you with useful patterns, techniques, and tips to help you get started with a variety of unique instruments including congas, djembe, cajon, shakers, tambourines, and much more."
            ],
        //Audio Exercises
        (object)[
            "dvdImage" => "https://s3.amazonaws.com/drumeo-packs/Pack+Images/Drumming+System/20.png",
            "dvdTitle" => "Audio Exercises",
            "dvdDescription" => "This includes all of the exercises from the modules so you can practice away from the video lessons. Each exercises has been looped for 2 minutes so you can play-along as much as you want. Repetition is a great way to make sure you get the most out of each exercise, so you can reach your drumming goals!"
            ],
        //Drum Play Alongs
        (object)[
            "dvdImage" => "https://s3.amazonaws.com/drumeo-packs/Pack+Images/Drumming+System/20.png",
            "dvdTitle" => "Drum Play-Alongs",
            "dvdDescription" => "Half the fun of learning the drums is being able to play with a band, so the Drumming System includes more than 100 play-along songs with the drum tracks removed, covering all of the styles of music in the lesson modules. For every song, you'll get two different versions - one with the metronome and another with the metronome removed."
            ],
        //Metronome Collection
        (object)[
            "dvdImage" => "https://s3.amazonaws.com/drumeo-packs/Pack+Images/Drumming+System/20.png",
            "dvdTitle" => "Metronome Collection",
            "dvdDescription" => "This includes simple metronome tracks that you can use as an alternative to buying a metronome. The various tempos include: 50 BPM all the way up to 200 BPM in exactly 5 BPM increments."
            ]
        ],
        "workbookImage" => "https://s3.amazonaws.com/drumeo-packs/Workbooks/drumming-system.jpg",
        "workbookDescription" => "The Drumming System also includes companion workbooks you can use to follow along with the video and audio content. Everything is organized based on the module sections, so you can easily find the accompanying sheet music, exercises, and worksheets that are referenced in the training videos. \n\nThis workbook includes an enhanced version of Mike Michalkow's famous Practice Routine Generator. The biggest addition is a list of direct module references for various sub-categories within the routine generator. This way, you can immediately find relevant lessons!",
        "membersAreaImage" => "https://s3.amazonaws.com/drumeo-packs/Members+Area+Screens/drumming-system.jpg",
        "membersAreaDescription" => "You will get instant-access to all 10 modules, 100 songs, and the workbook through the online members area. You'll be able to stream all the video lessons, download the play-along songs, view or print the included sheet music, and connect with other students in the Drumming System community. It works on PCs, Macs, iPads, iPhones, Android devices, and other mobile computers that have an active Internet connection."
    ])
@endsection
