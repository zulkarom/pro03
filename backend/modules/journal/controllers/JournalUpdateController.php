<?php

namespace backend\modules\journal\controllers;

use Yii;
use backend\modules\journal\models\Journal;
use backend\modules\journal\models\JournalSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\Expression;
use yii\filters\AccessControl;
use common\models\Upload;
use yii\helpers\Json;

/**
 * JournalController implements the CRUD actions for Journal model.
 */
class JournalUpdateController extends Controller
{
    /**
     * @inheritdoc
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
     * Lists all Journal models.
     * @return mixed
     */
    public function actionIndex()
    {

    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->save();
			Yii::$app->session->addFlash('success', "Data Updated");
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }
	
	public function actionEditorialBoard($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->save();
			Yii::$app->session->addFlash('success', "Data Updated");
        }

        return $this->render('board', [
            'model' => $model,
        ]);
    }
	
	public function actionSubmission($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->save();
			Yii::$app->session->addFlash('success', "Data Updated");
        }

        return $this->render('submission', [
            'model' => $model,
        ]);
    }
	
	public function actionTemplate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->save();
			Yii::$app->session->addFlash('success', "Data Updated");
        }

        return $this->render('template', [
            'model' => $model,
        ]);
    }
	
	public function actionEthics($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->save();
			Yii::$app->session->addFlash('success', "Data Updated");
        }

        return $this->render('ethics', [
            'model' => $model,
        ]);
    }

   public function actionUpload($attr, $id){
        $attr = $this->clean($attr);
        $model = $this->findModel($id);
        $model->file_controller = 'journal-update';

        return Upload::upload($model, $attr, 'updated_at');

    }
	
	public function actionDelete($attr, $id)
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
	
	public function actionDownload($attr, $id, $identity = true){
        $attr = $this->clean($attr);
        $model = $this->findModel($id);
        $filename = strtoupper($attr);
        
        
        
        Upload::download($model, $attr, $filename);
    }

    /**
     * Finds the Journal model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Journal the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Journal::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
	
	protected function clean($string){

        $allowed = ['template', 'template2'];
        
        foreach($allowed as $a){
            if($string == $a){
                return $a;
            }
        }

        throw new NotFoundHttpException('Invalid Attribute');

    }

}
