<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "kx_types".
 *
 * @property integer $id
 * @property string $name
 * @property integer $keys
 * @property integer $parent
 * @property string $info
 * @property string $add_time
 * @property integer $add_user
 * @property integer $token
 */
class Types extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%types}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['keys'],'required',],
            ['parent', 'default', 'value' => 0],
            [['keys', 'parent', 'add_user', 'token'], 'integer'],
            [['add_time'], 'safe'],
            [['name', 'info'], 'string', 'max' => 255],
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
            'keys' => Yii::t('app', '分类'),
            'parent' => Yii::t('app', '父类'),
            'info' => Yii::t('app', '描述'),
            'add_time' => Yii::t('app', '创建时间'),
            'add_user' => Yii::t('app', '创建用户'),
            'token' => Yii::t('app', '公司名称'),
        ];
    }
    public static function types_list($where){
        $arr=[];
        $res= Types::find()->where($where)->andWhere(['token'=>Yii::$app->session->get('web_id')])->asArray()->all();
        $arr['']='-- 请选择 --';
        foreach ($res as $k=>$v){
            $arr[$v['id']]=$v['name'];
        }
        return $arr;
    }
    public static function getName($id){
        $res=Types::find()->where(['id'=>$id])->andWhere(['token'=>Yii::$app->session->get('web_id')])->asArray()->one();
        if(!empty($res)){
            return $res['name'];
        }
        return '';
    }
}
