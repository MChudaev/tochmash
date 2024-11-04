<?php

use app\models\Details;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\DetailsSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Детали';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="details-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать деталь', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            #'id',
            'name',
            'drawing_number',
            //'drawing_file',
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
				'filter' => Html::activeTextInput($searchModel, 'drawing_file', [
					'class' => 'form-control',
					'placeholder' => '',
				]),
			],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Details $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 },
				'buttonOptions' => [
					'class' => 'action-button',
				],
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
