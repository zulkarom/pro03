<?php
namespace confsite\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\NotFoundHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\ForbiddenHttpException;
use yii\db\Expression;
use backend\modules\conference\models\Conference;
use confsite\models\ConferenceSearch;
use common\models\LoginForm;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            /* 'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', ],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ], */
          
        ];
    }


    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
		return $this->render('index', [
		
        ]);
		
    }
	
	public function actionHome($confurl=null)
    {
		$model = $this->findConferenceByUrl($confurl);
		
		if($confurl){
			return $this->render('home', [
			'model' => $model
        ]);
		}
		
    }
	
	public function actionLogin($confurl=null)
    {
		if (!Yii::$app->user->isGuest) {
            //return $this->goHome();
        }
		
		$conf = $this->findConferenceByUrl($confurl);
		
		if($confurl){
			$model = new LoginForm();
			if ($model->load(Yii::$app->request->post()) && $model->login()) {
				//return $this->goBack();
				return $this->goHome();
			} else {
				return $this->render('login', [
					'model' => $model,
				]);
			}
		}

    }
	
	
	protected function findConferenceByUrl($url)
    {
        if (($model = Conference::findOne(['conf_url' => $url])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
	
	
	
    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->redirect(['/user/login']);
    }

   
	
	
}
