<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\SurveySessions */

$this->title = 'Create Survey Sessions';
$this->params['breadcrumbs'][] = ['label' => 'Survey Sessions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="survey-sessions-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
