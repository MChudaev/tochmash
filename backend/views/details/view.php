<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Details $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Детали', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="details-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены что хотите удалить деталь?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'drawing_number',
			[
				'attribute' => 'drawing_file',
				'format' => 'raw',
				'value' => function ($model) {
					$filePath = Yii::getAlias('@backend/web/uploads/' . $model->drawing_file);
					if (file_exists($filePath)) {
						return Html::a($model->drawing_file, Yii::getAlias('@backendUrl') . '/uploads/' . $model->drawing_file, ['target' => '_blank']);
					} else {
						return $model->drawing_file;
					}
				},
			],
            //'drawing_file',
        ],
    ]) ?>

</div>
