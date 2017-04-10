<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

?>

<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <!-- start: CSS -->
    <link id="bootstrap-style" href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/bootstrap-responsive.min.css" rel="stylesheet">
    <link id="base-style" href="/css/style.css" rel="stylesheet">
    <link id="base-style-responsive" href="/css/style-responsive.css" rel="stylesheet">
    <link id="base-style" href="/layui-1.0.9/layui/css/layui.css" rel="stylesheet">
    <link id="base-style" href="/layui-1.0.9/layui/css/modules/layer/default/layer.css" rel="stylesheet">
    <link id="base-style" href="/layui-1.0.9/layui/css/modules/code.css" rel="stylesheet">
    <!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <link id="ie-style" href="/css/ie.css" rel="stylesheet">
    <![endif]-->

    <!--[if IE 9]>
    <link id="ie9style" href="/css/ie9.css" rel="stylesheet">
    <![endif]-->

    <!-- start: Favicon -->
    <link rel="shortcut icon" href="/img/favicon.ico">
    <!-- end: Favicon -->
    <script src="/js/jquery-1.9.1.min.js"></script>
    <script src="/js/jquery-migrate-1.0.0.min.js"></script>
</head>
<body>
<style>

    .navbar a{
        text-shadow: none;
        text-decoration: none;
        color: #ffffff;
    }
</style>

<div class="wrap" >

    <div class="navbar">
        <div class="navbar-inner">
            <div class="container-fluid">
                <a class="btn btn-navbar" data-toggle="collapse" data-target=".top-nav.nav-collapse,.sidebar-nav.nav-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <a class="layui-btn layui-btn-danger" href="<?= \yii\helpers\Url::to(['game/create-game']) ?>">开始新局</a>
                <?php
                    if(Yii::$app->controller->action->id == 'start'){
                        ?>
                        <a class="layui-btn" href="javascript:setTop()"><span>统计</span></a>
                <?php
                    }
                ?>

                <a class="layui-btn layui-btn-error" href="<?= \yii\helpers\Url::to(['game/create-game']) ?>"><span>押注战略</span></a>
                <a class="layui-btn layui-btn-warning" href="<?= \yii\helpers\Url::to(['game/create-game']) ?>"><span>玩法心得</span></a>
            </div>
        </div>
    </div>
    <div>

        <?= $content ?>
    </div>
</div>

<!-- start: JavaScript-->

<script src="/js/jquery-1.9.1.min.js"></script>
<script src="/js/jquery-migrate-1.0.0.min.js"></script>

<script src="/js/jquery-ui-1.10.0.custom.min.js"></script>

<script src="/js/jquery.ui.touch-punch.js"></script>

<script src="/js/modernizr.js"></script>

<script src="/js/bootstrap.min.js"></script>

<script src="/js/jquery.cookie.js"></script>

<script src='/js/fullcalendar.min.js'></script>

<script src='/js/jquery.dataTables.min.js'></script>

<script src="/js/excanvas.js"></script>
<script src="/js/jquery.flot.js"></script>
<script src="/js/jquery.flot.pie.js"></script>
<script src="/js/jquery.flot.stack.js"></script>
<script src="/js/jquery.flot.resize.min.js"></script>

<script src="/js/jquery.chosen.min.js"></script>

<script src="/js/jquery.uniform.min.js"></script>

<script src="/js/jquery.cleditor.min.js"></script>

<script src="/js/jquery.noty.js"></script>

<script src="/js/jquery.elfinder.min.js"></script>

<script src="/js/jquery.raty.min.js"></script>

<script src="/js/jquery.iphone.toggle.js"></script>

<script src="/js/jquery.uploadify-3.1.min.js"></script>

<script src="/js/jquery.gritter.min.js"></script>

<script src="/js/jquery.imagesloaded.js"></script>

<script src="/js/jquery.masonry.min.js"></script>

<script src="/js/jquery.knob.modified.js"></script>

<script src="/js/jquery.sparkline.min.js"></script>

<script src="/js/counter.js"></script>

<script src="/js/retina.js"></script>

<script src="/js/custom.js"></script>


</body>
</html>

