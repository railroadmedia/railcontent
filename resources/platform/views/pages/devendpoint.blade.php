
@section('meta')
    <title>{{ ucfirst($brand) }} DevEndpoint | Musora</title>
@endsection
<html>
<head>
    <link rel="stylesheet" href="{{ mix('platform/css/app.css') }}">
</head>
<body>
<script type="application/javascript">
    window.sidebarNavigationLinks = {!! $sidebarNavigationSectionsJson ?? '' !!};
    window.userNavigationDropdownLinks = {!! $userNavigationDropdownLinksJson ?? '' !!};
    window.railcontentConfig = {};
</script>
<div id="app" class="flex-1">
    <dev-endpoint
            results="{{ $results }}"
            json_results="{{json_encode($json_results)}}"
    ></dev-endpoint>
</div>
<script src="{{ mix('platform/js/manifest.js') }}"></script>
<script src="{{ mix('platform/js/vendor.js') }}"></script>
<script src="{{ mix('platform/js/app.js') }}"></script>
</body>

</html>
