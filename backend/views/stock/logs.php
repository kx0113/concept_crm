<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Stock */

$this->title = Yii::t('app', '出库记录： ', [
        'modelClass' => 'Stock',
    ]) . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Stocks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="stock-update">

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
                                    <?= Html::a(Yii::t('app', '搜索'), ['logs'], ['class' => 'btn btn-success']) ?>
                                </p>
                                <div class="alert alert-info" role="alert">
                                    <p>查询条件：</p>
                                    <p>[起始时间：2010-09-23] - [结束时间：2018-10-10]</p>
                                    <p> 出库数量：1679</p>
                                    <p>出库次数：1265</p>
                                </div>
                                <table class="table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <td>产品名称</td>
                                        <td>操作后总数</td>
                                        <td>当前操作数量</td>
                                        <td>操作前数量</td>
                                        <td>客户</td>
                                        <td>用途</td>
                                        <td>是否归还</td>
                                        <td>操作</td>
                                        <td>操作用户</td>
                                        <td>操作时间</td>
                                        <td>创建时间</td>
                                    </tr>
                                    </thead>
                                    <hbody>
                                        <?php foreach($stock_logs as $k=>$v){ ?>
                                        <tr>
                                            <td><?= $v['stock_id'] ?></td>
                                            <td><?= $v['total_number'] ?></td>
                                            <td><?= $v['current_number'] ?></td>
                                            <td><?= $v['before_number'] ?></td>
                                            <td><?= $v['customer_id'] ?></td>
                                            <td><?= $v['purpose_id'] ?></td>
                                            <td><?= $v['is_returns'] ?></td>
                                            <td><?= $v['status'] ?></td>
                                            <td><?= $v['add_user'] ?></td>
                                            <td><?= $v['operation_time'] ?></td>
                                            <td><?= $v['create_at'] ?></td>
                                        </tr>
                                        <?php } ?>
                                    </hbody>

                                </table>
<!--                              --><?php //var_dump($stock_logs); ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
