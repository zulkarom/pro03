<?php 

use yii\helpers\Html;
use backend\modules\conference\models\Conference;
?>

    <section id="schedule" class="section-with-bg">
      <div class="container wow fadeInUp">
        <div class="section-header">
          <h2>UPCOMING CONFERENCES</h2>
          <p>Here is the upcoming conferences hosted by us</p>
        </div>


        <div class="tab-content row justify-content-center">

          <!-- Schdule Day 1 -->
          <div role="tabpanel" class="col-lg-9 tab-pane fade show active" id="day-1">
		  
		  <?php 
		  $conferences = Conference::find()->all();
		  
		  if($conferences){
			  foreach($conferences as $conf){
				  echo '<div class="row schedule-item">
              <div class="col-md-2"><time>'.date('d M Y', strtotime($conf->date_start)) .'</time></div>
              <div class="col-md-7">
                <h4>'.$conf->conf_name .' ('.$conf->conf_abbr .')</p>
              </div>
			  <div class="col-md-3">
			  '.$conf->conf_venue.'
			  </div>
            </div>';
			  }
		  }
		  
		  
		  
		  ?>



          </div>
		  
		  

        </div>
		
		<div align="center" style="margin-top:30px;"><a href="#about" class="red-button">More Conferences</a> </div>
		
		
		
		
		

      </div>

    </section>