<?php

namespace app\models;

use Yii;
use yii\base\Model;

class SignupForm extends Model
{
    public $fullName;
    public $username;
    public $email;
    public $password;
    public $passwordConfirm;
    public $agree;

    public function rules()
    {
        return [
            [['fullName', 'username', 'email', 'password', 'passwordConfirm'], 'trim'],
            [['fullName', 'username', 'email', 'password', 'passwordConfirm'], 'required'],
            [['fullName'], 'string', 'min' => 2, 'max' => 80],
            [['username'], 'match', 'pattern' => '/^[a-zA-Z0-9_.-]+$/', 'message' => 'Use letters, numbers, dots, dashes or underscores only.'],
            [['username'], 'string', 'min' => 3, 'max' => 32],
            [['username'], 'validateUsername'],
            [['email'], 'email'],
            [['password'], 'string', 'min' => 6],
            [['passwordConfirm'], 'compare', 'compareAttribute' => 'password', 'message' => 'Passwords do not match.'],
            [['agree'], 'required', 'requiredValue' => 1, 'message' => 'Please accept the terms to continue.'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'fullName' => 'Full name',
            'username' => 'Username',
            'email' => 'Email address',
            'password' => 'Password',
            'passwordConfirm' => 'Confirm password',
            'agree' => 'I agree to the Terms of Service and Privacy Policy',
        ];
    }

    public function validateUsername($attribute)
    {
        if (!$this->hasErrors($attribute) && User::findByUsername($this->$attribute)) {
            $this->addError($attribute, 'This username is already in use.');
        }
    }

    /**
     * @return User|null
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }

        return User::create([
            'id' => uniqid('user-', true),
            'username' => $this->username,
            'fullName' => $this->fullName,
            'email' => $this->email,
            'passwordHash' => Yii::$app->security->generatePasswordHash($this->password),
            'authKey' => Yii::$app->security->generateRandomString(),
            'accessToken' => Yii::$app->security->generateRandomString(),
        ]);
    }
}
