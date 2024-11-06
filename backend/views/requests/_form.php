<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Employees;
use app\models\Customers;

/** @var yii\web\View $this */
/** @var app\models\Requests $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="requests-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?/*= $form->field($model, 'created_at')->textInput()*/ ?>

	<?= $form->field($model, 'employee_id')->dropDownList(
		ArrayHelper::map($employees, 'id', 'full_name'),
		['prompt' => 'Выбрать сотрудника']
	) ?>

	<?= $form->field($model, 'customer_id')->dropDownList(
		ArrayHelper::map($customers, 'id', 'contact_persons'),
		['prompt' => 'Выбрать заказчика']
	) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
