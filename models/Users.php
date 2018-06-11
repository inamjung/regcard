<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use yii\db\Expression;
use dektrium\user\models\User as BaseUser;
use dektrium\user\traits\EventTrait;
use dektrium\user\traits\ModuleTrait;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $username
 * @property string $email
 * @property string $password_hash
 * @property string $auth_key
 * @property integer $confirmed_at
 * @property string $unconfirmed_email
 * @property integer $blocked_at
 * @property string $registration_ip
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $flags
 * @property integer $last_login_at
 * @property integer $status
 * @property string $password_reset_token
 */
class Users extends BaseUser
{
    /**
     * @inheritdoc
     */
    use ModuleTrait;
    const BEFORE_CREATE   = 'beforeCreate';
    const AFTER_CREATE    = 'afterCreate';
    const BEFORE_REGISTER = 'beforeRegister';
    const AFTER_REGISTER  = 'afterRegister';
    const BEFORE_CONFIRM  = 'beforeConfirm';
    const AFTER_CONFIRM   = 'afterConfirm';
    
    const ROLE_ADMIN = 1;
    const ROLE_RM = 2;
    const ROLE_USER = 10;
    const ROLE_LEADER = 20;
    
    public static $role =[1=>'admin',10=>'user',20=>'leader'];
    
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'email', 'password_hash', 'auth_key', 'created_at', 'updated_at'], 'required'],
            [['confirmed_at', 'blocked_at', 'created_at', 'updated_at', 'flags', 'last_login_at', 'status','dep_id','occ_id','pos_id'], 'integer'],
            [['username', 'email', 'unconfirmed_email', 'password_reset_token','name','pname','pos_no'], 'string', 'max' => 255],
            [['password_hash'], 'string', 'max' => 60],
            [['auth_key'], 'string', 'max' => 32],
            [['registration_ip'], 'string', 'max' => 45],
            [['role'], 'string', 'max' => 5],
            [['username'], 'unique'],
            [['email'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'email' => 'Email',
            'password_hash' => 'Password Hash',
            'auth_key' => 'Auth Key',
            'confirmed_at' => 'Confirmed At',
            'unconfirmed_email' => 'Unconfirmed Email',
            'blocked_at' => 'Blocked At',
            'registration_ip' => 'Registration Ip',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'flags' => 'Flags',
            'last_login_at' => 'Last Login At',
            'status' => 'Status',
            'password_reset_token' => 'Password Reset Token',
            'dep_id'=>'หน่วยงาน',
            'pos_id'=>'ตำแหน่ง',
            'occ_id'=>'อาชีพ',
            'pos_no'=>'เลขที่ตำแหน่ง',
            'pname'=>'คำนำหน้า',
            'name'=>'ชื่อ-สกุล',
            'role'=>'บทบาท'
        ];
    }
}
