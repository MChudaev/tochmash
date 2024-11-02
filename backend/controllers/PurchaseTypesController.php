<?php

namespace backend\controllers;

use Yii;
use app\models\PurchaseTypes;
use app\models\PurchaseTypesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii2mod\rbac\filters\AccessControl;
use app\models\Requests;

/**
 * PurchaseTypesController implements the CRUD actions for PurchaseTypes model.
 */
class PurchaseTypesController extends Controller
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
     * Lists all PurchaseTypes models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new PurchaseTypesSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PurchaseTypes model.
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
     * Creates a new PurchaseTypes model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new PurchaseTypes();

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
     * Updates an existing PurchaseTypes model.
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
     * Deletes an existing PurchaseTypes model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
	public function actionDelete($id)
	{
		$model = $this->findModel($id);

		// Проверка, используется ли запись в заявках
		/*if ($this->isPurchaseTypeUsedInRequests($id)) {
			Yii::$app->session->setFlash('error', 'Нельзя удалить запись, так как она используется в заявках.');
			return $this->redirect(['index']);
		}*/

		$model->delete();
		return $this->redirect(['index']);
	}

	protected function findModel($id)
	{
		if (($model = PurchaseTypes::findOne($id)) !== null) {
			return $model;
		}

		throw new NotFoundHttpException('The requested page does not exist.');
	}

	private function isPurchaseTypeUsedInRequests($id)
	{
		return Requests::find()->where(['request_type_id' => $id])->exists();
	}
}
