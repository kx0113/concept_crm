<link rel="stylesheet" href="static/select2-develop/dist/css/select2.min.css"/>
<script type="text/javascript" src="static/select2-develop/dist/js/select2.full.min.js"></script>
<div style="padding: 0;" class="form-group col-xs-offset-3 col-xs-6">
    <label class="search_title_stock"
           for="exampleInputEmail1">产品名称</label>
    <select style="padding:10px 0;" class="js-example-basic-single2  js-states form-control" name="pro_name" id="pro_name">

    </select>

</div>

<div style="padding: 0;" class="form-group col-xs-offset-3 col-xs-6">
    <label class="search_title_stock"
           for="exampleInputEmail1">产品编号</label>
    <input disabled="disabled" type="text"
           class="search_input_stock form-control"
           id="pro_num" placeholder="-">
</div>
<div style="padding: 0;" class="form-group col-xs-offset-3 col-xs-6">
    <label class="search_title_stock"
           for="exampleInputEmail1">品牌分类</label>
    <input disabled="disabled" type="text"
           class="search_input_stock form-control"
           id="pro_brand" placeholder="-">
</div>

<div style="padding: 0;" class="form-group col-xs-offset-3 col-xs-6">
    <label class="search_title_stock"
           for="exampleInputEmail1">规格分类</label>
    <input disabled="disabled" type="text"
           class="search_input_stock form-control"
           id="pro_size" placeholder="-">
</div>
<div style="padding: 0;" class="form-group col-xs-offset-3 col-xs-6">
    <label class="search_title_stock"
           for="exampleInputEmail1">物品分类</label>
    <input disabled="disabled" type="text"
           class="search_input_stock form-control"
           id="pro_goods_type" placeholder="-">
</div>
<div style="padding: 0;" class="form-group col-xs-offset-3 col-xs-6">
    <label class="search_title_stock"
           for="exampleInputEmail1">单位分类</label>
    <input disabled="disabled" type="text"
           class="search_input_stock form-control"
           id="pro_company" placeholder="-">
</div>
<div style="padding: 0;" class="form-group col-xs-offset-3 col-xs-6">
    <label class="search_title_stock"
           for="exampleInputEmail1">库存剩余量</label>
    <input disabled="disabled" type="text"
           class="search_input_stock form-control"
           id="pro_total_number" placeholder="-">
</div>
<input type="hidden" id="stock_info_ajax_data" />
<script>
    var default_stock_id="<?php if(isset($stock_id) && !empty($stock_id)){ echo $stock_id; }else{ echo ""; } ?>";
    var default_orders_id="<?php if(isset($orders_id) && !empty($orders_id)){ echo $orders_id; }else{ echo ""; } ?>";
    var default_customer_id="<?php if(isset($customer_id) && !empty($customer_id)){ echo $customer_id; }else{ echo ""; } ?>";

    $(".js-example-basic-single2").select2({
        placeholder: "- 请选择 -",
        allowClear: true,
        closeOnSelect:true
    });
    ajax_load();
    //默认加载所有产品信息
    function ajax_load(){
        var index = layer.load(1, {
            shade: [0.5,'#666'] //0.1透明度的白色背景
        });
         $("#pro_name").attr('disabled',true);
        $.post('index.php?r=/stock/get-stock-info','',function(res){
            console.log(res);
            if(res.code==200){
                var product_number='<option data-id="" value="0">- 请选择 -</option>';
                var obj=res.data;
                for(var i=0;i<obj.length;i++){
                    var selected='';
                    //快捷操作
                    if(default_stock_id==obj[i].id){
                        selected=' selected = "selected" ';
                        $("#pro_num").val(obj[i].number);
                        $("#pro_size").val(obj[i].size);
                        $("#pro_goods_type").val(obj[i].goods_type);
                        $("#pro_company").val(obj[i].company);
                        $("#pro_total_number").val(obj[i].total_number);
                        $("#pro_brand").val(obj[i].brand);
                    }
                    product_number+='<option '+selected+'  data-id=\''+JSON.stringify(obj[i])
                        +'\' value="'+obj[i].id+'">'+obj[i].name+'-'+obj[i].number+'</option>';
                }
                $("#pro_name").html(product_number);
                if(typeof default_stock_id == "undefined" || default_stock_id == null || default_stock_id == ""){
                    $("#pro_name").attr('disabled',false);
                }else{
                    $("#pro_name").attr('disabled',true);
                }
                layer.close(index);
            }
        },'json');
    }
    //选择产品填充产品信息
    $("#pro_name").change(function(){
        var selected= $('#pro_name option:selected').attr('data-id');
        if(selected!==''){
            var obj=JSON.parse(selected);
//            console.log(obj.number);
            $("#pro_num").val(obj.number);
            $("#pro_size").val(obj.size);
            $("#pro_goods_type").val(obj.goods_type);
            $("#pro_company").val(obj.company);
            $("#pro_total_number").val(obj.total_number);
            $("#pro_brand").val(obj.brand);
        }

    });
</script>