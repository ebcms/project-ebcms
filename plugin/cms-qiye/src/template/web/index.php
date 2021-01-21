{include web/common/header@ebcms/cms}
<div class="my-3">
    {if function_exists('tpl_fragment')}{fragment 'plugin.cms-qiye.lunbo', '暂无'}{/if}
</div>
<div class="row">
    <div class="col-md-9">
        {if function_exists('tpl_fragment')}{fragment 'plugin.cms-qiye.aboutus', '暂无'}{/if}
        {if function_exists('tpl_fragment')}{fragment 'plugin.cms-qiye.product', '暂无'}{/if}
    </div>
    <div class="col-md-3">
        {include web/common/sidebar@ebcms/cms}
    </div>
</div>
{if function_exists('tpl_fragment')}{fragment 'ebcms.cms.link', '暂无'}{/if}
{include web/common/footer@ebcms/cms}