<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Contacts */

$this->title = $model->contact;
$this->params['breadcrumbs'][] = ['label' => 'Contacts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="contacts-view"style="height:100vh;padding:0px" >

<div class="box box-info">
    <div class="box-header">
        <h3 class="box-title" >UPDATE: <?= Html::encode($this->title) ?></h3>
    </div>
</div>


<div class="col-md-6 col-md-offset-3">
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
            'contact',
            'group_id',
            'inserted_at',
        ],
    ]) ?>

</div>
</div>
