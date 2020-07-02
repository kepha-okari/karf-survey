<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\SurveySessions */

$this->title = 'Update Survey Session: ' . $model->session_name;
$this->params['breadcrumbs'][] = ['label' => 'Survey Sessions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
    <div class="box box-info">
        <div class="box-header">
            <h3 class="box-title" ><?= Html::encode($this->title) ?></h3>
        </div>
    </div>

    <div class="survey-session-update col-md-6 col-md-offset-3" style="height:100vh;padding:0px" >

        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>

    </div>
