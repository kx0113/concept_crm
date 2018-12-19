<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\Types;

/* @var $this yii\web\View */
/* @var $model common\models\Orders */

$this->title = $orders_info['info']['name'];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Orders'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<script src="js/jquery-1.4.4.min.js"></script>
<script src="js/jquery.jqprint-0.3.js"></script>

<div style="" class="orders-view">
    <div class="wrapper wrapper-content">

        <div class="row">

            <div class="col-sm-12">

            </div>
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>订单信息</h5>
                        <div class="ibox-tools">

                        </div>
                    </div>
                    <div class="ibox-content">
                        <div id="tables_content">
                            <div id="tables_content_print">
                                <style>
                                    table {
                                        border: 1px solid #ccc;
                                    }

                                    table tr td {
                                        text-align: center;
                                        border: 1px solid #ccc;
                                    }

                                    .tabletrtdleft {
                                        text-align: left;
                                    }

                                    .tabletrtdbold {
                                        font-weight: bold;
                                    }
                                </style>
                                <table width="100%" class="table table-bordered">
                                    <tr>
                                        <td class="email_title"
                                            style="text-align: center; font-size: 20px;font-weight: bold;"
                                            colspan="16"> <?= Html::encode('' . $this->title) ?></td>
                                    </tr>
                                    <tr>

                                        <td class="tabletrtdleft tabletrtdbold" width="25%">
                                            客户姓名：<?php if (isset($orders_info['customer_info']['name'])) {
                                                echo $orders_info['customer_info']['name'];
                                            } ?></td>

                                        <td class="tabletrtdleft tabletrtdbold" width="25%">
                                            联系电话：<?php if (isset($orders_info['info']['phone'])) {
                                                echo $orders_info['info']['phone'];
                                            } ?></td>

                                        <td class="tabletrtdleft tabletrtdbold" width="25%">
                                            项目地址：<?php if (isset($orders_info['info']['address'])) {
                                                echo $orders_info['info']['address'];
                                            } ?></td>

                                        <td class="tabletrtdleft tabletrtdbold" width="25%">
                                            合同日期：<?php if (isset($orders_info['info']['start_time'])) {
                                                echo date("Y-m-d", strtotime($orders_info['info']['start_time']));
                                            } ?></td>
                                    </tr>
                                    <tr>
                                        <td class="tabletrtdleft tabletrtdbold" width="25%">
                                            销售款项：<?php if (isset($orders_info['info']['sale_cost'])) {
                                                echo $orders_info['info']['sale_cost'];
                                            } ?></td>

                                        <td class="tabletrtdleft tabletrtdbold" width="25%">
                                            销售利润：<?php echo isset($orders_info['stock_sum']['total_profit_price']) ? $orders_info['stock_sum']['total_profit_price'] : '0.00'; ?></td>

                                        <td class="tabletrtdleft tabletrtdbold" width="25%">
                                            运费：<?php if (isset($orders_info['info']['freight_cost'])) {
                                                echo $orders_info['info']['freight_cost'];
                                            } ?></td>

                                        <td class="tabletrtdleft tabletrtdbold" width="25%">
                                            施工费：<?php if (isset($orders_info['info']['work_cost'])) {
                                                echo $orders_info['info']['work_cost'];
                                            } ?></td>
                                    </tr>
                                    <tr>
                                        <td class="tabletrtdleft tabletrtdbold" width="25%" colspan="1">
                                            成本总价：<?php echo isset($orders_info['stock_sum']['total_purchase_price']) ? $orders_info['stock_sum']['total_purchase_price'] : '0.00'; ?></td>

                                        <td class="tabletrtdleft tabletrtdbold" width="25%" colspan="1">
                                            零售总价：<?php echo isset($orders_info['stock_sum']['total_market_price']) ? $orders_info['stock_sum']['total_market_price'] : '0.00'; ?></td>
                                        <td class="tabletrtdleft tabletrtdbold" width="25%" colspan="1">
                                            其他费用：<?php echo $orders_info['info']['other_cost']; ?></td>
                                        <td class="tabletrtdleft tabletrtdbold" width="25%" colspan="1">
                                            创建时间：<?php echo $orders_info['info']['create_at']; ?></td>
                                    </tr>
                                </table>
                                <br>
                                <table width="100%" class="table table-bordered">
                                    <tr>
                                        <td class="tabletrtdbold" width="50" colspan="1">序号</td>
                                        <td class="tabletrtdbold" width="340" colspan="1">产品名称</td>
                                        <td class="tabletrtdbold" width="100" colspan="1">编号</td>
                                        <td class="tabletrtdbold" width="100" colspan="1">品牌分类</td>
                                        <td class="tabletrtdbold" width="100" colspan="1">规格</td>
                                        <td class="tabletrtdbold" width="50" colspan="1">物品分类</td>
                                        <td class="tabletrtdbold" width="50" colspan="1">单位</td>
                                        <td class="tabletrtdbold" width="80" colspan="1">零售价</td>
                                        <td class="tabletrtdbold" width="80" colspan="1">成本价</td>
                                        <td class="tabletrtdbold" width="80" colspan="1">出库次数</td>
                                        <td class="tabletrtdbold" width="80" colspan="1">实际数量</td>
                                        <td class="tabletrtdbold" width="80" colspan="1">归还数量</td>
                                        <td class="tabletrtdbold" width="80" colspan="1">总用数量</td>
                                        <td class="tabletrtdbold" width="80" colspan="1">零售总价</td>
                                        <td class="tabletrtdbold" width="80" colspan="1">成本总价</td>
                                        <!--                                    <td class="tabletrtdbold" width="80" colspan="1">差价总价</td>-->
                                        <td class="tabletrtdbold print_option" width="100" colspan="1">操作</td>
                                    </tr>
                                    <?php if (isset($orders_info['stock_logs']) && !empty($orders_info['stock_logs'])) {
                                        $num = 1;
                                        foreach ($orders_info['stock_logs'] as $k1 => $v1) { ?>
                                            <tr>
                                                <td colspan="1"><?php echo $num++; ?></td>
                                                <td colspan="1"><?php echo $orders_info['stock_logs'][$k1]['name']; ?></td>
                                                <td colspan="1"><?php echo $orders_info['stock_logs'][$k1]['number']; ?></td>
                                                <td colspan="1"><?php echo Types::getName($orders_info['stock_logs'][$k1]['brand']); ?></td>
                                                <td colspan="1"><?php echo Types::getName($orders_info['stock_logs'][$k1]['size']); ?></td>
                                                <td colspan="1"><?php echo Types::getName($orders_info['stock_logs'][$k1]['goods_type']); ?></td>
                                                <td colspan="1"><?php echo Types::getName($orders_info['stock_logs'][$k1]['company']); ?></td>
                                                <td colspan="1">
                                                    ¥<?php echo $orders_info['stock_logs'][$k1]['market_price']; ?></td>
                                                <td colspan="1">
                                                    ¥<?php echo $orders_info['stock_logs'][$k1]['purchase_price']; ?></td>
                                                <td colspan="1"><?php echo $orders_info['stock_logs'][$k1]['list_count']; ?></td>
                                                <td colspan="1"><?php echo $orders_info['stock_logs'][$k1]['current_number']; ?></td>
                                                <td colspan="1"><?php echo 0; ?></td>
                                                <td colspan="1"><?php echo $orders_info['stock_logs'][$k1]['current_number']; ?></td>
                                                <td colspan="1">
                                                    ¥<?php echo $orders_info['stock_logs'][$k1]['row_market_price']; ?></td>
                                                <td colspan="1">
                                                    ¥<?php echo $orders_info['stock_logs'][$k1]['row_purchase_price']; ?></td>
                                                <!--                                                 <td  colspan="1">¥-->
                                                <?php //echo $orders_info['stock_logs'][$k1]['row_diff_price'];
                                                ?><!--</td>-->
                                                <?php
                                                $customer_id = $orders_info['customer_info']['id'];
                                                $order_id = $orders_info['info']['id'];
                                                $stock_id = $orders_info['stock_logs'][$k1]['id'];
                                                $total_number = $orders_info['stock_logs'][$k1]['current_number'];
                                                ?>
                                                <td class="print_option" colspan="1">
                                                    <a href="#">[出库]</a>
                                                    <a onclick='StockReturn("<?= $customer_id; ?>","<?= $order_id; ?>","<?= $stock_id; ?>","<?= $total_number; ?>")'>[归还]</a>
                                                </td>
                                            </tr>
                                        <?php }
                                    } ?>

                                </table>
                            </div>
                            <!--endprint-->
                        </div>
                        <div style="float: right">
                            <button type="button" onclick="sendEmail()" class="btn btn-warning">发送Email</button>
                            <button type="button" onclick="batchReturn()" class="btn btn-primary">批量归还</button>
                            <button type="button" onclick="batchOut()" class="btn btn-success">批量出库</button>
                            <button type="button" onclick="OutExcel()" class="btn btn-info">导出Excel</button>
                            <button type="button" onclick="OutPdf()" class="btn btn-info">导出pdf</button>
                            <button type="button" onclick="doPrint()" class="btn btn-danger">打印订单</button>
                        </div>
                        <div style="clear: both;"></div>
                        <div style="display: none;">
                            <div id="stock_return">
                                <br>

                                    <div style="padding: 0;" class="form-group col-xs-offset-3 col-xs-6">
                                        <label class="search_title_stock"
                                               for="exampleInputEmail1">数量</label>
                                        <input type="email" class="search_input_stock form-control"
                                               id="current_number" placeholder="数量">
                                    </div>
                                    <div style="padding: 0;" class="form-group col-xs-offset-3 col-xs-6">
                                        <label class="search_title_stock"
                                               for="operation_time">时间</label>

                                        <input class="operation_time search_input_stock form-control"
                                               type="text" value="" data-date-format="yyyy-mm-dd"
                                               id="operation_time">
                                    </div>
                                <div style="clear: both"></div>
                                <div style="padding: 0;" class="form-group col-xs-offset-3 col-xs-6">
                                    <button type="button"  class="btn btn-primary">提交</button>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>


            </div>

        </div>
        <script>

            function StockReturn(customer_id, order_id, stock_id, total_number) {
                layer.open({
                    type: 2,
                    title: 'HAHHA',
                    closeBtn: 0, //不显示关闭按钮
                    shade: [0],
                    area: ['893px', '600px'],
                    anim: 2,
                    shadeClose: true,
                    content: ['index.php?r=stock-logs/returns'], //iframe的url，no代表不显示滚动条
                    end: function(){ //此处用于演示
                        layer.alert('msg');
                    }
                });
            }
            function batchOut() {
                layer.confirm('确定要批量出库?', {
                    title: '提示',
                    btn: ['确定', '取消'] //按钮
                }, function (index) {
                    layer.close(index);
                    layer.alert('批量出库开发中...');
                }, function (index) {
                    layer.close(index);
                });
            }
            function batchReturn() {
                layer.confirm('确定要批量归还?', {
                    title: '提示',
                    btn: ['确定', '取消'] //按钮
                }, function (index) {
                    layer.close(index);
                    layer.alert('批量归还开发中...');
                }, function (index) {
                    layer.close(index);
                });

            }
            function OutPdf() {
                layer.confirm('确定要导出pdf?', {
                    title: '提示',
                    btn: ['确定', '取消'] //按钮
                }, function (index) {
                    layer.close(index);
                    layer.alert('导出pdf开发中...');
                }, function (index) {
                    layer.close(index);
                });

            }
            function OutExcel() {
                var url = "index.php?r=stock/out-excel&id=<?php echo $orders_info['info']['id']; ?>&name=<?php echo $orders_info['info']['name']; ?>";
                layer.confirm('确定要导出Excel?', {
                    title: '提示',
                    btn: ['确定', '取消'] //按钮
                }, function (index) {
                    layer.close(index);
                    location.href = url;
                }, function (index) {
                    layer.close(index);
                });
            }
            function sendEmail() {
                layer.confirm('确定要发送该订单信息到指定邮箱?', {
                    title: '提示',
                    btn: ['确定', '取消'] //按钮
                }, function (index) {
                    layer.close(index);
                    $(".print_option").hide();
                    var html = $("#tables_content").html();
                    var email_title = $(".email_title").html();
                    $.post('index.php?r=/stock/send-mail', {"html": html, "email_title": email_title}, function (res) {
                        layer.alert(res.msg);
                    }, 'json');
                    $(".print_option").show();
                }, function (index) {
                    layer.close(index);
                });
            }

            function doPrint() {
                layer.confirm('确定要打印订单?', {
                    title: '提示',
                    btn: ['确定', '取消'] //按钮
                }, function (index) {
                    layer.close(index);
                    $(".print_option").hide();
                    $("#tables_content_print").jqprint();
                    $(".print_option").show();
                }, function (index) {
                    layer.close(index);
                });

            }
        </script>