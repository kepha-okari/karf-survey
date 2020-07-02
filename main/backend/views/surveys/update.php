<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Surveys */

$this->title = 'Update Survey: ' . $model->survey_name;
$this->params['breadcrumbs'][] = ['label' => 'Surveys', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="surveys-update col-md-6 col-md-offset-3" style="height:100vh;padding:0px" >

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
