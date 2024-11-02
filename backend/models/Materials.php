<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "materials".
 *
 * @property int $id
 * @property string $geometry
 * @property string $material
 * @property string $type
 * @property string|null $comment
 */
class Materials extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'materials';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['geometry', 'material', 'type'], 'required'],
            [['comment'], 'string'],
            [['geometry', 'material', 'type'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'geometry' => 'Геометрия',
            'material' => 'Материал',
            'type' => 'Тип проката',
            'comment' => 'Комментарий',
        ];
    }
}
