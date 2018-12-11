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

$this->title = Yii::t('app', '产品入库');
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


                                <div>
                                    <link href="components/bootstrap-datetimepicker-master/css/bootstrap-datetimepicker.css"
                                          media="all" rel="stylesheet" type="text/css"/>
                                    <script src="components/bootstrap-datetimepicker-master/js/bootstrap-datetimepicker.js"
                                            type="text/javascript"></script>


                                    <br>
                                    <?= $this->render('stock_common', []) ?>
                                    <div style="padding: 0;" class="form-group col-xs-offset-3 col-xs-6">
                                        <label class="search_title_stock"
                                               for="exampleInputEmail1">入库数量</label>
                                        <input type="email" class="search_input_stock form-control"
                                               id="current_number" placeholder="入库数量">
                                    </div>
                                    <div style="padding: 0;" class="form-group col-xs-offset-3 col-xs-6">
                                        <label class="search_title_stock"
                                               for="operation_time">入库时间</label>

                                        <input class="search_input_stock form-control"
                                               type="text" value="2018-10-09" data-date-format="yyyy-mm-dd"
                                               id="operation_time">

                                    </div>
                                    <div style="padding: 0;" class="form-group col-xs-offset-3 col-xs-6">
                                        <label class="search_title_stock"
                                               for="exampleInputEmail1">备注</label>
                                        <textarea placeholder="备注" rows="5" id="remark" name="remark"
                                                  class="search_input_stock form-control col-xs-10 col-sm-5"></textarea>

                                    </div>
                                    <div style="padding: 0;" class="form-group col-xs-offset-3 col-xs-6">
                                        <button type="button" onclick="submit_form()" class="btn btn-primary">提交</button>

                                    </div>
                                    <div style="clear: both"></div>
                                </div>

                                <script>
                                    function submit_form() {
                                        var params={};
                                        var stock_id=$("#pro_name").val();
                                        var current_number=$("#current_number").val();
                                        var operation_time=$("#operation_time").val();
                                        params.current_number =current_number;
                                        params.operation_time = operation_time;
                                        params.remark = $("#remark").val();
                                        params.stock_id = stock_id;
                                        params.status = 1;
                                        console.log(params);
                                        if(stock_id=='' || stock_id==0){
                                            alert('请选择产品');
                                            return false;
                                        }
                                        if(current_number==''){
                                            alert('请选择数量');
                                            return false;
                                        }
                                        if(operation_time==''){
                                            alert('请选择时间');
                                            return false;
                                        }
                                        $.post('index.php?r=/stock-logs/add-stock-logs',params,function(res){
                                            alert(res.msg);
                                            location.reload();
                                            return false;
                                        },'json');

                                    }


                                    $('#operation_time').datetimepicker({
                                        autoclose: true,
                                        format: 'yyyy-mm-dd',
                                        todayBtn: false,
                                        showMeridian: false,
                                        language: 'zh-CN',
                                        pickerPosition: "bottom-left",
                                    });


                                </script>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>