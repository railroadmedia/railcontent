<form method="post"
      action="{{ $routeUrl }}"
      id="cancel-reason-form"
      class="tw-flex tw-flex-col tw-flex-grow">

    {{ csrf_field() }}
    <button
        type="submit"
        class=""
        style="cursor: pointer">
        {{ $buttonText }}
    </button>

</form>
