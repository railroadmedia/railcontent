@extends('emails.layout')

@section('page-body')
<style>
    h3{font-size:1.3em}
</style>
<div style="display: none; max-height: 0px; overflow: hidden;">
    You just need 60 seconds.
</div>

<div style="display: none; max-height: 0px; overflow: hidden;">
    &shy; &shy; &shy; &shy; &shy; &shy; &shy; &shy; &shy; &shy;
</div>
<div>
    <p>I hope you’re excited!</p>

    <p>You now have unlimited access to thousands of music lessons and practice tools. But before you can start playing…</p>

    <p>You just need to finish setting up your account:</p>

    <a href="{{ $setupAccountUrl }}"> Complete your account </a>

    <p>We promise it should only take a minute.⏱️</p>

    <p>After that, you’re free to begin your journey to improve your technique, start a practice routine, and play more songs.</p>

    <p>See you there!</p>

    <p>- The Musora Team</p>
</div>
@stop
