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
									<?=nl2br($model->conf_background)?>
								</p>


						
							</div>
							
							
							<div class="item-blog-txt p-t-33">
								<h4 class="p-b-11">
									<a href="blog-detail.html" class="m-text24">
										Scope
									</a>
								</h4>

								

								<p class="p-b-12">
									<?=$model->conf_scope?></p>
									
								
							</div>
							
							<?php if($model->conf_lang){ ?>
							<div class="item-blog-txt p-t-33">
								<h4 class="p-b-11">
									<a href="blog-detail.html" class="m-text24">
										Language
									</a>
								</h4>

								

								<p class="p-b-12">
									<?=$model->conf_lang?></p>
									
								
							</div>
							<?php } ?>
							
							<?php if($model->conf_publication){ ?>
							
							<div class="item-blog-txt p-t-33">
								<h4 class="p-b-11">
									<a href="blog-detail.html" class="m-text24">
										Publication
									</a>
								</h4>

									<?=$model->conf_publication?>
									
								
							</div>
							<?php } ?>
							
							
							<div class="item-blog-txt p-t-33">
								<h4 class="p-b-11">
									<a href="blog-detail.html" class="m-text24">
										Registration and Submission
									</a>
								</h4>

								

								<p class="p-b-12">
									<?=$model->conf_submission?></p>
									
								
							</div>
							
							<div class="item-blog-txt p-t-33">
								<h4 class="p-b-11">
									<a href="blog-detail.html" class="m-text24">
										Contact Person
									</a>
								</h4>

								

								<p class="p-b-12">
									<?=$model->conf_contact?></p>
									
								
							</div>