<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\DashboardAsset;
use yii\helpers\Html;
use backend\models\Questions;
use backend\models\Surveys;
use backend\models\SurveySessions;


$questions = Questions::find()->all();

DashboardAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="hold-transition skin-blue sidebar-mini" >
<?php $this->beginBody() ?>

<div class="wrapper">
  <header class="main-header">
    <!-- Logo -->

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation"">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
              <span class="label label-success"></span>
            </a>

          </li>
          <!-- Notifications: style can be found in dropdown.less -->
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning"></span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 0 notifications</li>
           
            </ul>
          </li>
          <!-- Tasks: style can be found in dropdown.less -->
          <li class="dropdown tasks-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-flag-o"></i>
              <span class="label label-danger"></span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 9 tasks</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
            
                </ul>
              </li>

             
            </ul>
          </li>
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="dist/img/avatar.png" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php  ?></span>
            </a>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
    <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="dist/img/avatar.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-right info">
          <a href="#"><i class="fa fa-circle text-success"></i> Active</a>
        </div>
      </div>
  
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="active treeview">
          <a href="#">
          <span>MAIN NAVIGATION</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
            <ul class="treeview-menu">
                <li class="active"><a href="http://104.236.11.199/questionnaire/main/backend/web/index.php?r=site/index"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li><a href="http://104.236.11.199/questionnaire/main/backend/web/index.php?r=surveys/index"><i class="fa fa-microscope"></i>Surveys</a></li>
                <li><a href="http://104.236.11.199/questionnaire/main/backend/web/index.php?r=survey-sessions/index"><i class="fa fa-microscope"></i>Survey Sessions</a></li>
                <li><a href="http://104.236.11.199/questionnaire/main/backend/web/index.php?r=questions/index"><i class="fa fa-"></i> Questions</a></li>
                <li><a href="http://104.236.11.199/questionnaire/main/backend/web/index.php?r=options/index"><i class="fa fa-"></i> Options</a></li>
                <li><a href="http://104.236.11.199/questionnaire/main/backend/web/index.php?r=groups/index"><i class="fa fa-"></i> Groups</a></li>
                <li><a href="http://104.236.11.199/questionnaire/main/backend/web/index.php?r=responses%2Findex&sort=-inserted_at"><i class="fa fa-"></i> Responses</a></li>
                <li><a href="https://app.bongasms.co.ke/site/login"><i class="fa fa-"></i> BongaSMS</a></li>
                <li class="active treeview">
                  <a href="#"><span>TODAY'S RESPONSES</span> <i class="fa fa-angle-left pull-right"></i></a>
                  <ul class="treeview-menu">

                    <?php 
                        $today = date("Y-m-d");
                        #$sessions = SurveySessions::find()->where(['>=','inserted_at', $today])->limit(4)->orderBy(['id' => SORT_DESC])->all();
                        $sessions = SurveySessions::find()->where(['>=','inserted_at', $today])->orderBy(['id' => SORT_DESC])->all();

                        if($sessions){
                          foreach ($sessions as $session) {
                            # code...
                            $link = "http://localhost/questionnaire/main/backend/web/index.php?r=api/export-response&session_id=".$session->id.">Export Session ".$session->session_name."</a>";
                            echo '<li><a href=';
                            echo    $link;
                            echo  '</li>';
                          }
                        }else{
                            echo '<li><a href="http://104.236.11.199/questionnaire/main/backend/web/index.php?r=api/export-response"><i class="fa fa-"></i>No Survey Session Yet</a></li>' ;

                        }

                        
                        #echo '<li><a href="http://104.236.11.199/questionnaire/main/backend/web/index.php?r=api/export-response"><i class="fa fa-"></i> Download Responses</a></li>' 
                    ?>

                  </ul>
                </li>
                  
    
                
            </ul>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>


  <div class="content-wrapper">
  
      <div class="row">
        <section class="col-lg-12 connectedSortable">
        
        <?= $content ?>

        </section>
  
      </div>

    </div>


</div>






<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
