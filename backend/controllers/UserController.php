<?php

namespace backend\controllers;

use Yii;
use common\models\User;
use common\models\ChangePasswordForm;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\Expression;
use yii\web\UploadedFile;
use yii\db\Query;
use backend\models\UserSearch;
use backend\models\ReviewerSearch;
use backend\modules\journal\models\Associate;
use yii\filters\AccessControl;

/**
 * UsersController implements the CRUD actions for Users model.
 */
class UserController extends Controller
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
     * Lists all Users models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
	
	/**
     * Lists all Users models.
     * @return mixed
     */
    public function actionReviewer()
    {
        $searchModel = new ReviewerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('reviewer', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
	
	/**
     * Lists all Users models.
     * @return mixed
     */
    public function actionAssignment()
    {
		
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('assignment', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Users model.
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
     * Creates a new Users model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
	
    public function actionCreate()
    {
        $model = new User();
		$model->scenario = 'create_external';
		

        if ($model->load(Yii::$app->request->post())) {
			
			$model->username = $model->email;
			$model->setPassword($model->email);
			
			//manual confirm at
			$model->confirmed_at = time();
			
			
			$model->updated_at = new Expression('NOW()');
			$model->created_at = new Expression('NOW()');
			
			
			if($model->save()){
				
				$assoc = new Associate;
				$assoc->user_id = $model->id;
				$assoc->institution = $model->institution;
				$assoc->country_id = $model->country;
				$assoc->admin_creation = 1;
				
				if($assoc->save()){
					Yii::$app->session->addFlash('success', "The user has been successfully created");
					return $this->redirect(['user/assignment', 'id' => $model->id]);
				}
			}else{
				$model->flashError();
			}
           
			
			
        } 
		
		return $this->render('create', [
                'model' => $model,
            ]);
    }
	
	public function actionChangePassword()
	{
		$id = Yii::$app->user->id;
	 
		try {
			$model = new ChangePasswordForm($id);
		} catch (InvalidParamException $e) {
			throw new \yii\web\BadRequestHttpException($e->getMessage());
		}
	 
		if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->changePassword()) {
			Yii::$app->session->setFlash('success', 'Password Changed!');
		}
	 
		return $this->render('change-password', [
			'model' => $model,
		]);
	}

    /**
     * Updates an existing Users model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
		$assoc =$model->associate;
		$model->scenario = 'update_external';
		$assoc->scenario = 'update_external';

        if ($model->load(Yii::$app->request->post()) && $assoc->load(Yii::$app->request->post())) {
			
			$model->username = $model->email;
			$model->setPassword($model->email);
			
			$model->updated_at = new Expression('NOW()');
			
			if($model->save()){
				
				if($assoc->save()){
					Yii::$app->session->addFlash('success', "The user has been successfully updated");
				
				}else{
					$assoc->flashError();
				}
			}else{
					$model->flashError();
				}
			
			
			
            return $this->redirect(['update', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
				'assoc' => $assoc
            ]);
        }
    }
	
	public function actionUpdateProfile()
    {
		$id = Yii::$app->user->identity->id;
        $model = $this->findModel($id);
		$model->scenario = 'update';
		$model->modified_at = new Expression('NOW()');
		
		
		if ($model->upload_image = UploadedFile::getInstance($model,'upload_image')) {
			$str = 'uploads/' . $model->upload_image->baseName . '.' . $model->upload_image->extension;
			$model->upload_image->saveAs($str);
			$model->user_image = $str;
		}
		
		
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['update-profile', 'id' => $model->id]);
        } else {
            return $this->render('profile', [
                'model' => $model,
            ]);
        }
    }
	
	
	
	public function actionUpdatePassword()
    {
		$id = Yii::$app->user->identity->id;
        $model = $this->findModel($id);
		$model->scenario = 'password';
		$model->modified_at = new Expression('NOW()');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
			
            return $this->redirect(['password', 'id' => $model->id]);
        } else {
            return $this->render('password', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Users model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Users model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Users the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
	
	public function actionUserListJson($q = null, $id = null) {
		
		\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		
		$out = ['results' => ['id' => '', 'text' => '']];
		if (!is_null($q)) {
			$query = new Query;
			$query->select(['id', 'concat(fullname, " - ", email) AS text'])
				->from('user')
				->where(['like', 'fullname', $q])
				->orWhere(['like', 'email', $q])
				->limit(20);
			$command = $query->createCommand();
			$data = $command->queryAll();
			$out['results'] = array_values($data);
		}
		elseif ($id > 0) {
			$out['results'] = ['id' => $id, 'text' => User::find($id)->fullname];
		}
		return $out;
	}
}
