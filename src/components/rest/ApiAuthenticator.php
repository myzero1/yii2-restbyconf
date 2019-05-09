<?php
/**
 * @link https://github.com/myzero1
 * @copyright Copyright (c) 2019- My zero one
 * @license https://github.com/myzero1/yii2-restbyconf/blob/master/LICENSE
 */

namespace myzero1\restbyconf\components\rest;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\web\IdentityInterface;

/**
 * ApiAuthenticator implements the API endpoint for creating a new model from the given data.
 *
 * For more details and usage information on CreateAction, see the [guide article](https://github.com/myzero1/yii2-restbyconf).
 *
 * @author Myzero1 <myzero1@sina.com>
 * @since 0.0
 */
class ApiAuthenticator extends ActiveRecord implements IdentityInterface
{
    public $authKey;
    public $accessToken;
    const API_TOKEN_EXPIRE = 86400;

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ]
            ]
        ];
    }

    //表名
    public static function tableName()
    {
        return "{{%user}}";
    }

    //规则
    public function rules()
    {
        return [
            ['username', 'required'],
            ['api_token', 'required'],
        ];
    }

    /**
     * 生成 "remember me" 认证key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * 生成 api_token
     */
    public function generateApiToken()
    {
        $this->api_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * 校验api_token是否有效
     */
    public static function apiTokenIsValid($token)
    {
        if (empty($token)) {
            return false;
        }
        $timestamp = (int)substr($token, strrpos($token, '_') + 1);
        if (isset($app->params['apiTokenExpire'])) {
            $expire = Yii::$app->params['apiTokenExpire'];
        } else {
            $expire = self::API_TOKEN_EXPIRE;
        }
        return $timestamp + $expire >= time();
    }

    /**
     * 根据api token 获取用户
     * @param $token
     * @return array|null|ActiveRecord
     */
    public static function findByApiToken($token)
    {
        return static::find()->where('api_token = :api_token', [':api_token' => $token])->one();
    }

    /**
     * 根据用户名查询用户
     * @param $username
     * @return array|null|ActiveRecord
     */
    public static function findByUsername($username)
    {
        return static::find()->where('username = :username', [':username' => $username])->one();
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        // 如果token无效的话
        if (!static::apiTokenIsValid($token)) {
            throw new \yii\web\UnauthorizedHttpException("token is invalid.");
        }
        return static::findOne(['api_token' => $token]);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * 为model的password_hash字段生成密码的hash值
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password, $password_hash)
    {
        return Yii::$app->security->validatePassword($password, $password_hash);
    }
}
