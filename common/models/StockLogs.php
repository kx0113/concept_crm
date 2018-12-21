<?php

namespace common\models;

use Yii;
use common\models\Stock;
/**
 * This is the model class for table "kx_stock_logs".
 *
 * @property string  $id
 * @property integer $orders_id
 * @property integer $stock_id
 * @property integer $total_number
 * @property integer $current_number
 * @property integer $customer_id
 * @property integer $before_number
 * @property integer $purpose_id
 * @property string  $operation_time
 * @property integer $status
 * @property integer $is_returns
 * @property string  $remark
 * @property integer $token
 * @property integer $add_user
 * @property string  $update_at
 * @property string  $create_at
 */
class StockLogs extends \yii\db\ActiveRecord
{
    const IS_RETURNS_1=1;
    const IS_RETURNS_2=2;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%stock_logs}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['orders_id','token','stock_id', 'before_number','total_number','is_returns',
                'current_number', 'customer_id', 'purpose_id', 'status', 'add_user'], 'integer'],
            [['operation_time', 'update_at', 'create_at'], 'safe'],
            [['remark'], 'string', 'max' => 500],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'orders_id' => Yii::t('app', '订单名称'),
            'stock_id' => Yii::t('app', '产品名称'),
            'total_number' => Yii::t('app', '操作后总数'),
            'current_number' => Yii::t('app', '当前操作数量'),
            'customer_id' => Yii::t('app', '客户'),
            'before_number' => Yii::t('app', '操作前数量'),
            'purpose_id' => Yii::t('app', '用途分类'),
            'operation_time' => Yii::t('app', '操作时间'),
            'is_returns' => Yii::t('app', '是否归还'),
            'status' => Yii::t('app', '操作'),
            'remark' => Yii::t('app', '备注'),
            'token' => Yii::t('app', '公司名称'),
            'add_user' => Yii::t('app', '操作用户'),
            'update_at' => Yii::t('app', '更新时间'),
            'create_at' => Yii::t('app', '创建时间'),
        ];
    }
//      `is_returns` tinyint(1) DEFAULT '1' COMMENT '是否归还1=未归还2=未归还',
    public static function get_is_returns_name($data){
        if($data==1){
            return '未归还';
        }elseif($data==2){
            return '已归还';
        }
    }
    public static function getDropDownListStatus()
    {
        $arr=[''=>'-- 请选择 --','1'=>'入库','2'=>'出库'];
        return $arr;
    }
    public static function getDropDownListIsReturns()
    {
        $arr=[''=>'-- 请选择 --','1'=>'未归还','2'=>'已归还'];
        return $arr;
    }
    public static function get_status_name($data){
        if($data==1){
            return '入库';
        }elseif($data==2){
            return '出库';
        }
    }

    public static function StockLogOptionHandler($v){
        $model=new StockLogs();
        $number_action='';
        //客户id
        $customer_id = (isset($v['customer_id']) && !empty($v['customer_id'])) ? $v['customer_id'] : 0;
        //订单id
        $orders_id =(isset($v['orders_id']) && !empty($v['orders_id'])) ? $v['orders_id'] : 0;
//        return $orders_id;
        //当前操作数量
        $current_number =(isset($v['current_number']) && !empty($v['current_number'])) ? $v['current_number'] : "";
        //操作时间（自定义）
        $operation_time =(isset($v['operation_time']) && !empty($v['operation_time'])) ? $v['operation_time'] : date('Y-m-d');
        //备注
        $remark =(isset($v['remark']) && !empty($v['operation_time'])) ? $v['remark'] : "";
        //stock表主键id
        $stock_id =(isset($v['stock_id']) && !empty($v['stock_id'])) ? $v['stock_id'] : "";
        //用途分类
        $purpose_id =(isset($v['purpose_id']) && !empty($v['purpose_id'])) ? $v['purpose_id'] : 0;
        //1=入库2=出库
        $status =(isset($v['status']) && !empty($v['status'])) ? $v['status'] : "";
        //是否归还1=未归还2=已归还
        $is_returns =(isset($v['is_returns']) && !empty($v['is_returns'])) ? $v['is_returns'] : 1;

        if(empty($current_number)){
            return [0,'请选择数量',[]];
        }else{
            if($current_number < 0){
                return [0,'数量不能小于0',[]];
            }
        }
        if(empty($stock_id) || $stock_id==0){
            return [0,'请选择产品',[]];
        }
        if(empty($operation_time)){
            return [0,'请选择时间',[]];
        }
        //入库操作
        if($status==1 && $is_returns==1){
            $number_action='plus';
        }
        if($status==2 || $is_returns==2){
            if(empty($customer_id)){
                return [0,'客户id不能为空',[]];
            }
            if(empty($orders_id) || $orders_id==0){
                return [0,'订单不能为空',[]];
            }
            //出库操作
            if($status==2 && $is_returns==1){
                $number_action='reduce';
            }
            //归还操作
            if($status==1 && $is_returns==2){
                $number_action='plus';
            }
        }
        if(empty($number_action)){
            return [0,'操作参数错误',[]];
        }
        $model->before_number=Stock::get_total_number($stock_id);
        $update_total_number=Stock::update_total_number($stock_id,$current_number,$number_action);
        $model->is_returns=$is_returns;
        $model->customer_id=$customer_id;
        $model->purpose_id=$purpose_id;
        $model->orders_id=$orders_id;
        $model->status=$status;
        $model->remark=$remark;
        $model->operation_time=$operation_time;
        $model->current_number=$current_number;
        $model->total_number=Stock::get_total_number($stock_id);
        $model->token=Yii::$app->session->get('web_id');
        $model->add_user=yii::$app->user->identity->id;
        $model->stock_id=$stock_id;
        $model->create_at=date("Y-m-d H:i:s");
        $model->update_at=date("Y-m-d H:i:s");
        if($update_total_number===true){
            $res=$model->save();
            if($res){
                return [1,Stock::get_stock_name($stock_id).'-操作成功',[]];
            }else{
                return [0,Stock::get_stock_name($stock_id).'-操作失败',[]];
            }
        }elseif($update_total_number=='insufficient'){
            return [0,'数量不足',[]];
        }
        return [0,'操作失败',[]];
    }
    public static function get_customer_list($where){
        $res= StockLogs::find()->where($where)
            ->andWhere(['token'=>Yii::$app->session->get('web_id')])
            ->asArray()->all();
        return $res;
    }

}
