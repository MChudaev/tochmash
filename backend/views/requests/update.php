<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Requests $model */

$this->title = 'Редактирование заявки: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Заявки', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="requests-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
		'employees' => $employees,
		'customers' => $customers
    ]) ?>

</div>
