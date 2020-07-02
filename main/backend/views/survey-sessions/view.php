<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\SurveySessions */

$this->title = $model->session_name;
$this->params['breadcrumbs'][] = ['label' => 'Survey Sessions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="survey-sessions-view" style="height:100vh;padding:0px" >

    <div class="box box-info">
        <div class="box-header">
            <h3 class="box-title" >SURVEY SESSION:  <?= Html::encode($this->title) ?></h3>
        </div>
    </div>


    <div class="col-md-8 col-md-offset-2">

            <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>
        </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'survey_id',
            'session_name',
            'start_time',
            'status',
            'inserted_at',
        ],
    ]) ?>

</div>
