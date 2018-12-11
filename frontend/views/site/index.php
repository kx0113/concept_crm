<script>
    function msg_sub() {
        var name =  $("#name").val();
        var iphone =  $("#iphone").val();
        var msg =  $("#msg").val();
//            if(name=='' || name==undefined){
//                alert('姓名不能为空！');
//                $("#name").focus();
//                return false;
//            }
//            if(iphone=='' || iphone==undefined){
//                alert('电话不能为空！');
//                $("#iphone").focus();
//                return false;
//            }
//            if(msg=='' || msg==undefined){
//                alert('信息不能为空！');
//                $("#msg").focus();
//                return false;
//            }
        var data={};
        data.name=1;
        data.iphone=2;
        data.msg=3;
        $.post("index.php?r=site/index",data,function (res) {
            if(res.code=='1'){
                alert('操作成功！');
                return false;
            }else{
                alert('操作失败！');
                return false;
            }
        },'json');
    }
    msg_sub();
</script>