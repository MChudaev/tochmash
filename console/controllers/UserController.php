<?php

namespace console\controllers;

use Yii;
use yii\console\Controller;
use common\models\User;

class UserController extends Controller
{
    public function actionCreate($username, $password, $email)
    {
        $user = new User();
        $user->username = $username;
        $user->email = $email;
        $user->setPassword($password);
        $user->generateAuthKey();

        if ($user->save()) {
            echo "User created successfully.\n";
        } else {
            echo "Failed to create user.\n";
            print_r($user->errors);
        }
    }
}