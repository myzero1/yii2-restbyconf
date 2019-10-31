<?php
/**
 * @link https://github.com/myzero1
 * @copyright Copyright (c) 2019- My zero one
 * @license https://github.com/myzero1/yii2-restbyconf/blob/master/LICENSE
 */

namespace myzero1\restbyconf\components\rest;

use Yii;
use yii\db\ActiveRecord;
use yii\base\DynamicModel;
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
    public $created_at;
    public $updated_at;
    public $captcha;

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
        return "z1_user";
    }

    //规则
    public function rules()
    {
        return [
            // ['username', 'required'],
            [['email', 'mobile_phone', 'captcha', 'api_token', ], 'safe'],
            [['username', 'email', 'mobile_phone', 'api_token', ], 'unique' ],
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
    public function generateApiToken($outPut = false)
    {
        $this->api_token = Yii::$app->security->generateRandomString() . '_' . time();

        if ($outPut) {
            return $this->api_token;
        }
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
        $expire = Yii::$app->user->authTimeout;
        if (is_null($expire)) {
            $expire = \Yii::$app->controller->module->apiTokenExpire;
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
        // var_dump(123456);exit;
        // return static::find()->where('username = :username', [':username' => $username])->one();
        return static::find()->where([
            'or',
            ['=', 'username', $username],
            ['=', 'email', $username],
            ['=', 'mobile_phone', $username],
        ])->one();
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
        if (\Yii::$app->controller->module->fixedUser['api_token'] == $token) {
            $fixedUser = \Yii::$app->controller->module->fixedUser;

            $identityDoc = new self();
            $identityDoc->load(\Yii::$app->controller->module->fixedUser, '');
            $identityDoc->id = $fixedUser['id'];

            return $identityDoc;
        } else {
            $identity = static::find()->where(['api_token' => $token])->one();
            return $identity;
        }

        if (!static::apiTokenIsValid($token)) {
            throw new \yii\web\UnauthorizedHttpException("token is invalid.");
        }
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
