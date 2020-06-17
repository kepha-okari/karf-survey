<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Questions */

$this->title = 'Update Questions: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Questions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="questions-update col-md-6 col-md-offset-3" style="height:100vh;padding:0px">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
