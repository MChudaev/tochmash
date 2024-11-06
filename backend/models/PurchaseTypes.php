<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "purchase_types".
 *
 * @property int $id
 * @property string $purchase
 * @property string $customer_material
 */
class PurchaseTypes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'purchase_types';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['purchase', 'customer_material'], 'required'],
            [['purchase', 'customer_material'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'purchase' => 'Закупка',
            'customer_material' => 'Материал заказчика',
        ];
    }
}
