<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use backend\modules\journal\models\Journal;
use backend\modules\journal\models\JournalIssue;
use richardfan\widget\JSRegister;


$form = ActiveForm::begin(); ?>
 

<div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Assign Journal Volume Form</h6>
            </div>
            <div class="card-body">
			
			
		<div class="row">
		<div class="col-md-4"><?=$form->field($model, 'journal_id')->dropDownList(
        ArrayHelper::map(Journal::find()->all(),'id', 'journal_abbr'), ['prompt' => 'Please Select' ]
    )->label('Choose Journal');
?>	</div>	
		</div>	
			
			
			<div class="row">
			
			
		
		


<div class="col-md-8">



<?=$form->field($model, 'journal_issue_id')->dropDownList(
        ArrayHelper::map(JournalIssue::listCompilingJournal($model->journal_id),'id', 'journalIssueName'), ['prompt' => 'Please Select' ]
    )->label('Choose Journal Volume & Issue');
?>


	
	</div>

	
	
</div>

	
	

<div class="form-group">

		
	<?=Html::submitButton('Assign Journal Issue', ['class' => 'btn btn-primary', 'name' => 'wfaction', 'value' => 'recommend', 'data' => [
                'confirm' => 'Are you sure to send this article to journal?'
            ],
])?>

    </div>
<?php 

ActiveForm::end(); 

?></div>
</div>






<?php JSRegister::begin(); ?>
<script>
$("#article-journal_id").change(function(){
	putOption();
});

function putOption(){
	var target_id =  'article-journal_issue_id';
	var journal =  $('#article-journal_id').val();
	$('#' + target_id).html('<option>Loading...</option>');
	var url = '<?=Url::to(['publish/list-issues', 'journal' => '']) ?>' + journal ;
	
	console.log(url)
	
	$.ajax({url:  url, success: function(result){
	var str = '';
	if(result){
		var reviewer = JSON.parse(result);
		console.log(reviewer);
		
		for(var id in reviewer) {
		   str += '<option value=\"' + id +  '\">' + reviewer[id] + '</option>';
		}

	}
		
	$('#' + target_id).html(str);
	
	
    }});
	
}
</script>
<?php JSRegister::end(); ?>
