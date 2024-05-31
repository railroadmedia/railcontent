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
        <div id="sanity-app">
            
        </div>
        {{-- Scripts --}}
        <script type="text/javascript">
            window.SanityConfig = {
                projectId: "{{ $projectId }}",
                dataset: "{{ $dataset }}",
                basePath: "{{ $basePath }}"
            };
        </script>
        <script src="{{ mix('platform/js/manifest.js') }}"></script>
        <script src="{{ mix('platform/js/vendor.js') }}"></script>
        <script src="{{ mix('sanity/js/sanity-app.js') }}"></script>
    </body>
</html>
