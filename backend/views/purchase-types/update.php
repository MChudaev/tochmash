<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\PurchaseTypes $model */

$this->title = 'Редактирование типа закупки: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Типы закупки', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="purchase-types-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
