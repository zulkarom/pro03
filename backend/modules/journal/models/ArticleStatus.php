<?php

namespace backend\modules\journal\models;

use Yii;
use common\models\workflows\ArticleWorkflow;

class ArticleStatus
{
	public static function submissionStatus(){
		return array_merge(self::reviewStatus(), self:: editingStatus());
	}
	
	public static function canWithdraw(){
		
		return [
		'ArticleWorkflow/ba-pre-evaluate', 
		'ArticleWorkflow/bm-payment-pending',
		'ArticleWorkflow/bo-payment-submit',
		'ArticleWorkflow/bt-assign-associate', 
		'ArticleWorkflow/ca-assign-reviewer',
		'ArticleWorkflow/da-review', 
		'ArticleWorkflow/ga-response', 
		'ArticleWorkflow/ia-post-evaluate',
		'ArticleWorkflow/ha-correction', 
		];
	}
	
	public static function reviewStatus(){
		return [
		'ArticleWorkflow/bt-assign-associate', 
		'ArticleWorkflow/ca-assign-reviewer',
		'ArticleWorkflow/da-review', 
		'ArticleWorkflow/ga-response', 
		'ArticleWorkflow/ia-post-evaluate',
		'ArticleWorkflow/ha-correction', 
		];
	}
	
	public static function editingStatus(){
		return [
		'ArticleWorkflow/oa-camera-ready', 
		];
	}
	
	public static function publishStatus(){
		return [
		'ArticleWorkflow/pa-assign-journal'
		];
	}
	
	public static function acceptStatus(){
		return [
		'ArticleWorkflow/pa-assign-journal',
		'ArticleWorkflow/oa-camera-ready',
		'ArticleWorkflow/qa-publish'
		];
	}
	
	public static function getAllStatusesArray(){
		$cl = new ArticleWorkflow;
		$status = $cl->getDefinition();
		$array = array();
		foreach($status['status'] as $key=>$s){
			$array['ArticleWorkflow/' . $key] = $s['label'];
		}
		return $array;
	}

}
