<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
$this->title = 'My Yii Application';
?>
<div class="wrapper wrapper-content">
    <div class="row">
        <?php if(\Yii::$app->user->can('/site/index')){?> <!--判断是否有‘/site/index’权限，有则显示，无则隐藏-->

        <?php } ?>

    </div>

    <div class="row">
        <div class="col-md-12">

                <div class="panel panel-primary">
                    <div class="panel-heading">
                        网站快捷查看
                    </div>
<!--                    href="http://--><?php //echo $wv['weburl']; ?><!--"-->
                    <div class="panel-body">
                        <?php foreach($web_list as $wk=>$wv){?>
                            <a
                                onclick="web_post_session('<?php echo $wv['id']; ?>')"
                               class="   <?php if($wv['id'] == $web_session_id){ ?>
                              btn btn-danger btn-rounded
                               <?php }else{ ?>
                               btn btn-danger btn-rounded btn-outline
                                <?php } ?>"
                              target="_blank" data-id="<?php echo $wv['id'];?>">
                                <?php echo $wv['name'];?>
                                <?php if($wv['id'] == $web_session_id){ ?>
                                    (当前)
                                <?php }?>
                            </a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        <div class="col-md-12">
            <div class="ibox-content">

                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>用户名</th>
                            <th>登录IP</th>
                            <th>登录时间</th>
                            <th>备注</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($log as $vo):?>
                            <tr>
                                <td><?=$vo['id']?></td>
                                <td><?=$vo['username']?></td>
                                <td><?=$vo['ip']?></td>
                                <td><?= date('Y-m-d H:i:s',$vo['create_time'])?></td>
                                <td><?=$vo['data']?></td>
                            </tr>
                        <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function web_post_session(id){
//    var id=$(this).attr('data-id');
    var par={};
    par.id=id;
    $.post('index.php?r=/web/ajax-web-session',par,function(data){
    if(data.msg=='1'){
    location.reload();
    }
    },'json');
    }
</script>