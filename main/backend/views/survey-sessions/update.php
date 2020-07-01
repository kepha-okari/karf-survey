<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\SurveySessions */

$this->title = 'Update Survey Sessions: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Survey Sessions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="survey-sessions-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
