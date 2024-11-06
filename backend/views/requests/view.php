<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Requests $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Заявки', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="requests-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
		<?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
		<?= Html::a('Удалить', ['delete', 'id' => $model->id], [
			'class' => 'btn btn-danger',
			'data' => [
				'confirm' => 'Вы уверены что хотите удалить заявку?',
				'method' => 'post',
			],
		]) ?>
    </p>

	<?= DetailView::widget([
		'model' => $model,
		'attributes' => [
			'id',
			'name',
			'description:ntext',
			'created_at',
			[
				'attribute' => 'employee_id',
				'value' => function ($model) {
					return $model->employee ? $model->employee->full_name : 'N/A';
				},
			],
			[
				'attribute' => 'customer_id',
				'value' => function ($model) {
					return $model->customer ? $model->customer->contact_persons : 'N/A';
				},
			],
		],
	]) ?>

</div>
