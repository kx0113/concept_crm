<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use common\models\Types;
use common\models\User;
use common\models\Web;
use common\models\Customer;


/* @var $this yii\web\View */
/* @var $model common\models\StockLogs */


?>
<div class="stock-logs-view">

<div class="wrapper wrapper-content">
<div class="ibox float-e-margins">
<div class="ibox-content">
<p>批量出库</p>

<div class="row">
<div class="col-sm-12">
<div class="ibox float-e-margins">
<div class="ibox-content">

    <div  class="form-group col-xs-4">
        <label class="search_title_stock"
               for="customer_id">出库客户</label>
        <select onchange="findCustomerOrderList()" class="form-control" name="" id="customer_id">
            <option value="">-- 请选择 --</option>
            <?php foreach(Customer::getLists() as $k=>$v){ ?>
                <option
                        value="<?php echo $v['id']; ?>"><?php echo $v['name']; ?></option>
            <?php } ?>
        </select>
    </div>
    <div  class="form-group  col-xs-4">
        <label class="search_title_stock"
               for="orders_id">出库订单</label>
        <select class="form-control" name="" id="orders_id">
            <option value="">-- 请选择 --</option>

        </select>
    </div>
    <div style="padding: 0;" class="form-group col-xs-4">
        <label class="search_title_stock"
               for="operation_time">出库时间</label>

        <input class="search_input_stock form-control"
               type="text" value="" data-date-format="yyyy-mm-dd"
               id="operation_time">

    </div>
    <br>
    <style>
        table tr td{text-align: center;}
    </style>
    <table class="table table-bordered">
        <thead>
        <tr>
            <td>ID</td>
            <td>产品名称</td>
            <td>产品编号</td>
            <td>品牌分类</td>
            <td>规格分类</td>
            <td>物品分类</td>
            <td>单位分类</td>
            <td>库存剩余量</td>
            <td>出库数量</td>
            <td>出库用途</td>
            <td>出库时间</td>
            <td>操作</td>
        </tr>
        </thead>
        <tbody id="tables_list"></tbody>
    </table>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<script>
    $('#operation_time').datetimepicker({
        autoclose: true,
        format: 'yyyy-mm-dd',
        todayBtn: true,
        minView: "month",
        language: 'zh-CN',
        pickerPosition: "bottom-left",
    });
    $('#operation_time').val(getNowFormatDate());
    ajax_load();
    //默认加载所有产品信息
    function ajax_load(){
        var index = layer.load(1, {
            shade: [0.5,'#666'] //0.1透明度的白色背景
        });
        $("#tables_list").html("");
        $("#tables_list").attr('disabled',true);
        $.post('index.php?r=/stock/get-stock-info','',function(res){
            console.log(res);
            if(res.code==200){
                var html;
                var obj=res.data;
                for(var i=0;i<obj.length;i++){
                    html+="<tr>";
                    html+='<td width="40">'+obj[i].id+'</td>';
                    html+='<td width="100">'+obj[i].name+'</td>';
                    html+='<td  width="100">'+obj[i].number+'</td>';
                    html+='<td  width="100">'+obj[i].brand+'</td>';
                    html+='<td  width="100">'+obj[i].size+'</td>';
                    html+='<td  width="100">'+obj[i].goods_type+'</td>';
                    html+='<td  width="100">'+obj[i].company+'</td>';
                    html+='<td  width="100">'+obj[i].total_number+'</td>';
                    html+='<td width="150"><input class="form-control" type="number"></td>';
                    html+='<td  width="150"><select  class="form-control" name="" id="purpose_id">'+
                        '<?php foreach(Types::types_list(['keys'=>1009]) as $k=>$v){ ?>'+
                        '<option value="<?php echo $k; ?>"><?php echo $v; ?></option>'+
                        '<?php } ?></select></td>';
                    html+='<td ><input class="operation_time search_input_stock form-control"'+
                           'type="text" value="" data-date-format="yyyy-mm-dd"'+
                           'id=""></td>';
                    html+='<td  width="100">[操作]</td>';
                    html+="</tr>";

                }
                $("#tables_list").html(html);
                $('.operation_time').datetimepicker({
                    autoclose: true,
                    format: 'yyyy-mm-dd',
                    todayBtn: true,
                    minView: "month",
                    language: 'zh-CN',
                    pickerPosition: "bottom-left",
                });
                $('.operation_time').val(getNowFormatDate());

                layer.close(index);
            }
        },'json');
    }
    //通过客户id查询订单信息
    function findCustomerOrderList(){
        $("#current_number").attr("disabled",true);
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
                $("#current_number").attr("disabled",false);
                $("#orders_id").html(html);
            }
        },'json');
    }

</script>