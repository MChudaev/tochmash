<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Requests $model */

$this->title = 'Создание заявки';
$this->params['breadcrumbs'][] = ['label' => 'Заявки', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="requests-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
		'employees' => $employees,
		'customers' => $customers
    ]) ?>

</div>
