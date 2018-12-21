<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use common\models\Types;
use common\models\User;

/* @var $this yii\web\View */
/* @var $searchModel app\models\StockLogsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Stock Logs');
$this->params['breadcrumbs'][] = $this->title;
?>
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
                            <?php echo $this->render('_search', ['model' => $searchModel]); ?>

                            <?php Pjax::begin(); ?>

                            <?= GridView::widget([
                                'dataProvider' => $dataProvider,
//                                'filterModel' => $searchModel,
                                'layout' => '{items}{summary}{pager}',
                                'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],

                                    'id',

                                    [
                                        'attribute' => 'stock_id',
                                        'value' =>
                                            function ($searchModel) {
                                                return mb_substr(\common\models\Stock::get_stock_name($searchModel->stock_id), 0, 10, 'utf-8');
                                            },
                                    ],
                                    [
                                        'attribute' => 'orders_id',
                                        'value' =>
                                            function ($searchModel) {
                                                return mb_substr(\common\models\Orders::get_name($searchModel->orders_id), 0, 10, 'utf-8');
                                            },
                                    ],
                                    'before_number',
                                    'current_number',
                                    'total_number',


//             'customer_id',
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
                                                return mb_substr(Types::getName($searchModel->purpose_id), 0, 10, 'utf-8');
                                            },
                                    ],
                                    [
                                        'attribute' => 'status',
                                        'value' =>
                                            function ($searchModel) {
                                                return mb_substr(\common\models\StockLogs::get_status_name($searchModel->status), 0, 10, 'utf-8');
                                            },
                                    ],
                                    [
                                        'attribute' => 'add_user',
                                        'value' =>
                                            function ($model) {
                                                return User::get_username($model->add_user);
                                            },
                                    ],
                                    [
                                        'attribute' => 'operation_time',
                                        'value' =>
                                            function ($model) {
                                                return date('Y-m-d',strtotime($model->operation_time));
                                            },
                                    ],
//                                    'operation_time',
                                    'create_at',
                                    [
                                        'attribute' => 'token',
                                        'value' =>
                                            function ($model) {
                                                return \common\models\Web::GetWebName($model->token);
                                            },
                                    ],
                                    [
                                        'class' => 'yii\grid\ActionColumn',
                                        'header' => '操作',
                                        'options' => ['width' => '100px;'],
                                        'template' => '{view}',
                                        'buttons' => [
                                            'view' => function ($url, $model) {
                                                return Html::a(Yii::t('app', '[查看]'), $url, [
                                                    'title' => Yii::t('app', '查看'),
                                                    'class' => 'dglyphicon dglyphicon-eye-open',
                                                ]);
                                            },

                                        ],

                                    ],
//            ['class' => 'yii\grid\ActionColumn'],
                                ],
                            ]); ?>
                            <?php Pjax::end(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
