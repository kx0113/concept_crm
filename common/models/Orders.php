<?php

namespace common\models;

use Yii;

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
 * @property string $remark
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
            [['name','start_time','end_time','customer_id','phone','address'], 'required'],
            [['customer_id', 'status', 'token', 'add_user'], 'integer'],
            [['start_time', 'end_time', 'update_at', 'create_at'], 'safe'],
            [['work_cost', 'freight_cost'], 'number'],
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
            'address' => Yii::t('app', '地址'),
            'customer_id' => Yii::t('app', '客户'),
            'start_time' => Yii::t('app', '开始时间'),
            'end_time' => Yii::t('app', '结束时间'),
            'phone' => Yii::t('app', '联系电话'),
            'work_cost' => Yii::t('app', '施工费用'),
            'freight_cost' => Yii::t('app', '运费'),
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
}
