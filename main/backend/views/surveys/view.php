<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Surveys */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Surveys', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="surveys-view" style="height:100vh;padding:0px" >

    <div class="box box-info">
        <div class="box-header">
            <h3 class="box-title" >SURVEY:  <?= Html::encode($this->title) ?></h3>
        </div>
    </div>


    <div class="col-md-10 col-md-offset-1">

    <p>
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
                'survey_name',
                'company_name',
                'duration',
                'message',
                'contact_group',
                'frequency',
                // 'is_active',
                [
                    'attribute' => 'is_active',
                    'format'=>'raw',
                    'value'=> function ($model) {
                        if ($model->is_active == 1)
                        {
                            return 'YES';
                        } else {
                            return 'NO';
                        }
                    },
                ],
                'created_at',
            ],
        ]) ?>
    </div>


</div>
