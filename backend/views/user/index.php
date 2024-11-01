<?php
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $users common\models\User[] */

$this->title = 'Управление пользователями';
?>
<h1><?= Html::encode($this->title) ?></h1>

<p>
    <?= Html::a('Создать пользователя', ['create'], ['class' => 'btn btn-success']) ?>
</p>

<table class="table table-bordered">
    <tr>
        <th>ID</th>
        <th>Имя пользователя</th>
        <th>Email</th>
        <th>Действия</th>
    </tr>
    <?php foreach ($users as $user): ?>
        <tr>
            <td><?= $user->id ?></td>
            <td><?= Html::encode($user->username) ?></td>
            <td><?= Html::encode($user->email) ?></td>
            <td>
                <?= Html::a('Редактировать', ['update', 'id' => $user->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Удалить пользователя', ['delete', 'id' => $user->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Вы уверены, что хотите удалить этого пользователя?',
                        'method' => 'post',
                    ],
                ]) ?>
            </td>
        </tr>
    <?php endforeach; ?>
</table>