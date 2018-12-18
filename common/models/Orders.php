<?php

namespace common\models;

use Yii;
use common\models\StockLogs;
use common\models\Customer;
use common\models\Stock;

/**
 * This is the model class for table "kx_orders".
 *
 * @property string $id
 * @property string $name
 * @property string $address
 * @property integer $customer_id
 * @property string $start_time
 * @property string $end_time
 * @property string $phone
 * @property double $work_cost
 * @property double $freight_cost
 * @property double $other_cost
 * @property double $sale_cost
 * @property string $remark
 * @property integer $orders_type
 * @property integer $status
 * @property integer $token
 * @property integer $add_user
 * @property string $update_at
 * @property string $create_at
 */
class Orders extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'kx_orders';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name','orders_type','sale_cost','start_time','end_time','customer_id','phone','address'], 'required'],
            [['orders_type','customer_id', 'status', 'token', 'add_user'], 'integer'],
            [['start_time', 'end_time', 'update_at', 'create_at'], 'safe'],
            [['work_cost', 'freight_cost','other_cost','sale_cost',], 'number'],
            [['name', 'address', 'remark'], 'string', 'max' => 255],
            [['phone'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', '名称'),
            'orders_type' => Yii::t('app', '订单类型'),
            'address' => Yii::t('app', '地址'),
            'sale_cost' => Yii::t('app', '销售款项'),
            'customer_id' => Yii::t('app', '客户'),
            'start_time' => Yii::t('app', '开始时间'),
            'end_time' => Yii::t('app', '结束时间'),
            'phone' => Yii::t('app', '联系电话'),
            'work_cost' => Yii::t('app', '施工费用'),
            'freight_cost' => Yii::t('app', '运费'),
            'other_cost' => Yii::t('app', '其他费用'),
            'remark' => Yii::t('app', '备注'),
            'status' => Yii::t('app', '状态'),
            'token' => Yii::t('app', '公司名称'),
            'add_user' => Yii::t('app', '创建用户'),
            'update_at' => Yii::t('app', '更新时间'),
            'create_at' => Yii::t('app', '创建时间'),
        ];
    }

    /**
     * @inheritdoc
     * @return OrdersQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new OrdersQuery(get_called_class());
    }
    public static function get_status($data){
        if($data==1){
            return '正在进行中';
        }elseif($data==2){
            return '已结束';
        }else{
            return '';
        }
    }
    public static function findOrderOne($id){
        $res=Orders::find()->where(['id'=>$id])
            ->andWhere(['token'=>Yii::$app->session->get('web_id')])
            ->asArray()->one();
        return $res;
    }
    public static function findCustomerOrderList($customer_id){
        $res=Orders::find()->where(['customer_id'=>$customer_id])
            ->andWhere(['token'=>Yii::$app->session->get('web_id')])
            ->asArray()->all();
        return $res;
    }
    public static function orders_view($id){
        $arr=[];
        $orders=self::findOrderOne($id);
//        echo json_encode($orders);exit;

        $log_stock_id=[];
        $log_stock_arr=[];
        $log_stock_data=[];
        if(isset($orders['customer_id']) && !empty($orders['customer_id'])){
            $where['customer_id']=$orders['customer_id'];
            $where['orders_id']=$orders['id'];
            $where['status']=2;
            $get_customer_list=StockLogs::get_customer_list($where);
//            var_dump(count($get_customer_list));exit;
            //提取stock_id
            $log_stock_id=Yii::$app->Helper->arrayGivenField($get_customer_list,'stock_id');
            //去除重复不要key
            $log_stock_id=Yii::$app->Helper->arrayUniqueDefaultKey($log_stock_id);
//            var_dump(count($log_stock_id));exit;
            if(!empty($get_customer_list)){
                foreach($get_customer_list as $k=>$v){
                    if(in_array($v['stock_id'],$log_stock_id)){
                        $log_stock_arr[$v['stock_id']]['list'][]=$v;
                    }
                }
            }
            $total_purchase_price=0;
            $total_market_price=0;
            $total_data_count=0;
            $total_diff_price=0;
            if(!empty($log_stock_id)){
                foreach($log_stock_id as $k3=>$v3){
                    $log_stock_arr[$v3]['list_count']=count($log_stock_arr[$v3]['list']);
                }
            }
            if(!empty($log_stock_arr)){
                foreach($log_stock_arr as $k1=>$v1){
                    $stock_info=Stock::get_stock_one($k1);
                    $current_number=0;
                    foreach($v1['list'] as $k4=>$v4){
                        //计算当前出库产品总出库量
                        $current_number=bcadd($current_number,$v4['current_number'],0);
                    }
                    foreach($stock_info as $k6=>$v6){
                        $log_stock_arr[$k1][$k6]=$v6;
                    }
                    $row_purchase_price=bcmul($stock_info['purchase_price'],$current_number,2);;
                    $row_market_price=bcmul($stock_info['market_price'],$current_number,2);;
                    $log_stock_arr[$k1]['current_number']=$current_number;
                    $log_stock_arr[$k1]['row_purchase_price']=$row_purchase_price;
                    $log_stock_arr[$k1]['row_market_price']=$row_market_price;
                    $log_stock_arr[$k1]['row_diff_price']=bcsub($row_market_price,$row_purchase_price,2);
                }

                foreach($log_stock_arr as $k21=>$v21){
                    #进货价
                    $total_purchase_price=bcadd($total_purchase_price,$v21['row_purchase_price'],2);
                    #市场价
                    $total_market_price=bcadd($total_market_price,$v21['row_market_price'],2);
                    #差价总价
                    $total_diff_price=bcadd($total_diff_price,$v21['row_diff_price'],2);
                    #总条数
                    $total_data_count=bcadd($total_data_count,$v21['list_count'],0);
                }

            }
//            利润=销售款项-运费-施工费-成本总价-其它费用
            $arr['stock_logs']=$log_stock_arr;
            $arr['stock_sum']['total_purchase_price']=$total_purchase_price;
            $arr['stock_sum']['total_market_price']=$total_market_price;
            $arr['stock_sum']['total_diff_price']=$total_diff_price;
            $arr['stock_sum']['total_data_count']=$total_data_count;
//            echo json_encode($log_stock_arr);exit;
            $arr['customer_info']=Customer::get_customer_info($orders['customer_id']);
        }
        $arr['info']=$orders;
        return $arr;
    }
}
