<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Orders */

$this->title = $orders_info['info']['name'];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Orders'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orders-view">
        <div class="wrapper wrapper-content">
            <div class="alert alert-info"> <?= Html::encode('订单：' . $this->title) ?></div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>订单基础信息</h5>
                            <div class="ibox-tools">

                            </div>
                        </div>
                        <div class="ibox-content">
                            <p>名称：<?php if(isset($orders_info['info']['name'])){ echo $orders_info['info']['name']; }?></p>
                            <p>地址：<?php if(isset($orders_info['info']['address'])){ echo $orders_info['info']['address']; }?></p>
                            <p>合同开始日期：<?php if(isset($orders_info['info']['start_time'])){ echo date("Y-m-d",strtotime($orders_info['info']['start_time'])); }?></p>
                            <p>合同结束日期：<?php if(isset($orders_info['info']['end_time'])){ echo date("Y-m-d",strtotime($orders_info['info']['end_time'])); }?></p>
                            <p>联系电话：<?php if(isset($orders_info['info']['phone'])){ echo $orders_info['info']['phone']; }?></p>
                            <p>施工费用：<?php if(isset($orders_info['info']['work_cost'])){ echo $orders_info['info']['work_cost']; }?></p>
                            <p>运费：<?php if(isset($orders_info['info']['freight_cost'])){ echo $orders_info['info']['freight_cost']; }?></p>
                            <p>备注：<?php if(isset($orders_info['info']['remark'])){ echo $orders_info['info']['remark']; }?></p>
                            <p>状态：<?php if(isset($orders_info['info']['status'])){ echo \common\models\Orders::get_status($orders_info['info']['status']); }?></p>
                            <p>公司名称：<?php if(isset($orders_info['info']['token'])){ echo \common\models\Web::GetWebName($orders_info['info']['token']); }?></p>
                            <p>创建用户：<?php if(isset($orders_info['info']['add_user'])){ echo  \common\models\User::get_username($orders_info['info']['add_user']); }?></p>
                            <p>更新时间：<?php if(isset($orders_info['info']['update_at'])){ echo $orders_info['info']['update_at']; }?></p>
                            <p>创建时间：<?php if(isset($orders_info['info']['create_at'])){ echo $orders_info['info']['create_at']; }?></p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>客户基础信息</h5>
                            <div class="ibox-tools">

                            </div>
                        </div>
                        <div class="ibox-content">
                            <p>名称：<?php if(isset($orders_info['customer_info']['name'])){ echo $orders_info['customer_info']['name']; }?></p>
                            <p>电话：<?php if(isset($orders_info['customer_info']['phone'])){ echo $orders_info['customer_info']['phone']; }?></p>
                            <p>地址：<?php if(isset($orders_info['customer_info']['address'])){ echo $orders_info['customer_info']['address']; }?></p>
                            <p>客户类型：<?php if(isset($orders_info['customer_info']['customer_type'])){ echo \common\models\Types::getName($orders_info['customer_info']['customer_type']); }?></p>
                            <p>客户来源：<?php if(isset($orders_info['customer_info']['source_type'])){ echo \common\models\Types::getName($orders_info['customer_info']['source_type']); }?></p>
                            <p>客户状态：<?php if(isset($orders_info['customer_info']['status'])){ echo \common\models\Types::getName($orders_info['customer_info']['status']); }?></p>
                            <p>备注：<?php if(isset($orders_info['customer_info']['remark'])){ echo $orders_info['customer_info']['remark']; }?></p>
                            <p>公司名称：<?php if(isset($orders_info['customer_info']['token'])){ echo \common\models\Web::GetWebName($orders_info['customer_info']['token']); }?></p>
                            <p>创建用户：<?php if(isset($orders_info['customer_info']['add_user'])){ echo \common\models\User::get_username($orders_info['customer_info']['add_user']); }?></p>
                            <p>更新时间：<?php if(isset($orders_info['customer_info']['update_at'])){ echo $orders_info['customer_info']['update_at']; }?></p>
                            <p>创建时间：<?php if(isset($orders_info['customer_info']['create_at'])){ echo $orders_info['customer_info']['create_at']; }?></p>
                            <br>
                            <br>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>出入库信息</h5>
                            <div class="ibox-tools">

                            </div>
                        </div>
                        <div class="ibox-content">

                            <p>公司名称：123456</p>
                            <p>创建用户：123456</p>
                            <p>更新时间：123456</p>
                            <p>创建时间：123456</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>

</div>
