<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Customers $model */

$this->title = 'Создание заказчика';
$this->params['breadcrumbs'][] = ['label' => 'Заказчики', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customers-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
