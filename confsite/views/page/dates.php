<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->title = 'IMPORTANT DATES';
$this->params['breadcrumbs'][] = $this->title;

?>


<h4 class="m-text23 p-t-56 p-b-34">IMPORTANT DATES</h4>
<div class="item-blog-txt">
<ul class="style-menu">
						<?php 
						
						$dates = $model->confDates;
						if($dates){
							foreach($dates as $date){
								echo '<li class="p-t-6 p-b-8 bo7">
								<a href="#" class="s-text13 p-t-5 p-b-5">
									'.$date->date_name .': 
									<strong><i class="fa fa-calendar"></i> '.date('d F Y', strtotime($date->date_start)) .'</strong>
								</a>
							</li>';
							}
						}
						
						?>
						
						

							
						</ul>
									</div>