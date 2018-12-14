<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use common\models\Types;

/* @var $this yii\web\View */
/* @var $searchModel common\models\CustomerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', '客户列表');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customer-index">

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
            'phone',
            'address',
//            'customer_type',
            [
                'attribute' => 'customer_type',
                'value' =>
                    function ($searchModel) {
                        return mb_substr(Types::getName($searchModel->customer_type), 0, 10, 'utf-8');
                    },
            ],
            [
                'attribute' => 'source_type',
                'value' =>
                    function ($searchModel) {
                        return mb_substr(Types::getName($searchModel->source_type), 0, 10, 'utf-8');
                    },
            ],
            [
                'attribute' => 'status',
                'value' =>
                    function ($searchModel) {
                        return mb_substr(Types::getName($searchModel->status), 0, 10, 'utf-8');
                    },
            ],
//             'source_type',
            // 'token',
            // 'add_user',
//             'status',
//             'update_at',
             'create_at',
            [
                'attribute' => 'token',
                'value'=>
                    function($model){
                        return \common\models\Web::GetWebName($model->token);
                    },
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => '操作',
                'options' => ['width' => '100px;'],
                'template' => '{view} {update}',
            ],
//            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div></div></div></div></div></div></div></div>
