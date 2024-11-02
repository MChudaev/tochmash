<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "employees".
 *
 * @property int $id
 * @property string $full_name
 * @property string $email
 * @property string $phone_number
 * @property string $role
 */
class Employees extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'employees';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['full_name', 'email', 'phone_number'], 'required'],
            [['full_name', 'email', 'phone_number'], 'string', 'max' => 255],
            [['role'], 'string', 'max' => 64],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'full_name' => 'ФИО',
            'email' => 'Email',
            'phone_number' => 'Номер телефона',
            'role' => 'Роль',
        ];
    }
}