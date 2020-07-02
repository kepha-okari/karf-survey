<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\SurveySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Surveys';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="options-index" style="height:100vh;padding:0px" >
    <h1  style="padding:15px">
        <?= Html::a('Add Survey', ['create'], ['class' => 'btn btn-success pull-right']) ?>
    </h1>


    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'survey_name',
            'company_name',
            'duration',
            'message',
            'contact_group',
            'frequency',
            'is_active',
            // 'created_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
