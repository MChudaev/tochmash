<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "customers".
 *
 * @property int $id
 * @property string $address
 * @property string $contact_persons
 * @property string $position
 * @property string $contacts
 * @property string|null $description
 */
class Customers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'customers';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['address', 'contact_persons', 'position', 'contacts'], 'required'],
            [['description'], 'string'],
            [['address', 'contact_persons', 'position', 'contacts'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'address' => 'Адрес',
            'contact_persons' => 'Контактные лица',
            'position' => 'Должность',
            'contacts' => 'Контакты',
            'description' => 'Описание',
        ];
    }
}
