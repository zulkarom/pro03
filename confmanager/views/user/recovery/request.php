<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var yii\widgets\ActiveForm $form
 * @var dektrium\user\models\RecoveryForm $model
 */

$this->title = Yii::t('user', 'Recover your password');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="block-content">
		<div class="container">
		

		
		<div align="center"><b> <?=$this->title?> </b></div>
<br />
		
			<div class="row">
		
			<div class="col-lg-12" align="center">
			
			<?php $form = ActiveForm::begin([
                    'id' => 'password-recovery-form',
                    'enableAjaxValidation' => true,
                    'enableClientValidation' => false,
                ]); ?>

                <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>

                <?= Html::submitButton(Yii::t('user', 'Continue'), ['class' => 'au-btn au-btn--red m-b-20']) ?><br>

                <?php ActiveForm::end(); ?>
			
			
			</div>
			</div>
			
			
			<br />

	 <p>
                <?= Html::a('GO TO LOGIN PAGE',['/user/login']) ?>
            </p>
			
			
		</div>
	</div>
	
	
