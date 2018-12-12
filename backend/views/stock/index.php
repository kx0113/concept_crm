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
                                <form name="test" method="get" action="index.php?StockSearch">
                                    <div>
                                        <div>
                                            <link
                                                href="components/bootstrap-datetimepicker-master/css/bootstrap-datetimepicker.css"
                                                media="all" rel="stylesheet" type="text/css"/>
                                            <script
                                                src="components/bootstrap-datetimepicker-master/js/bootstrap-datetimepicker.js"
                                                type="text/javascript"></script>
                                            <div style="padding: 0;" class="form-group col-xs-4">
                                                <label class="search_title_stock"
                                                       for="exampleInputEmail1">开始时间</label>

                                                <input class="search_input_stock form-control"
                                                       type="text"
                                                       value="<?php if (isset($post_data['start_time']) && !empty($post_data['start_time'])) {
                                                           echo $post_data['start_time'];
                                                       } ?>"
                                                       name="StockSearch[start_time]" data-date-format="yyyy-mm-dd"
                                                       id="datetimepicker1">

                                            </div>
                                            <div style="padding: 0;" class="form-group col-xs-4">
                                                <label class="search_title_stock"
                                                       for="exampleInputEmail1">结束时间</label>

                                                <input class="search_input_stock form-control"
                                                       type="text"
                                                       value="<?php if (isset($post_data['end_time']) && !empty($post_data['end_time'])) {
                                                           echo $post_data['end_time'];
                                                       } ?>"
                                                       name="StockSearch[end_time]" data-date-format="yyyy-mm-dd"
                                                       id="datetimepicker2">
                                            </div>
                                            <div style="padding: 0;" class="form-group col-xs-4">
                                                <label class="search_title_stock"
                                                       for="exampleInputEmail1">产品编号</label>
                                                <input type="text" class="search_input_stock form-control"
                                                       id="number"
                                                       value="<?php if (isset($post_data['number']) && !empty($post_data['number'])) {
                                                           echo $post_data['number'];
                                                       } ?>"
                                                       name="StockSearch[number]" placeholder="产品编号">
                                            </div>

                                            <div style="padding: 0;" class="form-group col-xs-4">
                                                <label class="search_title_stock"
                                                       for="exampleInputEmail1">产品名称</label>
                                                <input type="text" class="search_input_stock form-control"
                                                       id="name"
                                                       value="<?php if (isset($post_data['name']) && !empty($post_data['name'])) {
                                                           echo $post_data['name'];
                                                       } ?>"
                                                       name="StockSearch[name]" placeholder="产品名称">
                                            </div>
                                            <div style="padding: 0;" class="form-group col-xs-4">
                                                <label class="search_title_stock"
                                                       for="exampleInputEmail1">规格分类</label>
                                                <select name="StockSearch[size]" class="search_input_stock form-control"
                                                        id="">
                                                    <option value="">请选择</option>
                                                    <?php foreach (Types::types_list(['keys' => 1001]) as $k1 => $v1) { ?>
                                                        <option
                                                            <?php if (isset($post_data['size']) && $post_data['size']==$k1) {
                                                                echo 'selected = "selected"';
                                                            } ?>
                                                            value="<?php echo $k1; ?>"><?php echo $v1; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div style="padding: 0;" class="form-group col-xs-4">
                                                <label class="search_title_stock"
                                                       for="brand">品牌分类</label>
                                                <select name="StockSearch[brand]"
                                                        class="search_input_stock form-control" id="brand">
                                                    <option value="">请选择</option>
                                                    <?php foreach (Types::types_list(['keys' => 1010]) as $k122 => $v122) { ?>
                                                        <option
                                                            <?php if (isset($post_data['brand']) && $post_data['brand']==$k122) {
                                                                echo 'selected = "selected"';
                                                            } ?>
                                                            value="<?php echo $k122; ?>"><?php echo $v122; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div style="padding: 0;" class="form-group col-xs-4">
                                                <label class="search_title_stock"
                                                       for="goods_type">物品分类</label>
                                                <select name="StockSearch[goods_type]"
                                                        class="search_input_stock form-control" id="">
                                                    <option value="">请选择</option>
                                                    <?php foreach (Types::types_list(['keys' => 1002]) as $k2 => $v2) { ?>
                                                        <option
                                                            <?php if (isset($post_data['goods_type']) && $post_data['goods_type']==$k2) {
                                                                echo 'selected = "selected"';
                                                            } ?>
                                                            value="<?php echo $k2; ?>"><?php echo $v2; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div style="padding: 0;" class="form-group col-xs-4">
                                                <label class="search_title_stock"
                                                       for="exampleInputEmail1">单位分类</label>
                                                <select name="StockSearch[company]"
                                                        class="search_input_stock form-control" id="">
                                                    <option value="">请选择</option>
                                                    <?php foreach (Types::types_list(['keys' => 1003]) as $k21 => $v21) { ?>
                                                        <option
                                                            <?php if (isset($post_data['company']) && $post_data['company']==$k21) {
                                                                echo 'selected = "selected"';
                                                            } ?>
                                                            value="<?php echo $k21; ?>"><?php echo $v21; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <input type="hidden" name="r" value="stock/index">
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
                                        <p>
                                            [起始时间：<?php if (isset($post_data['start_time']) && !empty($post_data['start_time'])) {
                                                echo $post_data['start_time'];
                                            } ?>] -
                                            [结束时间：<?php if (isset($post_data['end_time']) && !empty($post_data['end_time'])) {
                                                echo $post_data['end_time'];
                                            } ?>]</p>
                                        <p> 出库数量：1679</p>
                                        <p>出库次数：1265</p>
                                    </div>
                                </form>
                                <?php Pjax::begin(); ?>    <?= GridView::widget([
                                    'dataProvider' => $dataProvider,
                                    'layout' => '{items}{summary}{pager}',
//                                    'filterModel' => $searchModel,
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
