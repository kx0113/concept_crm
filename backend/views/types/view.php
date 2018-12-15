<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Types */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="types-view">

    <div class="wrapper wrapper-content">
        <div class="ibox float-e-margins">
            <div class="ibox-content">
                <p>
                    <?= Html::encode('查看：'.$this->title) ?>
                </p>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="ibox float-e-margins">
                            <div class="ibox-content">

    <p>
        <?= Html::a(Yii::t('app', '更新'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', '删除'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            [
                'attribute' => 'keys',
                'value'=>
                    function($model){
                        return Yii::$app->params['types_classs'][$model->keys];
                    },
            ],
            [
                'attribute' => 'parent',
                'value'=>
                    function($model){
                        if(!empty($model->parent)){
                            return Yii::$app->params['types_classs'][$model->parent];
                        }else{
                            return '';
                        }
                    },
            ],
            'info',
            'add_time',
            [
                'attribute' => 'add_user',
                'value'=>
                    function($model){
                        return \common\models\User::get_username($model->add_user);
                    },
            ],
            [
                'attribute' => 'token',
                'value'=>
                    function($model){
                        return \common\models\Web::GetWebName($model->token);
                    },
            ],
        ],
    ]) ?>

                            </div></div></div></div></div></div></div></div>
