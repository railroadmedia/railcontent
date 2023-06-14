@include('partials.bladesora.members.navigation.subnav', [
    "themeColor" => $brand,
    "subSections" => [
        [
            'title' => 'Dashboard',
            'icon' => 'fas fa-tachometer',
            'url' => user()->getDashboardUrl(),
            'active' => Route::currentRouteNamed('members.profile.dashboard')
        ],
        [
            'title' => 'Playlists',
            'icon' => 'fas fa-list-ul',
            'url' => url()->route('members.profile.lists'),
            'active' => Route::currentRouteNamed('members.profile.lists')
        ],
        [
            'title' => 'Notifications',
            'icon' => 'fas fa-bell',
            'url' => url()->route('members.profile.notifications'),
            'active' => Route::currentRouteNamed('members.profile.notifications'),
            'badge' => $hasUnreadNotifications
        ],
        [
            'title' => 'Settings',
            'icon' => 'fas fa-cog',
            'url' => url()->route('members.profile.settings'),
            'active' => Route::currentRouteNamed('members.profile.settings.settings') || Route::currentRouteNamed('members.profile.settings')
        ]
    ]
])
