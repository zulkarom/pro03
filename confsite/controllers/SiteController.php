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
use common\models\UploadFile;

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
		$this->layout = 'main-list';
		$searchModel = new ConferenceSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
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
	
	public function actionMember($confurl=null)
    {
		$this->layout = 'main-member';
		$model = $this->findConferenceByUrl($confurl);
		
		if($confurl){
			return $this->render('member', [
			'model' => $model
        ]);
		}
		
    }
	
	public function actionLogin($confurl=null)
    {
		if (!Yii::$app->user->isGuest) {
            return $this->redirect(['site/member', 'confurl' => $confurl]);
        }
		
		//$conf = $this->findConferenceByUrl($confurl);
		
		if($confurl){
			$model = new LoginForm();
			if ($model->load(Yii::$app->request->post()) && $model->login()) {
				return $this->redirect(['site/member', 'confurl' => $confurl]);
			} else {
				return $this->render('login', [
					'model' => $model,
				]);
			}
		}

    }
	
	public function actionLogout($confurl=null){
		if($confurl){
			Yii::$app->user->logout();
			return $this->redirect(['site/login', 'confurl' => $confurl]);
		}
	}
	
	
	protected function findConferenceByUrl($url)
    {
        if (($model = Conference::findOne(['conf_url' => $url])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
	
	public function actionDownloadFile($attr, $url, $identity = true){
        $attr = $this->clean($attr);
        $model = $this->findConferenceByUrl($url);
        $filename = strtoupper($attr);
        UploadFile::download($model, $attr, $filename);
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
	
}
