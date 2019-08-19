<?php

use yii\helpers\Url;

?>

	<h4 class="m-text23 p-t-56 p-b-34">
		MENU
	</h4>

	<ul class="style-menu">
		<li class="p-t-6 p-b-8 bo6">
			<a href="<?=Url::to(['page/submission','confurl' => $conf->conf_url])?>" class="s-text13 p-t-5 p-b-5">
				REGISTRATION & SUBMISSION
			</a>
		</li>
		
		<li class="p-t-6 p-b-8 bo7">
			<a href="<?=Url::to(['page/scope','confurl' => $conf->conf_url])?>" class="s-text13 p-t-5 p-b-5">
				SCOPES
			</a>
		</li>

		<li class="p-t-6 p-b-8 bo7">
			<a href="<?=Url::to(['page/dates','confurl' => $conf->conf_url])?>" class="s-text13 p-t-5 p-b-5">
				IMPORTANT DATES
			</a>
		</li>
		
		<li class="p-t-6 p-b-8 bo7">
			<a href="<?=Url::to(['page/fees','confurl' => $conf->conf_url])?>" class="s-text13 p-t-5 p-b-5">
				FEES AND PAYMENT
			</a>
		</li>
		
		<li class="p-t-6 p-b-8 bo7">
			<a href="<?=Url::to(['page/publication','confurl' => $conf->conf_url])?>" class="s-text13 p-t-5 p-b-5">
			PUBLICATION
			</a>
		</li>
		
		<li class="p-t-6 p-b-8 bo7">
			<a href="<?=Url::to(['page/accommodation','confurl' => $conf->conf_url])?>" class="s-text13 p-t-5 p-b-5">
			VANUE & ACCOMMODATION
			</a>
		</li>
		
		<li class="p-t-6 p-b-8 bo7">
			<a href="#" class="s-text13 p-t-5 p-b-5">
			AWARD
			</a>
		</li>

		

		

		<li class="p-t-6 p-b-8 bo7">
			<a href="#" class="s-text13 p-t-5 p-b-5">
				COMMITTEE
			</a>
		</li>
		
	</ul>
	
	<!-- Categories -->
	<h4 class="m-text23 p-t-56 p-b-34">
		RESOURCES
	</h4>

	<ul class="style-menu">
	
	<?php 
	
	$downloads = $conf->confDownloads;
	if($downloads){
		foreach($downloads as $d){
			echo '<li class="p-t-6 p-b-8 bo7">
			<a href="'.Url::to(['download/download-file', 'id' => $d->id]).'" class="s-text13 p-t-5 p-b-5" target="_blank">
				'.$d->download_name .'
			</a>
		</li>';
		}
	}
	
	?>
	


		
	</ul>