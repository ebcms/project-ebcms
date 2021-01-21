{include common/header@plugin/installer}
<div class="row">
    <div class="col-md-3">
        {include common/nav@plugin/installer}
    </div>
    <div class="col-md-9">
        <div class="overflow-auto p-3" style="height: 400px;">
            <div id="LICENSE"></div>
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
                $("#LICENSE").html(md.render(base64Decode("{:base64_encode(file_exists($app->getAppPath().'/LICENSE')?file_get_contents($app->getAppPath().'/LICENSE'):'__暂无介绍__')}")));
                $("#LICENSE a").attr("target", "_blank");
                $("#LICENSE table").addClass("table table-bordered table-striped my-3");
            </script>
        </div>
    </div>
</div>
<hr>
<div class="mt-4 overflow-hidden">
    <a class="btn btn-primary float-right ml-2" href="{:$router->buildUrl('/plugin/installer/index', ['step'=>2])}" onclick="return confirm('此协议具有法律效应，请认真阅读！！\r\n同意请点击“确定”\r\n不同意请点击“取消”');" role="button">下一步</a>
    <a class="btn btn-light float-right" href="{:$router->buildUrl('/plugin/installer/index', ['step'=>0])}" role="button">上一步</a>
</div>
{include common/footer@plugin/installer}