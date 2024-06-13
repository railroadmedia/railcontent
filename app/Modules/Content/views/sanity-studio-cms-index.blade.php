@php
    $manifest = json_decode(file_get_contents(public_path('sanity/asset-manifest.json')), true);
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
        window.sanityConfig = {
            projectId: "{{ $projectId }}",
            dataset: "{{ $dataset }}",
            basePath: "{{ $basePath }}",
            appUrl: "{{ $appUrl }}",
            schema: {!! stripFromJson($schema) !!},
        csrfToken: "{{ $csrfToken }}",
        };
    </script>

    <div id="root"></div>

    @foreach($manifest['entrypoints'] as $file)
        <script src="{{ asset('sanity/' . $file) }}"></script>
    @endforeach
</body>

</html>
