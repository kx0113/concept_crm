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
<div class="orders-view">
        <div class="wrapper wrapper-content">

            <div class="row">
                <style>
                    table tr td {text-align: center;}
                    .tabletrtdleft{text-align: left;}
                    .tabletrtdbold{font-weight: bold;}
                </style>
                <div class="col-sm-12">

                </div>
                <div class="col-sm-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>订单信息</h5>
                            <div class="ibox-tools">

                            </div>
                        </div>
<!--                        编号	产品名称	总数量	进货价	市场价	品牌分类	规格	物品分类	单位-->
                        <div class="ibox-content">
                            <table class="table table-bordered">
                                <tr>
                                    <td style="text-align: center; font-size: 20px;font-weight: bold;"  colspan="16"> <?= Html::encode('' . $this->title) ?></td>
                                </tr>
                                <tr>

                                    <td class="tabletrtdleft tabletrtdbold" colspan="8">客户姓名：<?php if(isset($orders_info['customer_info']['name'])){ echo $orders_info['customer_info']['name']; }?></td>
                                    <td class="tabletrtdleft tabletrtdbold"  colspan="8">联系电话：<?php if(isset($orders_info['customer_info']['phone'])){ echo $orders_info['customer_info']['phone']; }?></td>
                                </tr>
                                <tr>
                                    <td class="tabletrtdleft tabletrtdbold"  colspan="8">项目地址：<?php if(isset($orders_info['customer_info']['address'])){ echo $orders_info['customer_info']['address']; }?></td>
                                    <td class="tabletrtdleft tabletrtdbold"  colspan="8">合同日期：<?php if(isset($orders_info['info']['start_time'])){ echo date("Y-m-d",strtotime($orders_info['info']['start_time'])); }?></td>
                                </tr>
                                <tr>
                                    <td class="tabletrtdleft tabletrtdbold"  colspan="8">销售款项：</td>
                                    <td class="tabletrtdleft tabletrtdbold"  colspan="8">销售利润：</td>
                                </tr>
                                <tr>
                                    <td class="tabletrtdleft tabletrtdbold"  colspan="8">运费：<?php if(isset($orders_info['info']['freight_cost'])){ echo $orders_info['info']['freight_cost']; }?></td>
                                    <td class="tabletrtdleft tabletrtdbold"  colspan="8">施工费：<?php if(isset($orders_info['info']['work_cost'])){ echo $orders_info['info']['work_cost']; }?></td>
                                </tr>
                                <tr>
                                    <td class="tabletrtdleft tabletrtdbold"  colspan="8">成本总价：<?php echo $orders_info['stock_sum']['total_purchase_price']; ?></td>
                                    <td class="tabletrtdleft tabletrtdbold"  colspan="8">市场总价：<?php echo $orders_info['stock_sum']['total_market_price']; ?></td>
                                </tr>
                                <tr>
                                    <td class="tabletrtdbold" width="50" colspan="1">序号</td>
                                    <td class="tabletrtdbold" width="150 colspan="1">产品名称</td>
                                    <td class="tabletrtdbold" width="100" colspan="1">编号</td>
                                    <td class="tabletrtdbold" width="100" colspan="1">品牌分类</td>
                                    <td class="tabletrtdbold" width="100" colspan="1">规格</td>
                                    <td class="tabletrtdbold" width="100" colspan="1">物品分类</td>
                                    <td class="tabletrtdbold" width="100" colspan="1">单位</td>
                                    <td class="tabletrtdbold" width="100" colspan="1">零售价</td>
                                    <td class="tabletrtdbold" width="100" colspan="1">成本价</td>
                                    <td class="tabletrtdbold" width="100" colspan="1">实际数量</td>
                                    <td class="tabletrtdbold" width="100" colspan="1">归还数量</td>
                                    <td class="tabletrtdbold" width="100" colspan="1">总用数量</td>
                                    <td class="tabletrtdbold" width="100" colspan="1">零售总价</td>
                                    <td class="tabletrtdbold" width="100" colspan="1">成本总价</td>
                                    <td class="tabletrtdbold" width="100" colspan="1">差价总价</td>
                                    <td class="tabletrtdbold" width="100" colspan="1">操作</td>

                                </tr>
                                <?php if(isset($orders_info['stock_logs']) && !empty($orders_info['stock_logs'])){
                                        $num=1;
                                         foreach ($orders_info['stock_logs'] as $k1=>$v1){ ?>
                                             <tr>
                                                 <td  colspan="1"><?php echo $num++; ?></td>
                                                 <td  colspan="1"><?php echo $orders_info['stock_logs'][$k1]['name']; ?></td>
                                                 <td  colspan="1"><?php echo $orders_info['stock_logs'][$k1]['number']; ?></td>
                                                 <td  colspan="1"><?php echo Types::getName($orders_info['stock_logs'][$k1]['brand']); ?></td>
                                                 <td  colspan="1"><?php echo Types::getName($orders_info['stock_logs'][$k1]['size']); ?></td>
                                                 <td  colspan="1"><?php echo Types::getName($orders_info['stock_logs'][$k1]['goods_type']); ?></td>
                                                 <td  colspan="1"><?php echo Types::getName($orders_info['stock_logs'][$k1]['company']); ?></td>
                                                 <td  colspan="1">¥<?php echo $orders_info['stock_logs'][$k1]['market_price']; ?></td>
                                                 <td  colspan="1">¥<?php echo $orders_info['stock_logs'][$k1]['purchase_price']; ?></td>
                                                 <td  colspan="1"><?php echo $orders_info['stock_logs'][$k1]['current_number']; ?></td>
                                                 <td  colspan="1"><?php echo 0; ?></td>
                                                 <td  colspan="1"><?php echo $orders_info['stock_logs'][$k1]['current_number']; ?></td>
                                                 <td  colspan="1">¥<?php echo $orders_info['stock_logs'][$k1]['row_market_price']; ?></td>
                                                 <td  colspan="1">¥<?php echo $orders_info['stock_logs'][$k1]['row_purchase_price']; ?></td>
                                                 <td  colspan="1">¥<?php echo bcsub($orders_info['stock_logs'][$k1]['row_market_price'],$orders_info['stock_logs'][$k1]['row_purchase_price'],2); ?></td>
<!--                                                 <td  rowspan="--><?php //echo $orders_info['stock_sum']['total_data_count']; ?><!--">-->
<!--                                                     --><?php //echo $orders_info['stock_sum']['total_purchase_price']; ?>
<!--                                                 </td>-->
                                                 <td  colspan="1"><a href="#">[出库]</a><a href="#">[归还]</a></td>

                                             </tr>
                                <?php  }} ?>

                            </table>
                            <div style="float: right">
                                <button type="button" class="btn btn-warning">发送Email</button>
                                <button type="button" class="btn btn-primary">批量归还</button>
                                <button type="button" class="btn btn-success">批量出库</button>
                                <button type="button" class="btn btn-info">导出Excel</button>
                                <button type="button" class="btn btn-info">导出pdf</button>
                                <button type="button" class="btn btn-danger">打印订单</button>
                            </div>
                            <div style="clear: both;"></div>
                        </div>
                    </div>
                </div>


        </div>

</div>
