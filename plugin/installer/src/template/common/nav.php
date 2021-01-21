<ul class="nav flex-column border-right nav-pills pr-4">
    <?php
    $per = ($input->get('step', 0, ['intval']) + 1) * 20;
    $steps = ['系统简介', '协议条款', '系统检测', '初始设置', '安装完成'];
    ?>
    {foreach $steps as $k=>$v}
    {if $input->get('step', 0, ['intval']) > $k}
    <li class="nav-item">
        <a class="nav-link disabled" href="#">{$v}</a>
    </li>
    {elseif $input->get('step', 0, ['intval']) == $k}
    <li class="nav-item">
        <a class="nav-link active" href="#">{$v}</a>
    </li>
    {else}
    <li class="nav-item">
        <a class="nav-link disabled" href="#">{$v}</a>
    </li>
    {/if}
    {/foreach}
</ul>