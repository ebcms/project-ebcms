<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{$site['title']??''} | Powered by EBCMS</title>
    <meta name="keywords" content="{$site['keywords']??''}" />
    <meta name="description" content="{$site['description']??''}" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        a {
            text-decoration: none;
        }

        .breadcrumb {
            color: #6c757d;
        }

        .breadcrumb a {
            color: #6c757d;
        }
    </style>
</head>

<body>
    <div class="container-xxl d-print-none mb-4 mt-4">
        <img src="{$config->get('site.logo@ebcms.web')}" alt="{$config->get('site.name@ebcms.web')}" style="max-height:80px;">
    </div>
    {include common/navbar@ebcms/cms-web}