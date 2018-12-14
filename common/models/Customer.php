<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "kx_customer".
 *
 * @property string $id
 * @property string $name
 * @property string $phone
 * @property string $address
 * @property string $remark
 * @property integer $customer_type
 * @property integer $source_type
 * @property integer $token
 * @property integer $add_user
 * @property integer $status
 * @property string $update_at
 * @property string $create_at
 */
class Customer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%customer}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name','phone','customer_type','source_type','status','address'], 'required'],
            [['customer_type', 'source_type', 'token', 'add_user', 'status'], 'integer'],
            [['update_at', 'create_at'], 'safe'],
            [['remark'], 'string'],
            [['name'], 'string', 'max' => 50],
            [['phone'], 'string', 'max' => 11],
            [['phone'], 'string', 'min' => 8],
            [['address'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '姓名',
            'phone' => '电话',
            'address' => '地址',
            'customer_type' => '客户类型',
            'source_type' => '客户来源',
            'remark' => '备注',
            'token' => '公司名称',
            'add_user' => '创建用户',
            'status' => '客户状态',
            'update_at' => '更新时间',
            'create_at' => '创建时间',
        ];
    }
    public static function getLists($where=[])
    {
        return Customer::find()->where($where)->asArray()->all();
    }
    public static function get_name($id){
        $res=Customer::find()->where(['id'=>$id])->asArray()->one();
        return $res['name'];
    }
}
