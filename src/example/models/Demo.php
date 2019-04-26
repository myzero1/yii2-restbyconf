<?php

namespace myzero1\restbyconf\example\models;

use Yii;

/**
 * This is the model class for table "demo".
 *
 * @property string $id id
 * @property string $name name
 * @property string $des description
 */
class Demo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'demo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['name'], 'required'],
            [['id', 'name', 'des'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'des' => 'description',
        ];
    }
}
