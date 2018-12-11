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
                                <form name="test" method="POST" action="index.php?r=stock/index">
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
                                                   type="text"
                                                   value="<?php if(isset($post_data['start_time']) && !empty($post_data['start_time'])){ echo $post_data['start_time']; } ?>"
                                                   name="start_time" data-date-format="yyyy-mm-dd"
                                                   id="datetimepicker1">

                                        </div>
                                        <div style="padding: 0;" class="form-group col-xs-4">
                                            <label class="search_title_stock"
                                                   for="exampleInputEmail1">结束时间</label>

                                            <input class="search_input_stock form-control"
                                                   type="text"
                                                   value="<?php if(isset($post_data['end_time']) && !empty($post_data['end_time'])){ echo $post_data['end_time']; } ?>"
                                                   name="end_time" data-date-format="yyyy-mm-dd"
                                                   id="datetimepicker2">
                                        </div>
                                        <div style="padding: 0;" class="form-group col-xs-4">
                                            <label class="search_title_stock"
                                                   for="exampleInputEmail1">产品编号</label>
                                            <input type="text" class="search_input_stock form-control"
                                                   id="number" value="<?php if(isset($post_data['number']) && !empty($post_data['number'])){ echo $post_data['number']; } ?>"
                                                   name="number" placeholder="产品编号">
                                        </div>

                                        <div style="padding: 0;" class="form-group col-xs-4">
                                            <label class="search_title_stock"
                                                   for="exampleInputEmail1">产品名称</label>
                                            <input type="text" class="search_input_stock form-control"
                                                   id="name" value="<?php if(isset($post_data['name']) && !empty($post_data['name'])){ echo $post_data['name']; } ?>"
                                                   name="name" placeholder="产品名称">
                                        </div>
                                        <div style="padding: 0;" class="form-group col-xs-4">
                                            <label class="search_title_stock"
                                                   for="exampleInputEmail1">规格分类</label>
                                            <input type="text" class="search_input_stock form-control"
                                                   id="size" value="<?php if(isset($post_data['size']) && !empty($post_data['size'])){ echo $post_data['size']; } ?>" name="size" placeholder="规格">
                                        </div>
                                        <div style="padding: 0;" class="form-group col-xs-4">
                                            <label class="search_title_stock"
                                                   for="exampleInputEmail1">物品分类</label>
                                            <input type="text" class="search_input_stock form-control"
                                                   id="goods_type" value="<?php if(isset($post_data['goods_type']) && !empty($post_data['goods_type'])){ echo $post_data['goods_type']; } ?>" name="goods_type" placeholder="物品分类">
                                        </div>
                                        <div style="padding: 0;" class="form-group col-xs-4">
                                            <label class="search_title_stock"
                                                   for="exampleInputEmail1">单位分类</label>
                                            <input type="text" class="search_input_stock form-control"
                                                   id="company" value="<?php if(isset($post_data['company']) && !empty($post_data['company'])){ echo $post_data['company']; } ?>" name="company" placeholder="单位分类">
                                        </div>

                                        <div style="clear: both"></div>
                                    </div>

                                </div>
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
                                <p>
                                    <?= Html::submitButton(Yii::t('app', '提交'), ['class' => 'btn btn-success']) ?>
                                </p>

                                <div class="alert alert-info" role="alert">
                                    <p>查询条件：</p>
                                    <p>[起始时间：<?php if(isset($post_data['start_time']) && !empty($post_data['start_time'])){ echo $post_data['start_time']; } ?>] - [结束时间：<?php if(isset($post_data['end_time']) && !empty($post_data['end_time'])){ echo $post_data['end_time']; } ?>]</p>
                                    <p> 出库数量：1679</p>
                                    <p>出库次数：1265</p>
                                </div>
                                </form>
                                <?php Pjax::begin(); ?>    <?= GridView::widget([
                                    'dataProvider' => $dataProvider,
                                    'layout' => '{items}{summary}{pager}',
                                    'filterModel' => $searchModel,
                                    'columns' => [
                                        'id',
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
                                            'template' => '{view} {update}{delete}{logs}',
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
                                                'logs' => function ($url, $model) {
                                                    return Html::a(Yii::t('app', '[操作记录]'), $url, [
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
