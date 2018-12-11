<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "kx_stock_logs".
 *
 * @property string $id
 * @property integer $stock_id
 * @property integer $total_number
 * @property integer $current_number
 * @property integer $customer_id
 * @property integer $purpose_id
 * @property string $operation_time
 * @property integer $status
 * @property string $remark
 * @property integer $token
 * @property integer $add_user
 * @property string $update_at
 * @property string $create_at
 */
class StockLogs extends \yii\db\ActiveRecord
{
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
            [['token','stock_id', 'total_number', 'current_number', 'customer_id', 'purpose_id', 'status', 'add_user'], 'integer'],
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
            'stock_id' => Yii::t('app', 'Stock ID'),
            'total_number' => Yii::t('app', 'Total Number'),
            'current_number' => Yii::t('app', 'Current Number'),
            'customer_id' => Yii::t('app', 'Customer ID'),
            'purpose_id' => Yii::t('app', 'Purpose ID'),
            'operation_time' => Yii::t('app', 'Operation Time'),
            'status' => Yii::t('app', 'Status'),
            'remark' => Yii::t('app', 'Remark'),
            'token' => Yii::t('app', 'token'),
            'add_user' => Yii::t('app', 'Add User'),
            'update_at' => Yii::t('app', 'Update At'),
            'create_at' => Yii::t('app', 'Create At'),
        ];
    }

}
