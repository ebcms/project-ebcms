{include common/header@plugin/installer}
<div class="row">
    <div class="col-md-3">
        {include common/nav@plugin/installer}
    </div>
    <div class="col-md-9">
        <div class="overflow-auto p-3" style="height: 400px;">
            <div class="text-center">
                <div class="mt-5 display-4 text-success font-weight-bold">安装成功</div>
                <div class="mt-4 p-3 d-inline-block" style="border: 1px dotted red;background:yellow;">后台帐户：<b class="text-danger">{$account}</b>&nbsp;&nbsp;&nbsp;密码：<b class="text-danger">{$password}</b></div>
                <div class="mb-5 mt-3 font-weight-bolder text-danger font-italic">此页面只会出现一次，请牢记您的帐户和密码！</div>
            </div>
        </div>
    </div>
</div>
<hr>
<div class="mt-4 overflow-hidden">
    <a class="btn btn-secondary float-right" href="{:$router->buildUrl('/')}" target="_blank">访问前台</a>
    <a class="btn btn-primary float-right mr-2" href="{:$router->buildUrl('/ebcms/admin/index')}" target="_blank">登录后台</a>
</div>
{include common/footer@plugin/installer}