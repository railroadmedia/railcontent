<div class="flex flex-column">

    {{-- Courses --}}
    @if(!empty($lessonContent['stbs']) && $lessonContent['type'] == 'course-part')
        <div class="columns sbt-container no-padding">
            @foreach($lessonContent['stbs'] as $sbtExerciseNumber => $bpms)
                <div class="flex flex-row sbt-row ">
                    <div class="flex flex-column">
                        <div class="flex flex-row pa">
                            <h3 class="title dark:tw-text-white">Exercise #{{ $sbtExerciseNumber }}</h3>
                        </div>
                        <div class="flex flex-row flex-wrap">
                            <div class="flex flex-column align-center xs-12 lg-3 sbt-buttons pa">
                                @foreach ($bpms as $bpm => $data)
                                    <button class="btn play-sbt mb-1"
                                            data-exercise="{{ $sbtExerciseNumber }}"
                                            data-video-id="{{ 'sbt' . $sbtExerciseNumber . $bpm }}">
                                    <span class="start bg-drumeo text-white short">
                                        @if(preg_match('#[a-zA-Z]#',$bpm))
                                            {{ $bpm }}
                                        @else
                                            {{ $bpm }}
                                            BPM
                                        @endif
                                    </span>

                                        <span class="stop bg-drumeo text-white short">
                                            Stop
                                        </span>
                                    </button>
                                @endforeach
                            </div>
                            <div class="flex flex-column xs-12 lg-9 sbt-sheets pa">
                                <img class="sbt-image tw-rounded-sm"
                                     src="{{ reset($bpms)['image_url'] }}"
                                     style="object-fit:contain;"
                                     data-exercise="{{ $sbtExerciseNumber }}"/>
                                @foreach ($bpms as $bpm => $data)
                                    <video id="{{ 'sbt' . $sbtExerciseNumber . $bpm }}"
                                           class="slow-video sbt-video hide"
                                           data-video-id="{{ 'sbt' . $sbtExerciseNumber . $bpm }}"
                                           playsinline>
                                        <source data-lazy-load-source="{{ $data['video_url'] }}"
                                                type="video/mp4">
                                    </video>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    @if(!empty($lessonContent['stbs']) &&
    !empty($pack) &&
    $pack->fetch('fields.title') != 'Bass Drum Secrets' &&
    $pack->fetch('fields.title') != 'Drumming System 2.0')
        @foreach($lessonContent['stbs'] as $sbtExerciseNumber => $bpms)
            <div class="flex flex-row sbt-row">
                <div class="flex flex-column">
                    <div class="flex flex-row pa">
                        <h3 class="title dark:tw-text-white">Exercise #{{ $sbtExerciseNumber }}</h3>
                    </div>
                    <div class="flex flex-row flex-wrap">
                        <div class="flex flex-column align-center xs-12 lg-3 sbt-buttons pa">
                            @foreach ($bpms as $bpm => $data)
                                <button class="btn play-sbt mb-1"
                                        data-exercise="{{ $sbtExerciseNumber }}"
                                        data-video-id="{{ 'sbt' . $sbtExerciseNumber . $bpm }}">
                                    <span class="start bg-drumeo text-white short">
                                        @if(preg_match('#[a-zA-Z]#',$bpm))
                                            {{ $bpm }}
                                        @else
                                            {{ $bpm }}
                                            BPM
                                        @endif
                                    </span>

                                    <span class="stop bg-drumeo text-white short">
                                        Stop
                                    </span>
                                </button>
                            @endforeach
                        </div>
                        <div class="flex flex-column xs-12 lg-9 sbt-sheets pa">
                            <img class="sbt-image tw-rounded-sm"
                                 src="{{ reset($bpms)['image_url'] }}"
                                 data-exercise="{{ $sbtExerciseNumber }}"/>
                            @foreach ($bpms as $bpm => $data)
                                <video id="{{ 'sbt' . $sbtExerciseNumber . $bpm }}"
                                       class="slow-video sbt-video hide"
                                       data-video-id="{{ 'sbt' . $sbtExerciseNumber . $bpm }}"
                                       playsinline>

                                    <source data-lazy-load-source="{{ $data['video_url'] }}"
                                            type="video/mp4">
                                </video>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif

    @if(!empty($lessonContent['bdsStbs']) && !empty($pack) && $pack->fetch('fields.title') == 'Bass Drum Secrets')
        @foreach($lessonContent['bdsStbs'] as $exerciseNumber => $sbtData)
            <div class="flex flex-row sbt-row">
                <div class="flex flex-column">
                    <div class="flex flex-row pa">
                        <h3 class="title dark:tw-text-white">Exercise #{{ $exerciseNumber }}</h3>
                    </div>
                    <div class="flex flex-row flex-wrap">
                        <div class="flex flex-column xs-12 lg-3 sb-buttons pa">
                            @if(!empty($sbtData['fast_mp3_url']))
                                <a class="btn bg-drumeo text-white short mb-1  sheetMusicFast" href="{{ $sbtData['fast_mp3_url'] }}"
                                   target="_blank"
                                   onclick="positionedPopup(this.href,'myWindow','300','100','100','200','yes');return false">Fast
                                    MP3</a>
                            @endif

                            @if(!empty($sbtData['slow_mp3_url']))
                                <a class="btn bg-drumeo text-white short mb-1 sheetMusicSlow" href="{{ $sbtData['slow_mp3_url'] }}"
                                   target="_blank"
                                   onclick="positionedPopup(this.href,'myWindow','300','100','100','200','yes');return false">Slow
                                    MP3</a>
                            @endif
                        </div>
                        <div class="flex flex-column xs-12 lg-9 pa">
                            <img class="sbt-image tw-rounded-sm" src="{{ $sbtData['image_url'] }}"/>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif

    @if(!empty($lessonContent['ds2Stbs']) && !empty($pack) && $pack->fetch('fields.title') == 'Drumming System 2.0')
        @foreach($lessonContent['ds2Stbs'] as $sbtExerciseNumber => $sbtData)
            <div class="flex flex-row sbt-row">
                <div class="flex flex-column">
                    <div class="flex flex-row pa">
                        <h3 class="title dark:tw-text-white">Exercise #{{ $sbtExerciseNumber }}</h3>
                    </div>
                    <div class="flex flex-row flex-wrap">
                        <div class="flex flex-column xs-12 lg-3 sbt-buttons pa">

                            @if(!empty($sbtData['fast_mp3_url']))
                                <a class="btn bg-drumeo text-white short mb-1 sheetMusicFast" href="{{ $sbtData['fast_mp3_url'] }}"
                                   target="_blank"
                                   onclick="positionedPopup(this.href,'myWindow','300','100','100','200','yes');return false">Fast
                                    MP3</a>
                            @endif

                            @if(!empty($sbtData['slow_mp3_url']))
                                <a class="btn bg-drumeo text-white short mb-1 sheetMusicSlow" href="{{ $sbtData['slow_mp3_url'] }}"
                                   target="_blank"
                                   onclick="positionedPopup(this.href,'myWindow','300','100','100','200','yes');return false">Slow
                                    MP3</a>
                            @endif
                        </div>
                        <div class="flex flex-column xs-12 lg-9 sbt-sheets pa">
                            <img class="sbt-image tw-rounded-sm" src="{{ $sbtData['image_url'] }}"/>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div>