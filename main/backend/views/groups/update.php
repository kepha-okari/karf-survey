<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Groups */

$this->title = 'Update Groups: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Groups', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="box box-info">
    <div class="box-header">
        <h3 class="box-title" > <?= Html::encode($this->title) ?></h3>
    </div>
</div>

<div class="groups-update col-md-6 col-md-offset-3" style="height:100vh;padding:0px"> 

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
