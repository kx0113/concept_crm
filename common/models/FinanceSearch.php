<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Finance;

/**
 * FinanceSearch represents the model behind the search form about `common\models\Finance`.
 */
class FinanceSearch extends Finance
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'total_number', 'current_number', 'before_number', 'account_type', 'status', 'account_category', 'add_user', 'token'], 'integer'],
            [['operation_time', 'name', 'account_card', 'content', 'remark', 'ext1', 'ext2', 'update_at', 'create_at'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
//        $query = Finance::find();
        $query = Finance::find()->where(['token'=>Yii::$app->session->get('web_id')])->orderBy('id desc');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'total_number' => $this->total_number,
            'current_number' => $this->current_number,
            'before_number' => $this->before_number,
            'account_type' => $this->account_type,
            'status' => $this->status,
            'account_category' => $this->account_category,
            'operation_time' => $this->operation_time,
//            'add_user' => $this->add_user,
//            'token' => $this->token,
//            'update_at' => $this->update_at,
//            'create_at' => $this->create_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'account_card', $this->account_card])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'remark', $this->remark])
            ->andFilterWhere(['like', 'ext1', $this->ext1])
            ->andFilterWhere(['like', 'ext2', $this->ext2]);

        return $dataProvider;
    }
}
