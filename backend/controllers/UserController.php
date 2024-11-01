<?php
namespace backend\controllers;

use Yii;
use common\models\User;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;

class UserController extends Controller
{
	public function behaviors()
	{
		// Получаем роли пользователя
		$roles = Yii::$app->authManager->getRolesByUser(Yii::$app->user->id);

		// Извлекаем имена ролей
		$roleNames = [];
		foreach ($roles as $role) {
			$roleNames[] = $role->name; // Получаем имя роли
		}

		// Записываем имена ролей в лог
		Yii::debug('Current User ' . Yii::$app->user->id .' Role: ' . implode(', ', $roleNames), __METHOD__);

		return [
			'access' => [
				'class' => AccessControl::class,
				'rules' => [
					[
						'actions' => ['index', 'create', 'update', 'delete'],
						'allow' => true,
						'roles' => ['admin'], // Только администраторы могут управлять пользователями
					],
					[
						'allow' => false, // Запрещаем доступ всем остальным
					],
				],
			],
		];
	}

    // Список пользователей
    public function actionIndex()
    {
        $users = User::find()->all();
        return $this->render('index', ['users' => $users]);
    }

    // Создание нового пользователя
    public function actionCreate()
    {
        $model = new User();

        if ($model->load(Yii::$app->request->post())) {
			$model->setPassword($model->password); // Хэшируем новый пароль
			$model->generateAuthKey(); // Генерируем authKey

            if ($model->save()) {
                // Назначаем роль после сохранения пользователя
                $auth = Yii::$app->authManager;

                // Получаем роль из POST-запроса
                $roleName = Yii::$app->request->post('User')['role'];

                // Проверяем, существует ли роль
                $role = $auth->getRole($roleName);
                if ($role) {
                    $auth->assign($role, $model->id); // Назначаем роль
                } else {
                    Yii::$app->session->setFlash('error', 'Выбранная роль не существует.');
                }

                return $this->redirect(['index']);
            } else {
                Yii::$app->session->setFlash('error', 'Ошибка при создании пользователя: ' . implode(', ', $model->getErrors()));
            }
        }

        return $this->render('create', ['model' => $model]);
    }

    // Обновление пользователя и смена роли
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        // Получите роль текущего пользователя
        $auth = Yii::$app->authManager;

        // Получаем все назначения для текущего пользователя
        $assignments = $auth->getAssignments($model->id);

        // Установите первую роль в модель, если она существует
        $model->role = !empty($assignments) ? key($assignments) : null;

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            // Проверяем, был ли введен новый пароль
            if (!empty($model->password)) {
                $model->setPassword($model->password); // Хэшируем новый пароль
                $model->generateAuthKey(); // Генерируем authKey
            }

            if ($model->save()) {
                // Обновление роли пользователя
                $auth->revokeAll($model->id); // Удаляем все роли

                // Получаем имя роли из POST-запроса
                $roleName = $model->role; // Измените на $model->role
                $role = $auth->getRole($roleName); // Получаем объект роли

                if ($role) {
                    $auth->assign($role, $model->id); // Назначаем новую роль
                } else {
                    Yii::$app->session->setFlash('error', 'Выбранная роль не существует.');
                }

                return $this->redirect(['index']);
            }
        }

        return $this->render('update', ['model' => $model]);
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        // Удалите назначенные роли
        $auth = Yii::$app->authManager;
        $auth->revokeAll($id);

        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Запрашиваемая страница не существует.');
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if (!empty($this->password)) {
                $this->password_hash = Yii::$app->security->generatePasswordHash($this->password);
            }
            return true;
        }
        return false;
    }
}