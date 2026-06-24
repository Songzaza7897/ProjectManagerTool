<?php

namespace app\models;

use Yii;

class User extends \yii\base\BaseObject implements \yii\web\IdentityInterface
{
    public $id;
    public $username;
    public $fullName;
    public $email;
    public $password;
    public $passwordHash;
    public $authKey;
    public $accessToken;

    private static $users = [
        '100' => [
            'id' => '100',
            'username' => 'admin',
            'fullName' => 'Workspace Admin',
            'email' => 'admin@example.com',
            'password' => 'admin',
            'authKey' => 'test100key',
            'accessToken' => '100-token',
        ],
        '101' => [
            'id' => '101',
            'username' => 'demo',
            'fullName' => 'Demo User',
            'email' => 'demo@example.com',
            'password' => 'demo',
            'authKey' => 'test101key',
            'accessToken' => '101-token',
        ],
    ];


    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        $users = self::allUsers();
        return isset($users[$id]) ? new static($users[$id]) : null;
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        foreach (self::allUsers() as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        foreach (self::allUsers() as $user) {
            if (strcasecmp($user['username'], $username) === 0) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        if ($this->passwordHash) {
            return Yii::$app->security->validatePassword($password, $this->passwordHash);
        }

        return $this->password === $password;
    }

    /**
     * Stores a demo user in the current session.
     *
     * @param array $attributes
     * @return static
     */
    public static function create(array $attributes)
    {
        $users = Yii::$app->session->get('registeredUsers', []);
        $users[$attributes['id']] = $attributes;
        Yii::$app->session->set('registeredUsers', $users);

        return new static($attributes);
    }

    /**
     * @return array
     */
    private static function allUsers()
    {
        $registered = [];
        if (Yii::$app->has('session') && Yii::$app->session->getIsActive()) {
            $registered = Yii::$app->session->get('registeredUsers', []);
        }

        return self::$users + $registered;
    }
}
