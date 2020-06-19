<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Surveys */

$this->title = 'Update Surveys: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Surveys', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="surveys-update" style="height:100vh;padding:0px" >

    <div class="col-md-6 col-md-offset-3">
        <h1><?= Html::encode($this->title) ?></h1>

        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>

    </div>
</div>
