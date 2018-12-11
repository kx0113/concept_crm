<?php
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

require(__DIR__ . '/../../vendor/autoload.php');
require(__DIR__ . '/../../vendor/yiisoft/yii2/Yii.php');
require(__DIR__ . '/../../common/config/bootstrap.php');
require(__DIR__ . '/../config/bootstrap.php');

$config = yii\helpers\ArrayHelper::merge(
    require(__DIR__ . '/../../common/config/main.php'),
    require(__DIR__ . '/../../common/config/main-local.php'),
    require(__DIR__ . '/../config/main.php'),
    require(__DIR__ . '/../config/main-local.php')
);
use mdm\admin\models\User;
use frontend\models\Customer;
use frontend\models\CustomerCollect;
use frontend\models\CustomerFollow;
use frontend\models\Order;
use frontend\models\Sole;

$application = new yii\web\Application($config);

$sole_info = Sole::find()->where(['sole_name'=>'timed_task'])->asArray()->One();
$state = $sole_info['sole_state'];

if ($state == 1) {
    $connection = Yii::$app->db;
	$where = "user_id > 0";
	$customer_list = Customer::find()->where($where)->asArray()->all();
	$time_now = time();
	foreach ($customer_list as $key => $value) {
		//是否有跟进记录
	    $row[$value['customer_id']] = $customer_follow = CustomerFollow::find()->where(['customer_id' => $value['customer_id']])->OrderBy('submit_time desc')->asArray()->One();
	} 

	//七天没有跟进记录自动扔回公海
	if (!empty($row)) {
	    foreach ($row as $key => $value) {
	        $collect_list = CustomerCollect::find()->where(['customer_id'=>$key,'status'=>0])->orderBy('time desc')->asArray()->One();
	        
	        //从未添加跟进
	      	if (empty($value)) {
		        //最后一次采集时间距当前时间有7天
		      	
		        if(!empty($collect_list) && (round(($time_now-(strtotime(date("Y-m-d",$collect_list['time']))+86400))/86400))>=7){
		        	  $user_id = $collect_list['user_id'];
			          $sql="UPDATE wo_customer SET user_id = 0 WHERE customer_id =".$key;
			          $sql_insert="insert into wo_customer_collect
			           (user_id,customer_id,transfer_note,time,status)VALUES
			           ($user_id,'".$key."','客户跟进记录超过7天未填写，系统自动扔回','".$time_now."',1)";
			          $command = $connection->createcommand($sql);
			          $command->query();
			          $command_insert = $connection->createcommand($sql_insert);
			          $command_insert->query();
		        }else{
		            //内部新增加的客户，无跟进记录，根据客户录入时间计算；
		            $where2 = "user_id > 0 and customer_id=".$key;
		            $customer_list = Customer::find()->where($where2)->asArray()->all();
		            $user_id = $customer_list[0]['user_id'];
		            $time = strtotime(date("Y-m-d",$customer_list[0]['time']))+86400;
		            if(empty($collect_list) && (round(($time_now-$time)/86400))>=7){
		            $sql="UPDATE wo_customer SET user_id = 0 WHERE customer_id =".$key;
		            $sql_insert="insert into wo_customer_collect
			           (user_id,customer_id,transfer_note,time,status)VALUES
			           ($user_id,'".$key."','客户跟进记录超过7天未填写，系统自动扔回','".$time_now."',1)";
		          	$command = $connection->createcommand($sql);
		          	$command->query();
		          	$command_insert = $connection->createcommand($sql_insert);
		          	$command_insert->query();
		            }
		        }

	      	}else{
	      	    //之前有跟进，最后一次采集后无跟进&&当前时间距采集时间有7天
	            if($value['submit_time']<$collect_list['time']&&(round(($time_now-(strtotime(date("Y-m-d",$collect_list['time']))+86400))/86400))>=7){
	            	$user_id = $collect_list['user_id'];
	                $sql="UPDATE wo_customer SET user_id = 0 WHERE customer_id =".$key;
	                $sql_insert="insert into wo_customer_collect
			           (user_id,customer_id,transfer_note,time,status)VALUES
			           ($user_id,'".$key."','客户跟进记录超过7天未填写，系统自动扔回','".$time_now."',1)";
	                $command = $connection->createcommand($sql);
	                $command->query();
	                $command_insert = $connection->createcommand($sql_insert);
	                $command_insert->query();
	            }
	            //采集后有跟进&&最后跟进时间距当前时间有7天
	            if($value['submit_time']>$collect_list['time']&&(round(($time_now-(strtotime(date("Y-m-d",$value['submit_time']))+86400))/86400))>=7){
	               // exit("33333");
	            	$user_id = $collect_list['user_id'];
	                $sql="UPDATE wo_customer SET user_id = 0 WHERE customer_id =".$key;
	                $sql_insert="insert into wo_customer_collect
			           (user_id,customer_id,transfer_note,time,status)VALUES
			           ($user_id,'".$key."','客户跟进记录超过7天未填写，系统自动扔回','".$time_now."',1)";
	                $command = $connection->createcommand($sql);
	                $command->query();
	                $command_insert = $connection->createcommand($sql_insert);
	                $command_insert->query();
	            }
	        }
	    }
	}
	//一个月没有合作自动扔回公海
	$customer_list = Customer::find()->where($where)->asArray()->all();
	if (!empty($customer_list) && is_array($customer_list)) {
		 foreach ($customer_list as $key => $value) {
		 	  $order_list = Order::find()->where(['customer_id'=>$value['customer_id']])->asArray()->all();
		 	  $collect_list = CustomerCollect::find()->where(['customer_id'=>$value['customer_id'],'status'=>0])->orderBy('time desc')->asArray()->One();
		 	  if (empty($collect_list)) {
		 	  	  $time_month = strtotime(date("Y-m-d",$value['time']))+86400;
		 	  }else{
		 	  	  $time_month = strtotime(date("Y-m-d",$collect_list['time']))+86400;
		 	  }
		 	  if (empty($order_list)  && (round(($time_now-$time_month)/86400))>=30) {
		 	  	    $user_id = $value['user_id'];
		 	  	  	$sql="UPDATE wo_customer SET user_id = 0 WHERE customer_id =".$value['customer_id'];
		            $sql_insert="insert into wo_customer_collect
			           (user_id,customer_id,transfer_note,time,status)VALUES
			           ($user_id,'".$value['customer_id']."','客户超过30天为成单，系统自动扔回','".$time_now."',1)";
		          	$command = $connection->createcommand($sql);
		          	$command->query();
		          	$command_insert = $connection->createcommand($sql_insert);
		          	$command_insert->query();
		 	  }
		 }
	}
	echo  date("Y-m-d H:i:s",time())."执行此文件 \n";
}else{
	echo  date("Y-m-d H:i:s",time())."定时任务暂未开启 \n";
}


//$application->run();
