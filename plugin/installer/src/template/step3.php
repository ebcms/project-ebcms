{include common/header@plugin/installer}
<form action="{:$router->buildUrl('/plugin/installer/index', ['step'=>4])}" method="POST">
    <div class="row">
        <div class="col-md-3">
            {include common/nav@plugin/installer}
        </div>
        <div class="col-md-9">
            <div class="overflow-auto p-3" style="height: 400px;">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>数据库地址:</label>
                        <input type="text" class="form-control" name="database_server" value="127.0.0.1" required>
                        <small class="form-text text-muted">通常是127.0.0.1</small>
                    </div>
                    <div class="form-group col-md-6">
                        <label>数据库端口:</label>
                        <input type="text" class="form-control" name="database_port" value="3306" required>
                        <small class="form-text text-muted">通常是3306</small>
                    </div>
                </div>
                <div class="form-group">
                    <label>数据库名称:</label>
                    <input type="text" class="form-control" name="database_name" value="" required>
                    <small class="form-text text-danger">本安装程序不会创建数据库，请先手动创建，谢谢！</small>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>数据库帐号:</label>
                        <input type="text" class="form-control" name="database_username" value="root" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label>数据库密码:</label>
                        <input type="text" class="form-control" name="database_password" value="root">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="mt-4 overflow-hidden">
        <button type="submit" class="btn btn-primary float-right ml-2">安装</button>
        <a class="btn btn-light float-right" href="{:$router->buildUrl('/plugin/installer/index', ['step'=>2])}" role="button">上一步</a>
    </div>
</form>
{include common/footer@plugin/installer}