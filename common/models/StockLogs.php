<?php

namespace common\models;

use Yii;

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

    public static function get_customer_list($where){
        $res= StockLogs::find()->where($where)
            ->andWhere(['token'=>Yii::$app->session->get('web_id')])
            ->asArray()->all();
        return $res;
    }

}
