<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Surveys;
use backend\models\Groups;

/* @var $this yii\web\View */
/* @var $model backend\models\Contacts */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contacts-form">

    <?php $survey = Surveys::find()->where(['is_active' => 1])->orderBy(['id' => SORT_DESC])->one(); ?>


    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'group_id')->dropDownList(
            ArrayHelper::map(Groups::find()->where(['survey_id' => $survey->id])->orderBy('name')->asArray()->all(),'id','name'),
            ['prompt'=>'Select a group']
    ) ?>

    <?= $form->field($model, 'contact')->textInput() ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
