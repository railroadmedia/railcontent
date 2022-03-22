@include('bladesora::members.navigation.subnav', [
    "themeColor" => 'singeo',
    "subSections" => [
        [
            'title' => 'Foundations',
            'icon' => 'icon-learning-paths',
            'url' => url()->route('members.learning-paths.show', ['foundations-2019', 215952]),
            'active' => Route::currentRouteNamed('members.learning-paths.index') || Route::currentRouteNamed('members.learning-paths.show') || Route::currentRouteNamed('members.learning-paths.units.show') || Route::currentRouteNamed('members.learning-paths.units.lessons.show')
        ],
        [
            'title' => 'Courses',
            'icon' => 'icon-courses',
            'url' => url()->route('members.catalogues.show', ['contentType' => 'courses']),
            'active' => Route::currentRouteNamed('members.catalogues.show') && request()->route()->parameter('contentType') === 'courses'
        ],
        [
            'title' => 'Songs',
            'icon' => 'icon-songs',
            'url' => url()->route('members.catalogues.show', ['contentType' => 'songs']),
            'active' => Route::currentRouteNamed('members.catalogues.show') && request()->route()->parameter('contentType') === 'songs'
        ],
        [
            'title' => 'Student Reviews',
            'icon' => 'icon-student-focus',
            'url' => url()->route('members.catalogues.show', ['lessonType' => 'student-reviews']),
            'active' => stripos(url()->current(), 'student-reviews') !== false,
        ],
        [
            'title' => 'Live',
            'icon' => 'icon-live',
            'url' => url()->route('members.live.show'),
            'active' => Route::currentRouteNamed('members.live.show')
        ],
        [
            'title' => 'Chords & Scales',
            'icon' => 'icon-chords-scales-icon',
            'url' => url()->route('support.chords-redirect'),
            'active' => Route::currentRouteNamed('support.chords-redirect')
        ],
    ]
])