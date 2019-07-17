<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\ChangePasswordForm */
/* @var $form ActiveForm */
 
$this->title = 'Change Password';
?>


<?=$this->render('../site/_img_user')?>


<div class="block-content">


		<div class="container">
			<div class="row  text-center">
				<div class="col">
					
				</div>

			</div>
			
			
			
<div class="row">
<div class="col-md-6">
<h2 class="section_title">User Profile</h2>

<div>Username : <?=Yii::$app->user->identity->email?></div>
<div>Name : <?=Yii::$app->user->identity->fullname?></div>
	
	
	</div>
<div class="col-md-6">

<div class="user-changePassword">
 
   <h2 class="section_title">Change Password</h2>
	
	 <?php
	 if($good == 1){
		 echo '<p>Your password has been successfully changed.</p>';
	 }else{
		 echo $this->render('_form_pass', [
			'model' => $model
		]);
	 }
	 
    ?>
 
</div>

</div>
</div>
			
			
			</div>
			</div>

<div>


	</div>

<br /><br /><br /><br />
