<?php 

use yii\helpers\Url;
$dirAsset = Yii::$app->assetManager->getPublishedUrl('@backend/views/assets');
use backend\modules\journal\models\Menu;
use backend\modules\journal\models\Journal;

?>
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?=Url::to(['/site/index'])?>">
      
        <div class="sidebar-brand-text mx-3"><img width="100%" src="<?=$dirAsset?>/img/logo.jpg" /></div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="<?=Url::to(['/site/index'])?>">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">
	  
	  <?php 
	  if(Yii::$app->controller->id == 'journal-update' or Yii::$app->controller->id == 'journal-scope'){
		  $id = Yii::$app->request->queryParams['id'];
		  $journal = Journal::findOne($id);
		  
	  ?>
	  <li class="nav-item" style="display:none" id="journal_update_menu">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseJournalUpdate" aria-expanded="true" aria-controls="collapseJournalUpdate">
          <i class="fas fa-fw fa-book"></i>
          <span><?=$journal->journal_abbr?></span>
        </a>
        <div id="collapseJournalUpdate" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
		  <a class="collapse-item" href="<?=Url::to(['/journal/journal/index'])?>"><i class="fa fa-arrow-left"></i> Journal List</a>
            <a class="collapse-item" href="<?=Url::to(['/journal/journal-update/update', 'id' => $id])?>">Basic Profile</a>
            <a class="collapse-item" href="<?=Url::to(['/journal/journal-scope/index', 'id' => $id])?>">Journal Scope</a>
			
			<a class="collapse-item" href="<?=Url::to(['/journal/journal-update/editorial-board', 'id' => $id])?>">Editorial Board</a>
			
			<a class="collapse-item" href="<?=Url::to(['/journal/journal-update/ethics', 'id' => $id])?>">Publication Ethics</a>
			
			<a class="collapse-item" href="<?=Url::to(['/journal/journal-update/submission', 'id' => $id])?>">Submission</a>
			<a class="collapse-item" href="<?=Url::to(['/journal/journal-update/template', 'id' => $id])?>">Template</a>
          </div>
        </div>
      </li>
	<?php } ?>
      <!-- Heading -->
      <div class="sidebar-heading">
        Journal
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseJournal" aria-expanded="true" aria-controls="collapseJournal">
          <i class="fas fa-fw fa-book"></i>
          <span>Journal</span>
        </a>
        <div id="collapseJournal" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="<?=Url::to(['/journal/journal/create'])?>">New Journal</a>
            <a class="collapse-item" href="<?=Url::to(['/journal/journal/index'])?>">List of Journal</a>
			<a class="collapse-item" href="<?=Url::to(['/journal/journal-issue/index'])?>">Journal Issues <span class="badge badge-warning badge-counter"><?=Menu::compilingIssue()?></span></a>
			<a class="collapse-item" href="<?=Url::to(['/journal/journal/published'])?>">Published Articles</a>
			
			 
			 
			 
          </div>
        </div>
      </li>

      <!-- Nav Item - Utilities Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePapers" aria-expanded="false" aria-controls="collapsePapers">
          <i class="fas fa-fw fa-book"></i>
          <span>Manuscript</span>
        </a>
        <div id="collapsePapers" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
			<a class="collapse-item" href="<?=Url::to(['/journal/submission/index'])?>">Submission <span class="badge badge-danger badge-counter"><?=Menu::submission()?></span></a>
			<a class="collapse-item" href="<?=Url::to(['/journal/payment/index'])?>"><i class="fas fa-dollar-sign"></i> Payment <span class="badge badge-info badge-counter"><?=Menu::payment()?></span></a>
            <a class="collapse-item" href="<?=Url::to(['/journal/review/index'])?>">Review <span class="badge badge-warning badge-counter"><?=Menu::review()?></span></a>
            <a class="collapse-item" href="<?=Url::to(['/journal/editing/index'])?>">Editing <span class="badge badge-warning badge-counter"><?=Menu::editing()?></span></a>
            <a class="collapse-item" href="<?=Url::to(['/journal/publish/index'])?>">Publishing <span class="badge badge-success badge-counter"><?=Menu::publish()?></a>
			
			<hr style="margin:5px;" />
			 
			 <a class="collapse-item" href="<?=Url::to(['/journal/article-overwrite'])?>">Overwrite</a>
			 
			 

          </div>
        </div>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Administration
      </div>
	  
	  <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAccount" aria-expanded="true" aria-controls="collapseAccount">
          <i class="fas fa-dollar-sign"></i>
          <span>Account</span>
        </a>
        <div id="collapseAccount" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
		  
		  <a class="collapse-item" href="<?=Url::to(['/account/invoice'])?>">Invoices</a>
		  
		
		  

          </div>
        </div>
      </li>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUser" aria-expanded="true" aria-controls="collapseUser">
          <i class="fas fa-fw fa-users"></i>
          <span>Users</span>
        </a>
        <div id="collapseUser" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
		  
		  <a class="collapse-item" href="<?=Url::to(['/user/create'])?>">New User</a>
		  
		 <!--  <a class="collapse-item" href="<?=Url::to(['/user/editor'])?>">Editors</a> -->
		  
		  <a class="collapse-item" href="<?=Url::to(['/user/reviewer'])?>">Reviewers</a>
		  
            <a class="collapse-item" href="<?=Url::to(['/user/assignment'])?>">All Users</a>
			
            <a class="collapse-item" href="#">Role List</a>
            <a class="collapse-item" href="#">Route List</a>
          </div>
        </div>
      </li>
	  
	  <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">
	  
	  <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSetting" aria-expanded="true" aria-controls="collapseSetting">
          <i class="fas fa-fw fa-cog"></i>
          <span>Setting</span>
        </a>
        <div id="collapseSetting" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
		  
		  <a class="collapse-item" href="<?=Url::to(['/journal/email-template'])?>">Emails Template</a>
		  
		  <a class="collapse-item" href="<?=Url::to(['/journal/setting'])?>">General Setting</a>
		  <a class="collapse-item" href="<?=Url::to(['/journal/scope'])?>">Scope</a>
		  <a class="collapse-item" href="<?=Url::to(['/journal/scope-cat'])?>">Scope Category</a>
		  
		  
		
          </div>
        </div>
      </li>

     
      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>

<?php 
$js = '';
$controller = Yii::$app->controller->id;
$papers = ['submission', 'payment', 'review', 'editing', 'publish'];
if(in_array($controller, $papers)){
	$js .= '$("#collapsePapers").addClass("show");';
}
$journal = ['journal', 'journal-issue'];
if(in_array($controller, $journal)){
	$js .= '$("#collapseJournal").addClass("show");';
}
$user = ['user'];
if(in_array($controller, $user)){
	$js .= '$("#collapseUser").addClass("show");';
}

$setting = ['email-template', 'setting', 'scope-cat', 'scope'];
if(in_array($controller, $setting)){
	$js .= '$("#collapseSetting").addClass("show");';
}

$journal_update = ['journal-update', 'journal-scope'];
if(in_array($controller, $journal_update)){
	$js .= '
	$("#journal_update_menu").show()
	$("#collapseJournalUpdate").addClass("show");
	';
	
}

$account = ['invoice'];
if(in_array($controller, $account)){
	$js .= '
	$("#collapseAccount").addClass("show");
	';
	
}






$this->registerJs($js);

?>