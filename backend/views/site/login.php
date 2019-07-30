<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = 'Sign In';

?>


<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-6 col-lg-6 col-md-6">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
			<?php $form = ActiveForm::begin(['id' => 'login-form',
				'options' => [
                'class' => 'user'
             ]

			]); ?>

            <div class="row">
             
              <div class="col-lg-12">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Administrator</h1>
                  </div>
              
                    
					
					<?= $form
            ->field($model, 'username')
            ->label(false)
            ->textInput(['class' => 'form-control form-control-user', 'placeholder' => $model->getAttributeLabel('username')]) ?>
					
                     
					  <?= $form
            ->field($model, 'password')
            ->label(false)
            ->passwordInput(['class' => 'form-control form-control-user','placeholder' => $model->getAttributeLabel('password')]) ?>
                    
          
                    <div class="form-group">
                      <div class="custom-control custom-checkbox small">
                       
						 <?= $form->field($model, 'rememberMe')->checkbox() ?>
                        
                      </div>
                    </div>
					<?= Html::submitButton('Sign in', ['class' => 'btn btn-primary btn-user btn-block', 'name' => 'login-button']) ?>
                   
            
                 
        
                </div>
              </div>
            </div>
			 <?php ActiveForm::end(); ?>
          </div>
        </div>

      </div>

    </div>

  </div>
