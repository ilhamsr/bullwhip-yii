<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pegawai".
 *
 * @property int $id_pegawai
 * @property string $username
 * @property string $password
 * @property string $nama_pegawai
 * @property string $alamat_pegawai
 * @property string $hp_pegawai
 * @property int $id_bagian
 */
class Pegawai extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pegawai';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'password', 'nama_pegawai', 'alamat_pegawai', 'hp_pegawai', 'id_bagian'], 'required'],
            [['id_bagian'], 'integer'],
            [['username', 'nama_pegawai'], 'string', 'max' => 32],
            [['password', 'hp_pegawai'], 'string', 'max' => 16],
            [['alamat_pegawai'], 'string', 'max' => 64],
            [['username'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_pegawai' => 'Id Pegawai',
            'username' => 'Username',
            'password' => 'Password',
            'nama_pegawai' => 'Nama Pegawai',
            'alamat_pegawai' => 'Alamat Pegawai',
            'hp_pegawai' => 'Hp Pegawai',
            'id_bagian' => 'Id Bagian',
        ];
    }

    public static function findByUsername($username)
    {
        return Pegawai::findOne(['username' => $username]);
    }

    public function validatePassword($password)
    {
        return $this->password === $password;
    }

    public static function findIdentity($id)
    {
        return isset(self::$users[$id]) ? new static(self::$users[$id]) : null;
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        foreach (self::$users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }

        return null;
    }

    public function getId()
    {
        return $this->id_pegawai;
    }

    public function getAuthKey()
    {
        return null;
    }

    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }
}
