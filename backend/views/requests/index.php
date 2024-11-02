<?php

use app\models\Requests;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\RequestsSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Заявки';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="requests-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать заявку', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'description:ntext',
            'created_at',
			[
				'attribute' => 'employee_id',
				'value' => function ($model) {
					return $model->employee ? $model->employee->full_name : '';
				},
				'filter' => \yii\helpers\ArrayHelper::map(\app\models\Employees::find()->all(), 'id', 'full_name'),
			],
			[
				'attribute' => 'customer_id',
				'value' => function ($model) {
					return $model->customer ? $model->customer->address : '';
				},
				'filter' => \yii\helpers\ArrayHelper::map(\app\models\Customers::find()->all(), 'id', 'address'),
			],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Requests $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
