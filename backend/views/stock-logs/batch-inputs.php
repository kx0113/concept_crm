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
                <p>批量入库</p>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="ibox float-e-margins">

                            <div class="ibox-content">
                                <div  class="">
                                    <button type="button" onclick="submit_form()" class="btn btn-primary">提交</button>
                                </div>
                                <br>
                                <style>
                                    table tr td{text-align: center;}
                                </style>
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <td><input data-id="1" id="checkboxAll" type="checkbox"></td>
                                        <td>ID</td>
                                        <td>产品名称</td>
                                        <td>产品编号</td>
                                        <td>品牌分类</td>
                                        <td>规格分类</td>
                                        <td>物品分类</td>
                                        <td>单位分类</td>
                                        <td>库存剩余量</td>
                                        <td>入库数量</td>
                                        <td>入库时间</td>
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

    function submit_form(){
        var index = layer.load(1, {
            shade: [0.5,'#666'] //0.1透明度的白色背景
        });
        var params={};
        var arr={};
        var length_data=$('input[type=checkbox]:checked').length;
        if(length_data==0){
            layer.close(index);
            layer.alert('请选择产品');
            return false;
        }
        var sub_val;
        $.each($('input:checkbox:checked'),function(){
            var input_data={};
            var stock_id = $(this).attr('data-id');
            var name = $(this).attr('data-name');
            var number = $(this).attr('data-number');
            var total_number = $(this).attr('data-total_number');
            var current_number = $("#current_number_"+stock_id).val();
            var operation_time = $("#operation_time_"+stock_id).val();
            var msg_name="产品名称："+name+"<br>错误提示：";
            if(current_number==''){
                layer.alert(msg_name+'请选择数量');
                sub_val=1;
                layer.close(index);
                return false;
            }else{
                if(current_number < 0){
                    layer.alert(msg_name+'请输入大于0整形数字');
                    sub_val=1;
                    layer.close(index);
                    return false;
                }
            }
            if(operation_time==''){
                layer.alert(msg_name+'请选择时间');
                sub_val=1;
                return false;
            }
            input_data.current_number=current_number;
            input_data.operation_time=operation_time;
            input_data.remark="";
            input_data.stock_id=stock_id;
            input_data.status = 1;
            input_data.is_returns = 1;
            arr[stock_id]=input_data;
        });
        if(sub_val!==1){
            params.list = arr;
            console.log(arr);
            $.post('index.php?r=/stock-logs/add-stock-logs',params,function(res){
                layer.close(index);
                //询问框
                layer.confirm(res.msg+'-是否继续批量入库？', {
                    btn: ['是','否'] //按钮
                }, function(index){
                    layer.close(index);
                    location.reload();
                }, function(index){
                    layer.close(index);
                    location.href="index.php?r=stock/index";
                });
                return false;
            },'json');
        }

    }

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
                    html+='<td width="40"><input name="" id="input_checkbox_'+obj[i].id+'"' +
                        'data-id="'+obj[i].id+'"' +
                        'data-name="'+obj[i].name+'"' +
                        'data-number="'+obj[i].number+'"' +
                        'data-total_number="'+obj[i].total_number+'"' +
                        ' type="checkbox">';
                    html+='<td width="40">'+obj[i].id+'</td>';
                    html+='<td width="200">'+obj[i].name+'</td>';
                    html+='<td width="100">'+obj[i].number+'</td>';
                    html+='<td width="100">'+obj[i].brand+'</td>';
                    html+='<td width="100">'+obj[i].size+'</td>';
                    html+='<td width="100">'+obj[i].goods_type+'</td>';
                    html+='<td width="100">'+obj[i].company+'</td>';
                    html+='<td width="100">'+obj[i].total_number+'</td>';
                    html+='<td width="150"><input class="form-control"' +
                        'id="current_number_'+obj[i].id+'" type="number"></td>';

                    html+='<td width="150"><input class="operation_time search_input_stock form-control"'+
                        'type="text" value="" data-date-format="yyyy-mm-dd"'+
                        'id="operation_time_'+obj[i].id+'"></td>';
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
    $("#checkboxAll").click(function(){
        var id=$(this).attr('data-id');
        if(id==1){
            $(this).attr('data-id',2);
            $("input[type='checkbox']").prop("checked","true");
        }else{
            $(this).attr('data-id',1);
            $("input[type='checkbox']").removeAttr("checked");
        }
    })



</script>