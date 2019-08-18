<?php

namespace confsite\controllers;

use Yii;
use backend\modules\conference\models\Conference;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * ConferenceController implements the CRUD actions for Conference model.
 */
class PageController extends Controller
{
	public $layout = 'main-page';
	
	public function actionFees($confurl){
        $model = $this->findModel($confurl);
        return $this->render('fees', [
			'model' => $model,
		]);
    }
	
	/**
     * Finds the Conference model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Conference the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($url)
    {
        if (($model = Conference::findOne(['conf_url' => $url])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
