<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\web\JsExpression;
use common\models\User;
use common\models\Country;
use common\models\UploadFile;
use dosamigos\tinymce\TinyMce;


$model->file_controller = 'conference';

/* @var $this yii\web\View */
/* @var $model backend\modules\conference\models\Conference */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="card">

            <div class="card-body"><div class="conference-form">
			
			<div class="form-group">
			<label>Conference Url</label>
			<h4><?=$model->conf_url?><h4>
			
			</div>

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'conf_name')->textInput(['maxlength' => true]) ?>
	
	<div class="row">
<div class="col-md-4"><?= $form->field($model, 'conf_abbr')->textInput(['maxlength' => true])->label('Abbreviation') ?></div>

<div class="col-md-4"> <?=$form->field($model, 'date_start')->widget(DatePicker::classname(), [
    'removeButton' => false,
    'pluginOptions' => [
        'autoclose'=>true,
        'format' => 'yyyy-mm-dd',
        'todayHighlight' => true,
        
    ],
    
    
]);
?>
</div>

</div>

    
    <?= $form->field($model, 'conf_venue')->textInput(['maxlength' => true]) ?>
	


<!-- for image -->
<?=UploadFile::fileInput($model, 'banner', true)?>
<i>Dimensions (px) : 1349 x 316 </i>
<br /><br />
<div class="row">
<div class="col-md-3">
<?php 
if(empty($model->currency_int)){
	$model->currency_int = 'USD';
}
$arr_curr = ArrayHelper::map(Country::find()->all(), 'currency_code', 'currency_code');
echo $form->field($model, 'currency_int')->widget(Select2::classname(), [
    'data' => $arr_curr,
    'language' => 'en',
    'options' => ['multiple' =>false,'placeholder' => 'Select...'],
    'pluginOptions' => [
        'allowClear' => true
    ],
]);

?>

</div>
<div class="col-md-3"><?php echo $form->field($model, 'currency_local')->widget(Select2::classname(), [
    'data' => $arr_curr,
    'language' => 'en',
    'options' => ['multiple' =>false,'placeholder' => 'Select...'],
    'pluginOptions' => [
        'allowClear' => true
    ],
]);

?></div>



</div>

<br />
<div class="row">
<div class="col-md-6">
<div class="form-group">
<label>MENUS</label><br />
<?php 
$old_page_menu = $model->page_menu ? json_decode($model->page_menu) : [];
foreach($model->pages as $key=>$val){
	$chk = in_array($key,$old_page_menu) ? 'checked' : '';
	echo '<label><input type="checkbox" name="page-menu[]" value="'.$key.'" '.$chk.' /> '.$val[0].'</label><br />';
}

?>

</div>
</div>

<div class="col-md-6">
<div class="form-group">

<label>SHOWING AT FRONT</label><br />
<?php 
$old_page_featured = $model->page_featured ? json_decode($model->page_featured) : [];
foreach($model->pages as $key=>$val){
	$chk = in_array($key,$old_page_featured) ? 'checked' : '';
	echo '<label><input type="checkbox" name="page-featured[]" value="'.$key.'" '.$chk.' /> '.$val[0].'</label><br />';
}

?>

</div>
</div>

</div>



<br /><br />

<?php 
$plugin = [
            "advlist autolink lists link charmap",
            "searchreplace visualblocks code fullscreen",
            "paste"
        ];
$toolbar = "undo redo | bold italic forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent link code | fontselect fontsizeselect styleselect ";

$options = [
        'plugins' => $plugin,
		'menubar' => false,
        'toolbar' => $toolbar
    ];

?>

<?= $form->field($model, 'announcement')->widget(TinyMce::className(), [
    'options' => ['rows' => 2],
    'language' => 'en',
    'clientOptions' => $options
])->label('Announcement');?>


<?= $form->field($model, 'conf_background')->widget(TinyMce::className(), [
    'options' => ['rows' => 14],
    'language' => 'en',
    'clientOptions' => $options
])->label('Background');?>

<?= $form->field($model, 'conf_scope')->widget(TinyMce::className(), [
    'options' => ['rows' => 14],
    'language' => 'en',
    'clientOptions' => $options
])->label('Scope');?>

<?= $form->field($model, 'conf_lang')->widget(TinyMce::className(), [
    'options' => ['rows' => 5],
    'language' => 'en',
    'clientOptions' => $options
])->label('Language');?>

<?= $form->field($model, 'conf_publication')->widget(TinyMce::className(), [
    'options' => ['rows' => 18],
    'language' => 'en',
    'clientOptions' => $options
])->label('Publication');?>

<?= $form->field($model, 'conf_submission')->widget(TinyMce::className(), [
    'options' => ['rows' => 14],
    'language' => 'en',
    'clientOptions' => $options
])->label('Registration Submission');?>

<?= $form->field($model, 'conf_accommodation')->widget(TinyMce::className(), [
    'options' => ['rows' => 14],
    'language' => 'en',
    'clientOptions' => $options
])->label('Accommodation');?>

<?= $form->field($model, 'conf_award')->widget(TinyMce::className(), [
    'options' => ['rows' => 14],
    'language' => 'en',
    'clientOptions' => $options
])->label('Award');?>

<?= $form->field($model, 'conf_committee')->widget(TinyMce::className(), [
    'options' => ['rows' => 14],
    'language' => 'en',
    'clientOptions' => $options
])->label('Committee');?>

<?= $form->field($model, 'conf_contact')->widget(TinyMce::className(), [
    'options' => ['rows' => 5],
    'language' => 'en',
    'clientOptions' => $options
])->label('Contact');?>


    <div class="form-group">
        <?= Html::submitButton('Save Setting', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div></div>
</div>
