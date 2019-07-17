<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use common\models\Todo;
use yii\bootstrap\Modal;
use backend\modules\journal\models\ReviewForm;
use common\models\Upload;

/* @var $this yii\web\View */
/* @var $model common\models\Application */

$this->title = 'Assign Journal Issue';

$this->params['breadcrumbs'][] = ['label' => 'Publishing', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$status = $model->wfStatus;

echo $this->render('_view_info', [
			'model' => $model,
	]);



?>


<?php 
if($status == 'assign-journal' or $status == 'publish' && Todo::can('journal-managing-editor') ){
	?>

	<?php
	
	echo $this->render('_form_assign', [
			'model' => $model,
	]);
}
?>

