<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Types */

$this->title = Yii::t('app', '创建分类');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="types-create">

    <div class="wrapper wrapper-content">
        <div class="ibox float-e-margins">
            <div class="ibox-content">
                <p>
                    <?= Html::encode($this->title) ?>
                </p>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="ibox float-e-margins">
                            <div class="ibox-content">

    <?= $this->render('_form', [
        'model' => $model,
        'type_list'=>$type_list,
    ]) ?>

</div></div></div></div></div></div></div></div>
