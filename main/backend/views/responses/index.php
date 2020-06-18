<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ResponseSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Responses';
$this->params['breadcrumbs'][] = $this->title;
?>
<<div class="responses-index" style="height:100vh;padding:0px" >


<h1><?= Html::encode($this->title) ?></h1>




    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            [
                'attribute' => 'survey_id',
                'value'     => 'survey.survey_name' //getComp()
            ],
            'question',
            'response',
            'respondent',
            'created_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
