<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Types;

/**
 * TypesSearch represents the model behind the search form about `common\models\Types`.
 */
class TypesSearch extends Types
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'keys', 'parent', 'add_user', 'token'], 'integer'],
            [['name', 'info', 'add_time'], 'safe'],
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
        $query = Types::find()->where(['token'=>Yii::$app->session->get('web_id')]);
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
            'keys' => $this->keys,
            'parent' => $this->parent,
            'add_time' => $this->add_time,
            'add_user' => $this->add_user,
            'token' => $this->token,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'info', $this->info]);

        return $dataProvider;
    }
}
