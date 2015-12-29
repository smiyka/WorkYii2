<?php

namespace app\controllers;

use Yii;
use app\models\Posts;
use app\models\Category;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use app\models\PostSearch;

/**
 * PostController implements the CRUD actions for Posts model.
 */
class PostController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Posts models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new postSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'categori_ids' => $this->getCategori_Ids(),
        ]);
//        $dataProvider = new ActiveDataProvider([
//            'query' => Posts::find(),
//        ]);
//
//        return $this->render('index', [
//            'dataProvider' => $dataProvider,
//        ]);
    }

    /**
     * Displays a single Posts model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Posts model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        {
            $model = new Posts();
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                /** @var Category[] $categories */
                $categories = Category::find()->where(['id'=>$model->categori_ids])->all();
                foreach($categories as $category){
                    $model->link('categories', $category);
                }
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                    'category_names' => ArrayHelper::map(Category::find()->all(), 'id', 'name')
                ]);
            }
        }
    }

    /**
     * Updates an existing Posts model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->categori_ids = ArrayHelper::getColumn($model->categories, 'id');

//        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//            $model->unlinkAll('categories', true);
//  ;          $categories = Category::find()->where(['id'=>$model->categori_ids])->all();
//            foreach($categories as $category){
//                $model->link('categories', $category);
//            }
//            return $this->redirect(['view', 'id' => $model->id]);
//        } else {
//            return $this->render('update', [
//                'model' => $model,
//                'categori_ids' => ArrayHelper::map(Category::find()->all(), 'id', 'name')
//            ]);
//        }
    }

    /**
     * Deletes an existing Posts model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if (!$model) {
            $model->unlinkAll('categories', true);
            $model->delete();
        } else
        return $this->redirect(['index']);
    }

    /**
     * Finds the Posts model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Posts the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Posts::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * @return array
     */
    public function getCategori_Ids()
    {
        $categories = Category::find()->asArray()->all();
        $categori_ids = ArrayHelper::map($categories, 'id', 'name');

        return $categori_ids;
    }


}
