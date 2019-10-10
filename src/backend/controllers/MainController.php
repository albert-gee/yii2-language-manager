<?php

namespace albertgeeca\language_manager\src\backend\controllers;

use Yii;
use albertgeeca\language_manager\src\common\entities\Language;
use albertgeeca\language_manager\src\common\models\SearchModel;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DefaultController implements the CRUD actions for Language model.
 * @author Albert Gee
 */
class MainController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Language models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SearchModel();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new one or updates existing Language model.
     * If operation is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionSave(int $id = null)
    {
        $languageModel = (!empty($id)) ? Language::findOne($id) : new Language();

        if ($languageModel->load(Yii::$app->request->post()) && $languageModel->save()) {

            Yii::$app->getSession()->setFlash('success', Yii::t('language', 'The language has been successfully saved'));
            return $this->redirect(['save', 'id' => $languageModel->id]);
        }

        return $this->render('save', [
            'languageModel' => $languageModel,
        ]);
    }

    /**
     * Deletes an existing Language model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
}
