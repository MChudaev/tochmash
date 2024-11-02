<?php

namespace backend\controllers;

use Yii;
use app\models\Details;
use app\models\DetailsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii2mod\rbac\filters\AccessControl;
use app\models\Requests;

/**
 * DetailsController implements the CRUD actions for Details model.
 */
class DetailsController extends Controller
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
     * Lists all Details models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new DetailsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Details model.
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
     * Creates a new Details model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
	public function actionCreate()
	{
		$model = new Details();

		if ($model->load(Yii::$app->request->post())) {
			$model->drawingFile = UploadedFile::getInstance($model, 'drawingFile');
			if ($model->save()) {
				if ($model->upload()) {
					$model->save();
					return $this->redirect(['view', 'id' => $model->id]);
				}
			}
		}

		return $this->render('create', [
			'model' => $model,
		]);
	}

    /**
     * Updates an existing Details model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
	public function actionUpdate($id)
	{
		$model = $this->findModel($id);

		if ($model->load(Yii::$app->request->post())) {
			$model->drawingFile = UploadedFile::getInstance($model, 'drawingFile');
			if ($model->upload()) {
				$model->save();
				return $this->redirect(['view', 'id' => $model->id]);
			}
		}

		return $this->render('update', [
			'model' => $model,
		]);
	}

    /**
     * Deletes an existing Details model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
	public function actionDelete($id)
	{
		$model = $this->findModel($id);

		// Проверка, используется ли запись в заявках
		/*if ($this->isDetailUsedInRequests($id)) {
			Yii::$app->session->setFlash('error', 'Нельзя удалить запись, так как она используется в заявках.');
			return $this->redirect(['index']);
		}*/

		$model->delete();
		return $this->redirect(['index']);
	}

	protected function findModel($id)
	{
		if (($model = Details::findOne($id)) !== null) {
			return $model;
		}

		throw new NotFoundHttpException('The requested page does not exist.');
	}

	private function isDetailUsedInRequests($id)
	{
		return Requests::find()->where(['detail_id' => $id])->exists();
	}
}
