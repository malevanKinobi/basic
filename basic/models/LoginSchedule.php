<?php

namespace app\models;

use Yii;
use yii\base\Model;
class LoginSchedule extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;

    // Закрытое свойство для кеширования найденного пользователя
    private $_user = false;

    /**
     * Правила валидации
     */
    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
            ['rememberMe', 'boolean'],
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Проверка правильности пароля.
     * Метод добавляет ошибку, если пользователь не найден или пароль неверный.
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Неверное имя пользователя или пароль.');
            }
        }
    }

    /**
     * Выполняет вход пользователя, если валидация пройдена.
     * @return bool
     */
    public function login()
    {
        if ($this->validate()) {
            // Время жизни сессии: 30 дней, если стоит флаг rememberMe
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600*24*30 : 0);
        }
        return false;
    }

    /**
     * Находит пользователя по имени.
     * Предполагается, что у вас в модели User реализован метод findByUsername.
     * @return User|null
     */
    protected function getUser()
    {
        if ($this->_user === false) {
            // Реализуйте метод findByUsername в модели User
            $this->_user = User::findByUsername($this->username);
        }
        return $this->_user;
    }
}