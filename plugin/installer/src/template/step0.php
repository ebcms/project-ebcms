{include common/header@plugin/installer}
<div class="row">
    <div class="col-md-3">
        {include common/nav@plugin/installer}
    </div>
    <div class="col-md-9">
        <div class="overflow-auto p-3" style="height: 400px;">
            <div id="readme"></div>
            <script src="https://cdn.jsdelivr.net/npm/markdown-it@12.0.3/dist/markdown-it.min.js" integrity="sha256-w9HUyWlYpo2NY0GnFNkPqoxBdCNZNn1B3lgPQif2d2I=" crossorigin="anonymous"></script>
            <script src="https://cdn.bootcdn.net/ajax/libs/highlight.js/10.1.1/highlight.min.js"></script>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/highlight.js@10.1.2/styles/vs.css">
            <style>
                h1,
                h2,
                h3,
                h4,
                h5 {
                    margin: 15px 0;
                }
            </style>
            <script>
                function base64Decode(input) {
                    rv = window.atob(input);
                    rv = escape(rv);
                    rv = decodeURIComponent(rv);
                    return rv;
                }
                var md = window.markdownit({
                    highlight: function(str, lang) {
                        if (lang && hljs.getLanguage(lang)) {
                            try {
                                return '<pre class="hljs"><code>' +
                                    hljs.highlight(lang, str, true).value +
                                    '</code></pre>';
                            } catch (__) {}
                        }
                        return '<pre class="hljs"><code>' + window.markdownit().utils.escapeHtml(str) + '</code></pre>';
                    }
                });
                $("#readme").html(md.render(base64Decode("{:base64_encode(file_exists($app->getAppPath().'/README.md')?file_get_contents($app->getAppPath().'/README.md'):'__暂无介绍__')}")));
                $("#readme a").attr("target", "_blank");
                $("#readme table").addClass("table table-bordered table-striped my-3");
            </script>
        </div>
    </div>
</div>
<hr>
<div class="mt-4 overflow-hidden">
    <a class="btn btn-primary float-right" href="{:$router->buildUrl('/plugin/installer/index', ['step'=>1])}" role="button">下一步</a>
</div>
{include common/footer@plugin/installer}