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
                                <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
                                <style>
                                    .search_title_stock {
                                        display: block;
                                        width: 20%;
                                        text-align: center;
                                        line-height: 34px;
                                        margin: 0;
                                        padding: 0;
                                        float: left;
                                    }

                                    .search_input_stock {
                                        float: right;
                                        width: 80%;
                                    }
                                </style>
                                <div>
                                    <div>
                                        <link href="components/bootstrap-datetimepicker-master/css/bootstrap-datetimepicker.css"
                                              media="all" rel="stylesheet" type="text/css"/>
                                        <script src="components/bootstrap-datetimepicker-master/js/bootstrap-datetimepicker.js"
                                                type="text/javascript"></script>


                                        <!--            <br>-->
                                        <div style="padding: 0;" class="form-group col-xs-4">
                                            <label class="search_title_stock"
                                                   for="exampleInputEmail1">开始时间</label>

                                            <input class="search_input_stock form-control"
                                                   type="text" value="2012-05-15" data-date-format="yyyy-mm-dd"
                                                   id="datetimepicker">

                                        </div>
                                        <div style="padding: 0;" class="form-group col-xs-4">
                                            <label class="search_title_stock"
                                                   for="exampleInputEmail1">产品编号</label>
                                            <input type="email" class="search_input_stock form-control"
                                                   id="exampleInputEmail1" placeholder="产品编号">
                                        </div>

                                        <div style="padding: 0;" class="form-group col-xs-4">
                                            <label class="search_title_stock"
                                                   for="exampleInputEmail1">产品名称</label>
                                            <input type="email" class="search_input_stock form-control"
                                                   id="exampleInputEmail1" placeholder="产品名称">
                                        </div>
                                        <div style="padding: 0;" class="form-group col-xs-4">
                                            <label class="search_title_stock"
                                                   for="exampleInputEmail1">规格分类</label>
                                            <input type="email" class="search_input_stock form-control"
                                                   id="exampleInputEmail1" placeholder="规格">
                                        </div>
                                        <div style="padding: 0;" class="form-group col-xs-4">
                                            <label class="search_title_stock"
                                                   for="exampleInputEmail1">物品分类</label>
                                            <input type="email" class="search_input_stock form-control"
                                                   id="exampleInputEmail1" placeholder="物品分类">
                                        </div>
                                        <div style="padding: 0;" class="form-group col-xs-4">
                                            <label class="search_title_stock"
                                                   for="exampleInputEmail1">单位分类</label>
                                            <input type="email" class="search_input_stock form-control"
                                                   id="exampleInputEmail1" placeholder="单位分类">
                                        </div>
                                        <!--            <div class="col-xs-3 form-group field-stock-number has-success">-->
                                        <!--                <label style="-->
                                        <!--                float: left;-->
                                        <!---->
                                        <!--                margin:8px 0 0 0;-->
                                        <!--                font-size: 15px;"-->
                                        <!--                       class="control-label" for="stock-number">编号</label>-->
                                        <!--                <input style="width: 80%;float: right;" type="text" id="stock-number" class="form-control" name="Stock[number]" aria-invalid="false">-->
                                        <!---->
                                        <!--                <div class="help-block"></div>-->
                                        <!--            </div>-->

                                        <div style="clear: both"></div>
                                    </div>

                                </div>
                                <script>
                                    $('#datetimepicker').datetimepicker({
                                        autoclose: true,
                                        format: 'yyyy-mm-dd',
                                        todayBtn: false,
                                        showMeridian: false,
                                        language: 'zh-CN',
                                        pickerPosition: "bottom-left",
                                    });

                                </script>
                                <p>
                                    <?= Html::a(Yii::t('app', '搜索'), ['index'], ['class' => 'btn btn-success']) ?>
                                </p>
                                <div class="alert alert-info" role="alert">
                                    <p>查询条件：</p>
                                    <p>[起始时间：2010-09-23] - [结束时间：2018-10-10]</p>
                                    <p> 出库数量：1679</p>
                                    <p>出库次数：1265</p>
                                </div>

                                <?php Pjax::begin(); ?>    <?= GridView::widget([
                                    'dataProvider' => $dataProvider,
                                    'layout' => '{items}{summary}{pager}',
                                    'columns' => [
                                        'number',
                                        'name',
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
//             'remark',
                                        // 'ext1',
                                        // 'ext2',
//             'status',
//             'add_user',
//            [
//                'attribute' => 'add_user',
//                'value'=>
//                    function($model){
//                        return User::get_username($model->add_user);
//                    },
//            ],
//            [
//                'attribute' => 'token',
//                'value'=>
//                    function($model){
//                        return Web::GetWebName($model->token);
//                    },
//            ],
//             'update_at',
                                        'create_at',
                                        [
                                            'class' => 'yii\grid\ActionColumn',
                                            'header' => '操作',
                                            'options' => ['width' => '100px;'],
                                            'template' => '{view} {update}{delete}{upload}',
                                            'buttons' => [
                                                'view' => function ($url, $model) {
                                                    return Html::a(Yii::t('app', '[查看]'), $url, [
                                                        'title' => Yii::t('app', '查看'),
//                            'style'=>'margin: 0 5px 0 0 ',
                                                        'class' => 'dglyphicon dglyphicon-eye-open',
                                                    ]);
                                                },
                                                'update' => function ($url, $model) {
                                                    return Html::a(Yii::t('app', '[更新]'), $url, [
                                                        'title' => Yii::t('app', '更新'),
                                                        'class' => 'dglyphicon dglyphicon-pencil',
                                                    ]);
                                                },

                                                'delete' => function ($url, $model) {
                                                    return Html::a(Yii::t('app', '[删除]'), $url, [
                                                        'title' => Yii::t('app', '删除'),
                                                        'class' => 'dglyphicon dglyphicon-trash',
                                                    ]);
                                                },
                                                'upload' => function ($url, $model) {
                                                    return Html::a(Yii::t('app', '[入库记录]'), $url, [
                                                        'class' => 'dglyphicon dglyphicon-picture',
                                                        'title' => Yii::t('app', '图片上传'),
                                                        'style' => 'margin: 0 0 0 5px',
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
</div>
