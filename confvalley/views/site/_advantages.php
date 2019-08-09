<?php
use backend\modules\conference\models\ConfvalleyAdvantage;

?>
	<section id="supporters" class="section-with-bg wow fadeInUp">
    <div class="container">
	
	<div class="section-header">
          <h2>Advantages</h2>
        </div>
		<style>
		.advantage{
			text-align:center;
		}
		.advantage-icon{
			font-size: 4.5rem;
		}
		.advantage-con{
			margin-bottom:20px;
		}
		</style>
		
      <div class="row">
	  <?php 
	  
	  $advantages = ConfvalleyAdvantage::find()->all();
	  if($advantages){
		  foreach($advantages as $adv){
			  echo '<div class="col-lg-3">
          <div  class="advantage" style="margin-top:20px">
            <div class="advantage-con">
			<i class="fa fa-'.$adv->adv_icon .'" style="font-size: 4.5rem;"></i>

            </div>
            <h3>'.$adv->adv_title .'</h3>
            <p class="lead mb-0">'.$adv->adv_desc .'</p>
          </div>
        </div>';
		  }
	  }
	  
	  ?>
        
      </div>
    </div>
  </section>
