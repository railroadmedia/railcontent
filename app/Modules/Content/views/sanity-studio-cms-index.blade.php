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
        <script type="module">
            import { defineConfig, renderStudio } from "https://esm.sh/sanity@3.38.1-canary.107";
            import { deskTool } from "https://esm.sh/sanity@3.38.1-canary.107/desk";

            //Global Component -> Not ideal way to do this
            const customInput = window.CustomInput;
            const config = defineConfig({
                plugins: [deskTool()],
                projectId: "{{$projectId}}",
                dataset: "{{$dataset}}",
                basePath: "{{$basePath}}",
                schema: {!! stripFromJson($schema) !!}
//                 schema: {
//                     types: [
//                         {
//                             type: "document",
//                             name: "post",
//                             title: "Post",
//                             fields: [
//                                 {
//                                     type: "string",
//                                     name: "title",
//                                     title: "Title"
//                                 },
//                                 {
//                                     name: 'myCustomField',
//                                     title: 'My Custom Field',
//                                     type: 'string',
//                                     inputComponent: customInput
//                                 }
//                             ]
//                         }
//                     ]
//                 }
            });
           // renderStudio(document.getElementById("sanity-app"), config);
        </script>
        <script type="text/javascript">
            window.SanityConfig = {
                projectId: "{{ $projectId }}",
                dataset: "{{ $dataset }}",
                basePath: "{{ $basePath }}",
                schema: {!! stripFromJson($schema) !!}
            };
        </script>
        <script src="{{ mix('platform/js/manifest.js') }}"></script>
        <script src="{{ mix('platform/js/vendor.js') }}"></script>
        <script src="{{ mix('platform/js/sanity-app.js') }}"></script>
    </body>
</html>
