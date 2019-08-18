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
use common\models\UploadFile;
use common\models\Model;
use backend\modules\conference\models\Conference;
use backend\modules\conference\models\ConfDate;
use backend\modules\conference\models\ConferenceSearch;
use backend\modules\conference\models\ConfFee;
use backend\modules\conference\models\ConfFeeInfo;


/**
 * ConferenceController implements the CRUD actions for Conference model.
 */
class ConferenceController extends Controller
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


    /**
     * Lists all Conference models.
     * @return mixed
     */
    public function actionIndex()
    {

    }


    /**
     * Updates an existing Conference model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($conf)
    {
        $model = $this->findModel($conf);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['site/index']);
        }

        return $this->render('update', [
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
        $model->file_controller = 'conference';

        return UploadFile::upload($model, $attr, 'updated_at');

    }

	protected function clean($string){
        $allowed = ['banner'];
        
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


	public function actionDates($conf)
    {
		$model = $this->findModel($conf);
		$dates = $model->confDates;
       
        if ($model->load(Yii::$app->request->post())) {
            
            $model->updated_at = new Expression('NOW()');    
            
            $oldIDs = ArrayHelper::map($dates, 'id', 'id');
			
            
            $dates = Model::createMultiple(ConfDate::classname(), $dates);
            
            Model::loadMultiple($dates, Yii::$app->request->post());
			
            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($dates, 'id', 'id')));
	
			foreach ($dates as $i => $date) {
                $date->date_order = $i;
            }
			
			
            $valid = $model->validate();
            
            $valid = Model::validateMultiple($dates) && $valid;
            
            if ($valid) {

                $transaction = Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        if (! empty($deletedIDs)) {
                            ConfDate::deleteAll(['id' => $deletedIDs]);
                        }
                        foreach ($dates as $i => $date) {
                            if ($flag === false) {
                                break;
                            }
                            //do not validate this in model
                            $date->conf_id = $model->id;

                            if (!($flag = $date->save(false))) {
                                break;
                            }
                        }

                    }

                    if ($flag) {
                        $transaction->commit();
                            Yii::$app->session->addFlash('success', "Dates updated");
							return $this->redirect(['dates','conf' => $conf]);
                    } else {
                        $transaction->rollBack();
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                    
                }
            }

        
        
       

    }
	
	 return $this->render('dates', [
            'model' => $model,
            'dates' => (empty($dates)) ? [new ConfDate] : $dates
        ]);
	}
	
	public function actionFees($conf)
    {
		$model = $this->findModel($conf);
		$fees = $model->confFees;
       
        if ($model->load(Yii::$app->request->post())) {
           // print_r(Yii::$app->request->post());die();
            $model->updated_at = new Expression('NOW()');    
            
            $oldIDs = ArrayHelper::map($fees, 'id', 'id');
			
            $fees = Model::createMultiple(ConfFee::classname(), $fees);
			//echo count($fees);die();
			//$dates = Model::createMultiple(ConfDate::classname(), $dates);
            
            Model::loadMultiple($fees, Yii::$app->request->post());
			//echo count($fees);die();
            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($fees, 'id', 'id')));
			
		
	
			foreach ($fees as $i => $fee) {
                $fee->fee_order = $i;
            }
			
				//print_r(ArrayHelper::map($fees, 'id', 'id'));die();
            $valid = $model->validate();
            
            $valid = Model::validateMultiple($fees) && $valid;
            
            if ($valid) {

                $transaction = Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        if (! empty($deletedIDs)) {
                            ConfFee::deleteAll(['id' => $deletedIDs]);
                        }
                        foreach ($fees as $i => $fee) {
                            if ($flag === false) {
                                break;
                            }
                            //do not validate this in model
                            $fee->conf_id = $model->id;

                            if (!($flag = $fee->save(false))) {
                                break;
                            }
                        }

                    }

                    if ($flag) {
                        $transaction->commit();
                            Yii::$app->session->addFlash('success', "Fees updated");
							return $this->redirect(['fees','conf' => $conf]);
                    } else {
                        $transaction->rollBack();
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                    
                }
            }


    }
	 return $this->render('fees', [
            'model' => $model,
            'fees' => (empty($fees)) ? [new ConfFee] : $fees
        ]);
	
	
	
	}
	



}
