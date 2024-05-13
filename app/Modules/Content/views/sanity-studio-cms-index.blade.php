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
<div id="app"></div>
<script type="module">
    import { defineConfig, renderStudio } from "https://esm.sh/sanity@3.38.1-canary.107"
    import { deskTool } from "https://esm.sh/sanity@3.38.1-canary.107/desk"

    const config = defineConfig({
        plugins: [deskTool()],
        projectId: "{{$projectId}}",
        dataset: "{{$dataset}}",
        basePath: "{{$basePath}}",
        schema: {!! $schema !!}
    });
    renderStudio(document.getElementById("app"), config);
</script>
</body>
</html>
