<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use common\models\Types;
use common\models\User;
use common\models\Web;

/* @var $this yii\web\View */
/* @var $searchModel common\models\StockSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', '产品列表');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="stock-index">

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
                                    <script>
                                        $('#datetimepicker1').datetimepicker({
                                            autoclose: true,
                                            format: 'yyyy-mm-dd',
                                            todayBtn: false,
                                            showMeridian: false,
                                            language: 'zh-CN',
                                            pickerPosition: "bottom-left",
                                        });
                                        $('#datetimepicker2').datetimepicker({
                                            autoclose: true,
                                            format: 'yyyy-mm-dd',
                                            todayBtn: false,
                                            showMeridian: false,
                                            language: 'zh-CN',
                                            pickerPosition: "bottom-left",
                                        });

                                    </script>


<!--                                    <div class="alert alert-info" role="alert">-->
<!--                                        <p>查询条件：</p>-->
<!--                                        <p>-->
<!--                                            [起始时间：--><?php //if (isset($post_data['start_time']) && !empty($post_data['start_time'])) {
//                                                echo $post_data['start_time'];
//                                            } ?><!--] --->
<!--                                            [结束时间：--><?php //if (isset($post_data['end_time']) && !empty($post_data['end_time'])) {
//                                                echo $post_data['end_time'];
//                                            } ?><!--]</p>-->
<!--                                        <p> 出库数量：1679</p>-->
<!--                                        <p>出库次数：1265</p>-->
<!--                                    </div>-->

                                <?php Pjax::begin(); ?>    <?= GridView::widget([
                                    'dataProvider' => $dataProvider,
                                    'layout' => '{items}{summary}{pager}',
//                                    'filterModel' => $searchModel,
                                    'columns' => [
                                        'id',
                                        'number',
                                        'name',
                                        'total_number',
                                        [
                                            'attribute' => 'brand',
                                            'value' =>
                                                function ($searchModel) {
                                                    return mb_substr(Types::getName($searchModel->brand), 0, 10, 'utf-8');
                                                },
                                        ],
                                        [
                                            'attribute' => 'size',
                                            'value' =>
                                                function ($searchModel) {
                                                    return mb_substr(Types::getName($searchModel->size), 0, 10, 'utf-8');
                                                },
                                        ],
                                        [
                                            'attribute' => 'goods_type',
                                            'value' =>
                                                function ($searchModel) {
                                                    return mb_substr(Types::getName($searchModel->goods_type), 0, 10, 'utf-8');
                                                },
                                        ],
                                        [
                                            'attribute' => 'company',
                                            'value' =>
                                                function ($searchModel) {
                                                    return mb_substr(Types::getName($searchModel->company), 0, 10, 'utf-8');
                                                },
                                        ],
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
                                            'template' => '{view} {update}{logs}',
                                            'buttons' => [
                                                'view' => function ($url, $model) {
                                                    return Html::a(Yii::t('app', '[查看]'), $url, [
                                                        'title' => Yii::t('app', '查看'),
                                                        'class' => 'dglyphicon dglyphicon-eye-open',
                                                    ]);
                                                },
                                                'update' => function ($url, $model) {
                                                    return Html::a(Yii::t('app', '[更新]'), $url, [
                                                        'title' => Yii::t('app', '更新'),
                                                        'class' => 'dglyphicon dglyphicon-pencil',
                                                    ]);
                                                },


                                                'logs' => function ($url, $model) {
                                                    return Html::a(Yii::t('app', '[操作记录]'), $url, [
                                                        'class' => 'dglyphicon dglyphicon-picture',
                                                        'title' => Yii::t('app', '图片上传'),
                                                        'style' => 'margin: 0 0 0 5px',
                                                    ]);
                                                },
                                            ],

                                        ],
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
</div>
