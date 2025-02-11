<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class User extends ActiveRecord implements IdentityInterface
{
    /**
     * Указываем имя таблицы
     */
    public static function tableName()
    {
        return '{{%users}}';
    }

    /**
     * Реализация метода поиска пользователя по ID из БД.
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * Реализация метода поиска по accessToken (если он вам нужен).
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['accessToken' => $token]);
    }

    /**
     * Ищет пользователя по username из БД.
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    /**
     * Возвращает ID пользователя.
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Метод возвращает значение authKey.
     * Если поле authKey у вас хранится в базе, например, 'authKey', то верните его.
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * Проверка валидности authKey.
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Проверка правильности пароля.
     * Используем метод validatePassword из компонента security для проверки хэша.
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }
}
