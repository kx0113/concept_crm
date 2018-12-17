<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\OrdersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', '订单列表');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orders-index">

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

    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>


<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'layout' => '{items}{summary}{pager}',
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'name',
//            'address',
//            'customer_id',

            [
            'attribute' => 'customer_id',
            'value'=>
                function($model){
                    return \common\models\Customer::get_name($model->customer_id);
                },
        ],
//            'start_time',
//             'end_time',
             'phone',
//             'work_cost',
//             'freight_cost',
//             'remark',
            [
                'attribute' => 'orders_type',
                'value' =>
                    function ($searchModel) {
                        return mb_substr(\common\models\Types::getName($searchModel->orders_type), 0, 10, 'utf-8');
                    },
            ],
            [
                'attribute' => 'status',
                'value'=>
                    function($model){
                        return \common\models\Orders::get_status($model->status);
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
                'attribute' => 'token',
                'value'=>
                    function($model){
                        return \common\models\Web::GetWebName($model->token);
                    },
            ],
            // 'update_at',
             'create_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>    </div></div></div></div></div></div></div>
