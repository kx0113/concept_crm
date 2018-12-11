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

$this->title = Yii::t('app', '出库归还');
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
                                               for="exampleInputEmail1">是否归还</label>
                                        <select  class="form-control" name="" id="">
                                            <option value="">否</option>
                                            <option value="">是</option>
                                        </select>
                                    </div>
                                    <div style="padding: 0;" class="form-group col-xs-offset-3 col-xs-6">
                                        <label class="search_title_stock"
                                               for="exampleInputEmail1">归还时间</label>

                                        <input class="search_input_stock form-control"
                                               type="text" value="2018-10-09" data-date-format="yyyy-mm-dd"
                                               id="datetimepicker">

                                    </div>
                                    <div style="padding: 0;" class="form-group col-xs-offset-3 col-xs-6">
                                        <label class="search_title_stock"
                                               for="exampleInputEmail1">备注</label>
                                        <textarea placeholder="备注" rows="5" id="purpose" name="purpose"
                                                  class="search_input_stock form-control col-xs-10 col-sm-5"></textarea>

                                    </div>

                                    <div style="clear: both"></div>
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
