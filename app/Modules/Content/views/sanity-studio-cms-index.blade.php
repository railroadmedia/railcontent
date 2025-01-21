@php
    $manifest = json_decode(file_get_contents(public_path('sanity/mix-manifest.json')), true);
@endphp

<html>

<head>
    <style>
        html {
            -webkit-text-size-adjust: 100%;
            text-size-adjust: 100%;
            -webkit-tap-highlight-color: transparent;
            -webkit-font-smoothing: antialiased;
        }

        html,
        body,
        #app {
            height: 100%;
            margin: 0;
            overflow: hidden;
        }
    </style>
</head>

<body>
    {{-- Scripts --}}
    <script type="text/javascript">
        window.sanityConfig = [
            @foreach($workspaces as $workspace)
            {
                projectId: "{{ $workspace['projectId'] }}",
                name: "{{ $workspace['name'] }}",
                title: "{{ $workspace['title'] }}",
                dataset: "{{ $workspace['dataset'] }}",
                basePath: "{{ $workspace['basePath'] }}",
                icon: "{{ $workspace['icon'] }}",
                appUrl: "{{ $appUrl }}",
                schema: {!! stripFromJson($workspace['schema']) !!},
                csrfToken: "{{ $csrfToken }}",
                token: "{{ $workspace['token'] }}"
            },
            @endforeach
        ];
    </script>

    <div id="root"></div>

    @foreach($manifest as $file)
        <script src="{{ asset('sanity' . $file) }}"></script>
    @endforeach
</body>

</html>
