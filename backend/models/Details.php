<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;
use yii\validators\FileValidator;

/**
 * This is the model class for table "details".
 *
 * @property int $id
 * @property string $name
 * @property string $drawing_number
 * @property string|null $drawing_file
 */
class Details extends \yii\db\ActiveRecord
{
	/**
	 * @var UploadedFile
	 */
	public $drawingFile;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'details';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'drawing_number'], 'required'],
            [['name', 'drawing_number', 'drawing_file'], 'string', 'max' => 255],
			[['drawingFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'pdf', 'checkExtensionByMimeType' => true],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Наименование детали',
            'drawing_number' => 'Номер чертежа',
            'drawing_file' => 'Файл чертежа',
			'drawingFile' => 'Файл чертежа',
        ];
    }

	public function upload()
	{
		if ($this->validate()) {
			$fileName = $this->id . '_' . $this->drawingFile->baseName . '.' . $this->drawingFile->extension;
			$filePath = Yii::getAlias('@webroot/uploads/' . $fileName);
			if ($this->drawingFile->saveAs($filePath, false)) {
				$this->drawing_file = $fileName;
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
}
