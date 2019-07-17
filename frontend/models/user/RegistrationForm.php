<?php
namespace frontend\models\user;

//use dektrium\user\models\User;
use Yii;
use dektrium\user\models\RegistrationForm as BaseRegistrationForm;
use backend\modules\jeb\models\Associate;

/**
 * Signup form
 */
class RegistrationForm extends BaseRegistrationForm
{
	public $fullname;
	
	public $institution;
	
	public $country_id;
	
	public $password_repeat;
	
	public function rules()
    {
        $rules = parent::rules();
		
		$rules['password_repeatRequired'] = ['password_repeat', 'required'];
		
		$rules['fullnameRequired'] = ['fullname', 'required'];
		
		$rules['country_idRequired'] = ['country_id', 'required'];
		
		$rules['institutionRequired'] = ['institution', 'required'];

		
		$rules['password_repeatCompare'] = ['password_repeat', 'compare', 'compareAttribute'=>'password', 'message'=>"Passwords don't match" ];
		

		//
        return $rules;
    }
	
	/* public function attributeLabels()
    {
		$label = parent::attributeLabels();
		$label['username'] = 'No. Kad Pengenalan';
		$label['password'] = 'Kata Laluan';
		$label['password_repeat'] = 'Ulang Kata Laluan';
        return $label;
    } */
	
	public function register()
    {
        if (!$this->validate()) {
            return false;
        }

        /** @var User $user */
        $user = Yii::createObject(User::className());
        $user->setScenario('register');
        $this->loadAttributes($user);

        if ($user->register()) {
            $assoc = new Associate;
			$assoc->user_id = $user->id;
			$assoc->country_id = $this->country_id;
			$assoc->institution = $this->institution;
			if($assoc->save()){
				Yii::$app->session->setFlash(
				'info',
				Yii::t(
					'user',
						'Your account has been created and a message with further instructions has been sent to your email'
					)
				);
			}
			
			
        }else{
			return false;
		}
		

		
		
		

        

        return true;
    }


}
