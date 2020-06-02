<?php

namespace backend\controllers;

use Yii;
use backend\models\site\Site;

class MainController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $model = new Site();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->saveImages();
            Yii::$app->session->setFlash('success', 'Done');
            return $this->render('index', ['model' => $model]);
        } else {
            return $this->render('index', ['model' => $model]);
        }
    }

    public function actionRollback()
    {
        $model = new Site();
        $model->backupImage();

        return $this->redirect('/main');
    }
}
