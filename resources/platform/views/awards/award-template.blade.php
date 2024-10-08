<div>
    <h1> User:  {{ $user_name }}</h1>
    <h2> Minutes Practiced: {{ $minutes_practiced }}</h2>
    <h2> Streak: {{ $streak }}</h2>
    <h2> Date Completed: {{ $date_completed }} </h2>
    <h2> Tier: {{ $tier }} </h2>
    <h2> Brand: {{ $brand }} </h2>
    <h2> Challenge: {{ $challenge_title }} </h2>
    <h2> Award Text: {{ $award_text }} </h2>
    <h2> Signature file path: {{ $instructor_signature }}</h2>
    <img src="{{ $instructor_signature }}">
</div>
