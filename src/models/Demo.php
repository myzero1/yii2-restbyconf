<?php

namespace myzero1\restbyconf\models;

use Yii;

/**
 * This is the model class for table "demo".
 *
 * @property int $id
 * @property string $name
 * @property string $des
 * @property int $created_at
 * @property int $updated_at
 * @property int $is_del 0未删除，非0为删除
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
            [['name', 'des', 'created_at', 'updated_at'], 'required'],
            [['created_at', 'updated_at', 'is_del'], 'integer'],
            [['name', 'des'], 'string', 'max' => 255],
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
            'des' => 'Des',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'is_del' => 'Is Del',
        ];
    }
}
