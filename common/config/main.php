<?php
return [
//    Yii::$app->commons->project($id,$this->session_web_id)
    'timeZone' => 'Asia/Shanghai',
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'upload'=>[
            'class'=>'common\components\Upload'
        ],
        'CommonClass'=>[
            'class'=>'common\components\BaseModel'
        ],
        'Helper'=>[
            'class'=>'common\components\Helper'
        ],
        'Common'=>[
            'class'=>'common\components\Common'
        ],
    ],
];
