<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Customer */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Customers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customer-view">

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
            'phone',
            'address',
//            'customer_type',
            [
                'attribute' => 'customer_type',
                'value' =>
                    function ($searchModel) {
                        return mb_substr(common\models\Types::getName($searchModel->customer_type), 0, 10, 'utf-8');
                    },
            ],
            [
                'attribute' => 'source_type',
                'value' =>
                    function ($searchModel) {
                        return mb_substr(common\models\Types::getName($searchModel->source_type), 0, 10, 'utf-8');
                    },
            ],
//            'source_type',
            'remark',
            [
                'attribute' => 'token',
                'value'=>
                    function($model){
                        return \common\models\Web::GetWebName($model->token);
                    },
            ],
            [
                'attribute' => 'add_user',
                'value'=>
                    function($model){
                        return \common\models\User::get_username($model->add_user);
                    },
            ],
            [
                'attribute' => 'status',
                'value' =>
                    function ($searchModel) {
                        return mb_substr(common\models\Types::getName($searchModel->status), 0, 10, 'utf-8');
                    },
            ],
//            'status',
            'update_at',
            'create_at',
        ],
    ]) ?>

                            </div></div></div></div></div></div></div></div>
