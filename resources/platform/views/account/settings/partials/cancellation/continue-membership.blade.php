{{-- todo: return with message...? --}}
{{--<a href="{{ url()->route('platform.profile.settings.account.offer') }}"--}}
{{--   class="">--}}
{{--    Continue My Membership--}}
{{--</a>--}}
<form method="post"
    action="{{ url()->route('platform.profile.settings.gratis-access') }}"
    id="cancel-reason-form"
    class="tw-flex tw-flex-col tw-flex-grow"
>

    {{ csrf_field() }}
    <button
        type="submit"
        class=""
        style="cursor: pointer">
        Finish Cancelling
    </button>

</form>
