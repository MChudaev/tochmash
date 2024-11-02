<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\DeliveryTypes $model */

$this->title = 'Создание типа доставки';
$this->params['breadcrumbs'][] = ['label' => 'Типы доставки', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="delivery-types-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
