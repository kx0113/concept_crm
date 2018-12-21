<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\StockLogs */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Stock Logs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="stock-logs-view">

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
<!--        --><?//= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
<!--        --><?//= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
//            'class' => 'btn btn-danger',
//            'data' => [
//                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
//                'method' => 'post',
//            ],
//        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'stock_id',
                'value' =>
                    function ($searchModel) {
                        return mb_substr(\common\models\Stock::get_stock_name($searchModel->stock_id), 0, 10, 'utf-8');
                    },
            ],
            'total_number',
            'current_number',
            'before_number',
            [
                'attribute' => 'customer_id',
                'value' =>
                    function ($searchModel) {
                        return mb_substr(\common\models\Customer::get_name($searchModel->customer_id), 0, 10, 'utf-8');
                    },
            ],
//             'purpose_id',
//             'is_returns',
            [
                'attribute' => 'is_returns',
                'value' =>
                    function ($searchModel) {
                        return mb_substr(\common\models\StockLogs::get_is_returns_name($searchModel->is_returns), 0, 10, 'utf-8');
                    },
            ],
            [
                'attribute' => 'purpose_id',
                'value' =>
                    function ($searchModel) {
                        return mb_substr(\common\models\Types::getName($searchModel->purpose_id), 0, 10, 'utf-8');
                    },
            ],
            [
                'attribute' => 'status',
                'value' =>
                    function ($searchModel) {
                        return mb_substr(\common\models\StockLogs::get_status_name($searchModel->status), 0, 10, 'utf-8');
                    },
            ],
            'remark',
            [
                'attribute' => 'add_user',
                'value' =>
                    function ($model) {
                        return \common\models\User::get_username($model->add_user);
                    },
            ],
            [
                'attribute' => 'token',
                'value' =>
                    function ($model) {
                        return \common\models\Web::GetWebName($model->token);
                    },
            ],
            [
                'attribute' => 'operation_time',
                'value' =>
                    function ($model) {
                        return date('Y-m-d',strtotime($model->operation_time));
                    },
            ],
            'update_at',
            'create_at',
        ],
    ]) ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
