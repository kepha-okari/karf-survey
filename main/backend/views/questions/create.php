<?php

use yii\helpers\Html;
use backend\models\Questions;
/* @var $this yii\web\View */
/* @var $model backend\models\Questions */

$this->title = 'Create Questions';
$this->params['breadcrumbs'][] = ['label' => 'Questions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="questions-index" style="height:100vh;padding:0px" >

    <div class="box box-info">
        <div class="box-header">
            <h3 class="box-title" >QUESTION: <?= Html::encode($this->title) ?></h3>
        </div>
    </div>

    <div class="col-md-6 col-md-offset-3">

        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>

    </div>

</div>
