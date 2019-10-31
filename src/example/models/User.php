<?php

namespace myzero1\restbyconf\example\models;

use Yii;

/**
 * This is the model class for table "z1_user".
 *
 * @property int $id
 * @property string $username
 * @property string $email
 * @property string $mobile_phone
 * @property string $avatar
 * @property string $password_hash
 * @property string $captcha
 * @property string $api_token
 * @property int $is_del
 * @property int $status 1:enabled
 * @property int $created_at
 * @property int $updated_at
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'z1_user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['is_del', 'status', 'created_at', 'updated_at'], 'integer'],
            [['created_at', 'updated_at'], 'required'],
            [['username', 'email', 'mobile_phone', 'avatar', 'password_hash', 'captcha', 'api_token'], 'string', 'max' => 255],
            [['username'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'email' => 'Email',
            'mobile_phone' => 'Mobile Phone',
            'avatar' => 'Avatar',
            'password_hash' => 'Password Hash',
            'captcha' => 'Captcha',
            'api_token' => 'Api Token',
            'is_del' => 'Is Del',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
