<div class="flex flex-row flex-wrap pv">
    <div class="flex flex-column xs-6 sm-3 text-center user-stats-col">
        <a href="{{ url()->route('members.profile.dashboard', [auth()->id()]) }}"
           class="bg-white pa corners-10 text-black no-decoration relative">
            <div class="flex flex-column bg-singeo square rounded relative stats-dial" dusk="xp-dial">
                <div class="flex flex-column flex-center bg-white rounded stats-content">
                    <h3 class="display">{{ parse_xp_value($completedTypes['xp']) }}</h3>
                    <h3 class="body font-bold dense uppercase">Total</h3>
                </div>
                <div class="flex flex-row bg-white stats-type body uppercase align-center nowrap">
                    <i class="icon-xp mr-1"></i> Experience
                </div>
            </div>
        </a>
    </div>
    <div class="flex flex-column xs-6 sm-3 text-center user-stats-col">
        <a @if(!$isPublic) href="{{ url()->route('members.learning-paths.show', [
            "lpSlug" => 'foundations-2019',
            "lpId" => '215952'
        ]) }}" @endif
           class="bg-white pa corners-10 text-black no-decoration relative">

            <div class="flex flex-column bg-singeo square rounded relative stats-dial" dusk="foundations-progress-dial">
                <div class="flex flex-column flex-center bg-white rounded stats-content">
                    <h3 class="display">{{ $completedTypes['foundations'] }}%</h3>
                    <h3 class="body font-bold dense uppercase">Completed</h3>
                </div>
                <div class="flex flex-row bg-white stats-type body uppercase align-center nowrap">
                    <i class="icon-learning-paths mr-1"></i> Foundations
                </div>
            </div>
        </a>
    </div>
    <div class="flex flex-column xs-6 sm-3 text-center user-stats-col">
        <a @if(!$isPublic) href="{{ url()->route('members.profile.lists') . '?state=completed' }}" @endif
           class="bg-white pa corners-10 text-black no-decoration relative">

            <div class="flex flex-column bg-singeo square rounded relative stats-dial" dusk="completed-lesson-dial">
                <div class="flex flex-column flex-center bg-white rounded stats-content">
                    <h3 class="display">{{ $completedTypes['lessons'] }}</h3>
                    <h3 class="body font-bold dense uppercase">Completed</h3>
                </div>
                <div class="flex flex-row bg-white stats-type body uppercase align-center nowrap">
                    <i class="fas fa-trophy mr-1"></i> Lessons
                </div>
            </div>
        </a>
    </div>
    <div class="flex flex-column xs-6 sm-3 text-center user-stats-col">
        <a @if(!$isPublic) href="{{ url()->route('members.profile.dashboard', [auth()->id()]) }}" @endif
           class="bg-white pa corners-10 text-black no-decoration relative">

            <div class="flex flex-column bg-singeo square rounded relative stats-dial" dusk="member-time-dial">
                <div class="flex flex-column flex-center bg-white rounded stats-content">
                    <h3 class="display">{{ $completedTypes['member'] }}</h3>
                    <h3 class="body font-bold dense uppercase">Days</h3>
                </div>
                <div class="flex flex-row bg-white stats-type body uppercase align-center nowrap">
                    <i class="fas fa-calendar-alt mr-1"></i> As a Member
                </div>
            </div>
        </a>
    </div>
</div>