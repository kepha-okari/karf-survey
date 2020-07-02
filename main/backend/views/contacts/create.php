<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Contacts */

$this->title = 'Create Contact';
$this->params['breadcrumbs'][] = ['label' => 'Contacts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contacts-create"style="height:100vh;padding:0px" >

    <div class="box box-info">
        <div class="box-header">
            <h3 class="box-title" > <?= Html::encode($this->title) ?></h3>
        </div>
    </div>

    <div class="col-md-6 col-md-offset-3">
        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>

    </div>
</div>
