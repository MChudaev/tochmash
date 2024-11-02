<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\DeliveryTypes $model */

$this->title = 'Редактирование типа доставки: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Типы доставки', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="delivery-types-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
