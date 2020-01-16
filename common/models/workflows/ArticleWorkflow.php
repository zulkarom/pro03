<?php

namespace common\models\workflows;

class ArticleWorkflow implements \raoul2000\workflow\source\file\IWorkflowDefinitionProvider
{
	
	public function getDefinition() {
		return [
			'initialStatusId' => 'aa-draft',
			'status' => [
				'aa-draft' => [
					'label' => 'Draft',
					'transition' => ['ba-pre-evaluate'],
					'metadata' => [
						'color' => 'danger',
						'start_at' => 'draft_at'
						//'icon' => 'fa fa-bell'
					]
				],
				'ba-pre-evaluate' => [
					'label' => 'Pre-Evaluate',
					'transition' => ['bm-payment-pending', 'ra-reject', 'sa-withdraw-request'],
					'metadata' => [
						'color' => 'info',
						'start_at' => 'submit_at'
						//'icon' => 'fa fa-bell'
					]
				],
				'bm-payment-pending' => [
					'label' => 'Pending Payment',
					'transition' => ['bo-payment-submit', 'sa-withdraw-request'],
					'metadata' => [
						'color' => 'danger',
						'start_at' => 'pre_evaluate_at'
						//'icon' => 'fa fa-bell'
					]
				],
				//admin can proceed to back to pending
				'bo-payment-submit' => [
					'label' => 'Payment Submitted',
					'transition' => ['bt-assign-associate', 'bm-payment-pending', 'sa-withdraw-request'],
					'metadata' => [
						'color' => 'warning',
						'start_at' => 'payment_submit_at'
						//'icon' => 'fa fa-bell'
					]
				],
				'bt-assign-associate' => [
					'label' => 'Assign Associate',
					'transition' => ['ca-assign-reviewer', 'sa-withdraw-request'],
					'metadata' => [
						'color' => 'info',
						'start_at' => 'payment_verified_at'
						//'icon' => 'fa fa-bell'
					]
				],
				'ca-assign-reviewer' => [
					'label' => 'Assign Reviewer',
					'transition' => ['da-review', 'sa-withdraw-request'],
					'metadata' => [
						'color' => 'warning',
						'start_at' => 'asgn_associate_at'
						//'icon' => 'fa fa-bell'
					]
				],
				
				'da-review' => [
					'label' => 'Review',
					'transition' => ['ga-response', 'sa-withdraw-request'],
					'metadata' => [
						'color' => 'success',
						'start_at' => 'asgn_reviewer_at'
						//'icon' => 'fa fa-bell'
					]
				],
				
				
				'ga-response' => [
					'label' => 'Response to Author',
					'transition' => ['ha-correction', 'oa-camera-ready','ra-reject', 'sa-withdraw-request', 'ia-post-evaluate'],
					'metadata' => [
						'color' => 'info',
						'start_at' => 'review_submit_at'
						//'icon' => 'fa fa-bell'
					]
				],
				
				'ha-correction' => [
					'label' => 'Correction',
					'transition' => ['ia-post-evaluate', 'sa-withdraw-request'],
					'metadata' => [
						'color' => 'primary',
						'start_at' => 'response_at'
						//'icon' => 'fa fa-bell'
					]
				],
				
				'ia-post-evaluate' => [
					'label' => 'Post Evaluate',
					'transition' => ['oa-camera-ready'],
					'metadata' => [
						'color' => 'success',
						'start_at' => 'correction_at'
						//'icon' => 'fa fa-bell'
					]
				],
				
				
				'oa-camera-ready' => [
					'label' => 'Camera Ready',
					'transition' => ['pa-assign-journal'],
					'metadata' => [
						'color' => 'success',
						'start_at' => 'post_evaluate_at'
						//'icon' => 'fa fa-bell'
					]
				],
				'pa-assign-journal' => [
					'label' => 'Assign Journal',
					'transition' => ['qa-publish'],
					'metadata' => [
						'color' => 'warning',
						//'icon' => 'fa fa-bell'
					]
				],
				'qa-publish' => [
					'label' => 'Journal',
					'metadata' => [
						'color' => 'warning',
						//'icon' => 'fa fa-bell'
					]
				],
				'ra-reject' => [
					'label' => 'Reject',
					'metadata' => [
						'color' => 'warning',
						'start_at' => 'reject_at'
						//'icon' => 'fa fa-bell'
					]
				],
				'sa-withdraw-request' => [
					'label' => 'Withdraw Request',
					'transition' => ['ta-withdraw','ha-correction','ga-response','da-review','ca-assign-reviewer','ba-pre-evaluate'],
					'metadata' => [
						'color' => 'danger',
						//'icon' => 'fa fa-bell'
					]
				],
				'ta-withdraw' => [
					'label' => 'Withdraw',
					'metadata' => [
						'color' => 'primary',
						//'icon' => 'fa fa-bell'
					]
				],
				]
			]
			;
	}
}






?>