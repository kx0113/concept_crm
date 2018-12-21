<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel common\models\FinanceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', '财务列表');
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

<?= $this->render('_search', [
    'model' => $searchModel,
]) ?>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'layout' => '{items}{summary}{pager}',
        'columns' => [

//            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'before_number',
                'value' =>
                    function ($searchModel) {
                        return '¥'.$searchModel->before_number;
                    },
            ],
            [
                'attribute' => 'current_number',
                'value' =>
                    function ($searchModel) {
                        return '¥'.$searchModel->current_number;
                    },
            ],
            [
                'attribute' => 'total_number',
                'value' =>
                    function ($searchModel) {
                        return '¥'.$searchModel->total_number;
                    },
            ],
//            'account_type',
            [
                'attribute' => 'account_type',
                'value' =>
                    function ($searchModel) {
                        return mb_substr(\common\models\Types::getName($searchModel->account_type), 0, 10, 'utf-8');
                    },
            ],
            // 'status',
            [
                'attribute' => 'account_category',
                'value' =>
                    function ($searchModel) {
                        return mb_substr(\common\models\Types::getName($searchModel->account_category), 0, 10, 'utf-8');
                    },
            ],

             'operation_time',
             'name',
//            'account_card',
             'content',
            // 'remark',
            // 'ext1',
            // 'ext2',
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
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => '操作',
                'options' => ['width' => '100px;'],
                'template' => '{view} {update}',
            ],
//            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?>

                        </div></div></div></div></div></div></div>
