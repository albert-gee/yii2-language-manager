<?php
namespace albertgeeca\language_manager\src\backend\controllers;

use Yii;
use albertgeeca\language_manager\src\common\entities\Language;
use albertgeeca\language_manager\src\common\models\SearchModel;
use yii\base\Exception;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

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
        $languageModel = (!empty($id)) ? Language::findModel($id) : new Language();

        if ($languageModel->load(Yii::$app->request->post()) && $languageModel->save()) {

            Yii::$app->getSession()->setFlash('success', Yii::t('language', 'The language has been successfully saved'));
            return $this->redirect(['save', 'id' => $languageModel->id]);
        }

        return $this->render('save', [
            'languageModel' => $languageModel,
        ]);
    }

    /**
     * Deletes a not default Language model. If deletion has been successful, the browser will be redirected to the 'index' page
     * @param int $id - ID of the Language to be deleted
     * @return \yii\web\Response
     * @throws Exception - if you attemp to delete default language
     * @throws NotFoundHttpException - if Language with such ID was not found
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete(int $id)
    {
        $language = Language::findModel($id)>delete();

        return $this->redirect(['index']);
    }

    public function actionDeleteMultiple()
    {
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;

            $data = \Yii::$app->request->post();
            $deletedIDs = [];

            foreach ($data['data'] as $id) {
                if(Language::findModel($id)->delete()) {
                    $deletedIDs[] = $id;
                }
            }

            return $deletedIDs;
        } else {
            throw new NotFoundHttpException();
        }
    }

    /**
     * Makes language default
     * @param $id - ID of the language to be set as default
     * @return \yii\web\Response
     * @throws NotFoundHttpException if Language with such ID does not exist
     */
    public function actionSwitchDefault(int $id)
    {
        Language::switchDefault($id);
        return $this->redirect(\Yii::$app->request->referrer);
    }

    /**
     * Archives or unarchives Language by its ID
     * @param $id - ID of the language to be archived
     * @throws NotFoundHttpException if Language with such ID does not exist
     */
    public function actionArchive(int $id)
    {
        $language = Language::findModel($id);
        $language->is_archived = $language->is_archived ? false : true;
        $language->save();
        return $this->redirect(\Yii::$app->request->referrer);
    }



}
