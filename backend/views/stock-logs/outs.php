<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use common\models\Types;
use common\models\User;
use common\models\Web;
use common\models\Customer;

/* @var $this yii\web\View */
/* @var $searchModel common\models\StockSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', '产品出库');
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
                                     <br>
                                    <?= $this->render('stock_common', [
                                        'stock_id'=>$stock_id,
                                        'orders_id'=>$orders_id,
                                        'customer_id'=>$customer_id,
                                    ]) ?>

                                    <div style="padding: 0;" class="form-group col-xs-offset-3 col-xs-6">
                                        <label class="search_title_stock"
                                               for="customer_id">出库客户</label>
                                        <select onchange="findCustomerOrderList()" class="form-control" name="" id="customer_id">
                                            <option value="">-- 请选择 --</option>
                                            <?php foreach(Customer::getLists() as $k=>$v){ ?>
                                                <option <?php if($customer_id==$v['id']){ echo 'selected = "selected"'; } ?>
                                                    value="<?php echo $v['id']; ?>"><?php echo $v['name']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div style="padding: 0;" class="form-group col-xs-offset-3 col-xs-6">
                                        <label class="search_title_stock"
                                               for="orders_id">出库订单</label>
                                        <select class="form-control" name="" id="orders_id">
                                            <option value="">-- 请选择 --</option>

                                        </select>
                                    </div>
                                    <div style="padding: 0;" class="form-group col-xs-offset-3 col-xs-6">
                                        <label class="search_title_stock"
                                               for="exampleInputEmail1">出库数量</label>
                                        <input type="number" class="search_input_stock form-control"
                                               id="current_number" placeholder="出库数量">
                                    </div>
                                    <div style="padding: 0;" class="form-group col-xs-offset-3 col-xs-6">
                                        <label class="search_title_stock"
                                               for="purpose_id">出库用途</label>
                                        <select  class="form-control" name="" id="purpose_id">
                                            <?php foreach(Types::types_list(['keys'=>1009]) as $k=>$v){ ?>
                                            <option value="<?php echo $k; ?>"><?php echo $v; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <div style="padding: 0;" class="form-group col-xs-offset-3 col-xs-6">
                                        <label class="search_title_stock"
                                               for="operation_time">出库时间</label>

                                        <input class="search_input_stock form-control"
                                               type="text" value="" data-date-format="yyyy-mm-dd"
                                               id="operation_time">

                                    </div>
                                    <div style="padding: 0;" class="form-group col-xs-offset-3 col-xs-6">
                                        <label class="search_title_stock"
                                               for="exampleInputEmail1">备注</label>
                                        <textarea placeholder="备注" rows="6" id="remark" name="remark"
                                                  class="search_input_stock form-control col-xs-10 col-sm-5"></textarea>
                                    </div>
                                    <div style="clear: both"></div>
                                    <div style="padding: 0;" class="form-group col-xs-offset-3 col-xs-6">
                                        <button type="button" onclick="submit_form()" class="btn btn-primary">提交</button>

                                    </div>
                                </div>

                                <script>
                                    if(typeof default_customer_id == "undefined" || default_customer_id == null || default_customer_id == "" || default_customer_id==0){
                                        $("#customer_id").attr("disabled",true);
                                        $("#orders_id").attr("disabled",true);
                                    }else{
                                        $("#customer_id").attr("disabled",true);
                                        findCustomerOrderList();
                                    }
                                    $("#orders_id").attr("disabled",true);
                                    //产品未选择客户下拉菜单不启用
                                    $("#pro_name").change(function(){
                                        $("#customer_id").attr("disabled",true);
                                        $("#orders_id").attr("disabled",true);
                                        var stock_id=$("#pro_name").val();
                                        console.log(stock_id);
                                        if(typeof stock_id == "undefined" || stock_id == null || stock_id == "" || stock_id==0){
                                            $("#customer_id").attr("disabled",true);
                                            $("#orders_id").attr("disabled",true);
                                            $("#orders_id").html('<option value="">-</option>');
                                        }else{
                                            $("#customer_id").attr("disabled",false);
                                        }
                                    });
                                    //通过客户id查询订单信息
                                    function findCustomerOrderList(){
                                        $("#orders_id").attr("disabled",true);
                                        $("#orders_id").html(' <option value="">-- 请选择 --</option>');
                                        var customer_id=$("#customer_id").val();
                                        var params={};
                                        params.customer_id=customer_id;
                                        $.post('index.php?r=/stock/customer-order-list',params,function(res){
                                            var obj=res.data;
                                            var html='<option value="">-- 请选择 --</option>';
                                            var objs = $.isEmptyObject(obj);
                                            var selected;
                                            console.log(objs);
                                            if(objs==false){
                                                for(var i=0;i<obj.length;i++){
                                                    if(typeof default_orders_id == "undefined" || default_orders_id == null || default_orders_id == "" || default_orders_id==0){

                                                    }else{
                                                        if(default_orders_id==obj[i]['id']){
                                                            selected=' selected = "selected" ';
                                                        }
                                                    }

                                                    html+="<option "+selected+" value='"+obj[i]['id']+"'>"+obj[i]['name']+"</option>";
                                                }
                                                if(typeof default_orders_id == "undefined" || default_orders_id == null || default_orders_id == "" || default_orders_id==0){
                                                    $("#orders_id").attr("disabled",false);
                                                }else{
                                                    $("#orders_id").attr("disabled",true);
                                                }
                                                $("#orders_id").html(html);
                                            }
                                        },'json');
                                    }
                                    //提交
                                    function submit_form() {
                                        var params={};
                                        var stock_id=$("#pro_name").val();
                                        var pro_total_number=$("#pro_total_number").val();
                                        var current_number=$("#current_number").val();
                                        var customer_id=$("#customer_id").val();
                                        var purpose_id=$("#purpose_id").val();
                                        var operation_time=$("#operation_time").val();
                                        var orders_id=$("#orders_id").val();
                                        params.current_number =current_number;
                                        params.operation_time = operation_time;
                                        params.remark = $("#remark").val();
                                        params.stock_id = stock_id;
                                        params.orders_id = orders_id;
                                        params.customer_id = customer_id;
                                        params.purpose_id = purpose_id;
                                        params.status = 2;
//                                        console.log(pro_total_number);
//                                        console.log(pro_total_number-current_number);
                                        if(stock_id=='' || stock_id==0){
                                            layer.alert('请选择产品');
                                            return false;
                                        }
                                        if(current_number==''){
                                            layer.alert('请选择数量');
                                            return false;
                                        }else{
                                            if(current_number < 0){
                                                layer.alert('请输入大于0整形数字');
                                                return false;
                                            }
                                        }
                                        if(purpose_id==''){
//                                            layer.alert('请选择用途');
//                                            return false;
                                        }
                                        if(customer_id==''){
                                            layer.alert('请选择客户');
                                            return false;
                                        }
                                        if(orders_id==''){
                                            layer.alert('请选择订单');
                                            return false;
                                        }
                                        if(operation_time==''){
                                            layer.alert('请选择时间');
                                            return false;
                                        }
                                        var num=pro_total_number-current_number;
//                                        console.log(params);
                                        if(num >= 0){

                                        }else{
                                            layer.alert('库存不足');
                                            return false;
                                        }
//                                        return false;
                                        $.post('index.php?r=/stock-logs/add-stock-logs',params,function(res){
                                            var index = parent.layer.getFrameIndex(window.name); //获取当前窗体索引
                                            layer.alert(res.msg);
                                            setTimeout(function(){
                                                if(typeof default_stock_id == "undefined" || default_stock_id == null || default_stock_id == "" || default_stock_id==0){
                                                    location.href="index.php?r=stock/index";
                                                }else{
                                                    parent.layer.close(index); //执行关闭
                                                    parent.location.reload();
                                                }
                                            }, 3000);
                                            return false;
                                        },'json');

                                    }
                                    $('#operation_time').datetimepicker({
                                        autoclose: true,
                                        format: 'yyyy-mm-dd',
                                        todayBtn: true,
                                        minView: "month",
                                        language: 'zh-CN',
                                        pickerPosition: "bottom-left",
                                    });
                                    $('#operation_time').val(getNowFormatDate());
                                    console.log(getNowFormatDate());
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
