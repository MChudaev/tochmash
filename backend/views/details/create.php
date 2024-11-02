<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Details $model */

$this->title = 'Создание детали';
$this->params['breadcrumbs'][] = ['label' => 'Детали', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="details-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
