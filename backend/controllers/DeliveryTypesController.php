<?php

namespace backend\controllers;

use Yii;
use app\models\DeliveryTypes;
use app\models\DeliveryTypesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii2mod\rbac\filters\AccessControl;
use app\models\Requests;

/**
 * DeliveryTypesController implements the CRUD actions for DeliveryTypes model.
 */
class DeliveryTypesController extends Controller
{
    /**
     * @inheritDoc
     */
	public function behaviors()
	{
		return [
			'access' => [
				'class' => AccessControl::className(),
				'rules' => [
					[
						'allow' => true,
						'roles' => ['admin'],
					],
				],
			],
			'verbs' => [
				'class' => VerbFilter::className(),
				'actions' => [
					'delete' => ['POST'],
				],
			],
		];
	}

    /**
     * Lists all DeliveryTypes models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new DeliveryTypesSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single DeliveryTypes model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new DeliveryTypes model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new DeliveryTypes();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing DeliveryTypes model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing DeliveryTypes model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
	public function actionDelete($id)
	{
		$model = $this->findModel($id);

		// Проверка, используется ли запись в заявках
		/*if ($this->isDeliveryTypeUsedInRequests($id)) {
			Yii::$app->session->setFlash('error', 'Нельзя удалить запись, так как она используется в заявках.');
			return $this->redirect(['index']);
		}*/

		$model->delete();
		return $this->redirect(['index']);
	}

	protected function findModel($id)
	{
		if (($model = DeliveryTypes::findOne($id)) !== null) {
			return $model;
		}

		throw new NotFoundHttpException('The requested page does not exist.');
	}

	private function isDeliveryTypeUsedInRequests($id)
	{
		return Requests::find()->where(['delivery_type_id' => $id])->exists();
	}
}
