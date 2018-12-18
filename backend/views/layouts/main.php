<?php

/* @var $this \yii\web\View */
/* @var $content string */

// use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

// AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title>后台管理</title>

    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <meta name="keywords" content="">
    <meta name="description" content="">
    <!--[if lt IE 9]>
    <meta http-equiv="refresh" content="0;ie.html" />
    <![endif]-->
    <link rel="凯旋科技" href="favicon.ico">
    <!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
    <!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
    <?=Html::cssFile('@web/css/bootstrap.min14ed.css')?>
    <?=Html::cssFile('@web/css/font-awesome.min93e3.css')?>
    <?=Html::cssFile('@web/css/animate.min.css')?>
    <?=Html::cssFile('@web/css/style.min862f.css')?>
    <?=Html::cssFile('@web/css/site.css')?>
    <?=Html::cssFile('@web/components/bootstrap-datetimepicker-master/css/bootstrap-datetimepicker.css')?>
    <?=Html::jsFile('@web/js/jquery.min.js')?>
    <?=Html::jsFile('@web/components/utf8-php/ueditor.config.js')?>
    <?=Html::jsFile('@web/components/utf8-php/ueditor.all.min.js')?>
    <?=Html::jsFile('@web/components/utf8-php/ueditor.all.min.js')?>
    <?=Html::jsFile('@web/components/utf8-php/lang/zh-cn/zh-cn.js')?>
    <?=Html::jsFile('@web/js/common.js')?>
    <?=Html::jsFile('@web/components/bootstrap-datetimepicker-master/js/bootstrap-datetimepicker.js')?>
    <?=Html::jsFile('@web/components/bootstrap-datetimepicker-master/js/locales/bootstrap-datetimepicker.zh-CN.js')?>
    <?=Html::jsFile('@web/components/layer-v3.1.1/layer/layer.js')?>
<!--    --><?//=Html::jsFile('@web/js/jquery.jqprint-0.3.js')?>
    <?=Html::jsFile('@web/js/echarts.min.js')?>
    <?php $this->head(); ?>
</head>
<body class="fixed-sidebar full-height-layout gray-bg">
<?php $this->beginBody(); ?>
<?= $content ?>
<?php $this->endBody(); ?>
</body>
</html>
<?php $this->endPage(); ?>
