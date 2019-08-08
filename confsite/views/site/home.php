<?php 

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->title= 'CONFERENCE VALLEY';

$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@confsite/views/myasset');


?>

<div class="item-blog-txt p-t-33">
								<h4 class="p-b-11">
									<a href="blog-detail.html" class="m-text24">
										<?=$model->conf_name?>
									</a>
								</h4>

								

								<p class="p-b-12">
									<?=nl2br($model->conf_background)?></p>


						
							</div>
							
							
							<div class="item-blog-txt p-t-33">
								<h4 class="p-b-11">
									<a href="blog-detail.html" class="m-text24">
										Scope
									</a>
								</h4>

								

								<p class="p-b-12">
									The following is by no means an exhaustive list but it gives an idea of the topics that could possibly be discussed by participants at the event.</p>
									
									<ul>
					<li class="p-b-9">
						<a href="#" >
							Men
						</a>
					</li>

					<li class="p-b-9">
						<a href="#" >
							Women
						</a>
					</li>

			
				</ul>

									
									


								
							</div>