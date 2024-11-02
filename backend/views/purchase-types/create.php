<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\PurchaseTypes $model */

$this->title = 'Создать тип закупки';
$this->params['breadcrumbs'][] = ['label' => 'Типы закупки', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="purchase-types-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
