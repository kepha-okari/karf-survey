<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\SurveySessions */

$this->title = 'Create Survey Sessions';
$this->params['breadcrumbs'][] = ['label' => 'Survey Sessions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="survey-sessions-create" style="height:100vh;padding:0px" >

    <div class="box box-info">
        <div class="box-header">
            <h3 class="box-title" > <?= Html::encode($this->title) ?></h3>
        </div>
    </div>

    <div class="col-md-6 col-md-offset-3">
        <h1><?= Html::encode($this->title) ?></h1>

        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>

    </div>

</div>