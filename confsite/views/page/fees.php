<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->title = 'FEES';
$this->params['breadcrumbs'][] = $this->title;

?>


<h4 class="m-text23 p-t-56 p-b-34">CONFERENCE FEES</h4>


<div class="table-responsive">
  <table class="table table-hover">
    <thead>
      <tr>
        <th>Categories</th>
        <th>Early Bird</th>
        <th>Normal</th>
      </tr>
    </thead>
    <tbody>
	
	<?php 
	$fees = $model->confFees;
	if($fees ){
		foreach($fees as $fee){
			echo '<tr>
        <td>'.$fee->fee_name .'</td>
        <td>'.$fee->fee_currency .' '.$fee->fee_early .'</td>
        <td>'.$fee->fee_currency .' '.$fee->fee_amount .'</td>
      </tr>';
		}
		
	}
	
	
	?>
      
    </tbody>
  </table>
</div>



<div class="item-blog-txt p-t-33">
								<h4 class="p-b-11">
									<a href="blog-detail.html" class="m-text24">
										PAYMENT INFOMATION
									</a>
								</h4>

								

								<p class="p-b-12">
									</p>
									
									<?=$model->payment_info?>
									
								
							</div>