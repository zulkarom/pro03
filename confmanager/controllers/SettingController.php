<?php

namespace confmanager\controllers;

use Yii;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;
use yii\db\Expression;
use backend\modules\conference\models\UploadConfFile as UploadFile;
use backend\modules\conference\models\Conference;


/**
 * ConferenceController implements the CRUD actions for Conference model.
 */
class SettingController extends Controller
{
    /**
     * {@inheritdoc}
     */


	public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }


    public function actionIndex($conf)
    {
        $model = $this->findModel($conf);

        if ($model->load(Yii::$app->request->post())) {
			if($model->save()){
				Yii::$app->session->addFlash('success', "Conference Setting Updated");
				return $this->redirect(['index', 'conf' => $conf]);
			}
			
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }
	
	public function actionPayment($conf)
    {
        $model = $this->findModel($conf);

        if ($model->load(Yii::$app->request->post())) {
			if($model->save()){
				Yii::$app->session->addFlash('success', "Payment Information Updated");
				return $this->redirect(['payment', 'conf' => $conf]);
			}
			
        }

        return $this->render('payment', [
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
    protected function findModel($id)
    {
        if (($model = Conference::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
	
	


	public function actionUploadFile($attr, $id){
        $attr = $this->clean($attr);
        $model = $this->findModel($id);
        $model->file_controller = 'setting';

        return UploadFile::upload($model, $attr, 'updated_at');

    }

	protected function clean($string){
        $allowed = ['banner', 'logo'];
        
        foreach($allowed as $a){
            if($string == $a){
                return $a;
            }
        }
        
        throw new NotFoundHttpException('Invalid Attribute');

    }

	public function actionDeleteFile($attr, $id)
    {
        $attr = $this->clean($attr);
        $model = $this->findModel($id);
        $attr_db = $attr . '_file';
        
        $file = Yii::getAlias('@upload/' . $model->{$attr_db});
        
        $model->scenario = $attr . '_delete';
        $model->{$attr_db} = '';
        $model->updated_at = new Expression('NOW()');
        if($model->save()){
            if (is_file($file)) {
                unlink($file);
                
            }
            
            return Json::encode([
                        'good' => 1,
                    ]);
        }else{
            return Json::encode([
                        'errors' => $model->getErrors(),
                    ]);
        }
        


    }

	public function actionDownloadFile($attr, $id, $identity = true){
        $attr = $this->clean($attr);
        $model = $this->findModel($id);
        $filename = strtoupper($attr) . ' ' . Yii::$app->user->identity->fullname;
        UploadFile::download($model, $attr, $filename);
    }




}
