<?php

namespace backend\controllers;
// header("Access-Control-Allow-Origin: *");
date_default_timezone_set('Africa/Nairobi');

use Yii;
use yii\base\ErrorException;


use yii\db\Command;
use yii\db\Query;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use backend\models\Surveys;
use backend\models\Options;
use backend\models\Questions;
use backend\models\Responses;



use yii\db\Expression; // to randomise objects selected from the database


use yii\rest\ActiveController;


/**
 * ApiController implements the api actions
 */
class ApiController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors() {

        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        // 'actions' => [
                        //     'fetch-questions',
                        //     'get-question',
                        'allow' => true,
                        // 'role' => ['@', '?']
                    ],
                ],
                'denyCallback' => function ($rule, $action) {
                    throw new \yii\web\NotFoundHttpException('The resource you are looking for cannot be found');
                }

            ],

            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'fetch-questions' => ['GET'],
                    'get-question' => ['GET'],
                    'fetch-all-options' => ['GET'],
                    'get-options' => ['GET'],
                    'get-surveys' => ['GET'],
                    'get-current-survey' => ['GET'],
                    'post-response' => ['POST'],
      
                ],
            ],

        ];

    }


    /**
     * @inheritdoc
     */
    public function beforeAction($action) {
        if ( $action->id == 'get-surveys' || $action->id == 'get-current-survey' || $action->id == 'fetch-questions' 
        || $action->id == 'get-question' || $action->id == 'fetch-all -options' 
        || $action->id == 'get-options' ||  $action->id == 'post-response' ){

            $this->enableCsrfValidation = false;
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        }
        return parent::beforeAction($action);
    }




    public function actionGetSurveys() {

        $survey_id = NULL;
        // $survey_id = $_GET['survey_id'];

        
        $surveys = Surveys::find()->all();

        if ($surveys) {
            return $surveys;
                }else {
                $data =  array(
                    'status' => 404,
                    'status_message' => 'No answers found',
                );
            return $data;
        }

    }


    public function actionGetCurrentSurvey() {

        $survey = Surveys::find()->where(['is_active' => 1])->orderBy(['id' => SORT_DESC])->one();;

        if ($survey) {
            return $survey;
                }else {
                $data =  array(
                    'status' => 404,
                    'status_message' => 'No answers found',
                );
            return $data;
        }

    }




    public function actionFetchQuestions() {
       
        $questions = Questions::find()->all();

        $options = [];
        foreach ($questions as $question) {
            # code...
            $set = Options::find()->where(['question_id' => $question->id])->all();
            array_push($options, $set );
        }

        if ($questions) {
            return [$questions, $options];
                }else {
                $data =  array(
                    'status' => 404,
                    'status_message' => 'No question found',
                );
            return $data;
        }
    }


    public function actionGetQuestion() {
        
        $question_id = $_GET['question_id'];

        $question = Questions::find()->where(['id' => $question_id])->all();

        if ($question) {
            return $question;
                }else {
                $data =  array(
                    'status' => 404,
                    'status_message' => 'No question found',
                );
            return $data;
        }
    }

    public function actionFetchAllOptions() {
       
        $options = Options::find()->all();

        if ($options) {
            return $options;
                }else {
                $data =  array(
                    'status' => 404,
                    'status_message' => 'No question found',
                );
            return $data;
        }
    }


    public function actionGetOptions() {
        $question_id = $_GET['question_id'];

        $option = Options::find()->where(['question_id' => $question_id])->all();

        if ($option) {
            return $option;
                }else {
                $data =  array(
                    'status' => 404,
                    'status_message' => 'No question found',
                );
            return $data;
        }
    }


    public function actionPostResponse() {

        $survey_id = $_GET['survey_id'];
        $question = $_GET['question'];
        $response = $_GET['response'];
        $respondent = $_GET['respondent'];
        
        $sql = "INSERT INTO responses (survey_id, question, response, respondent ) VALUES ('$survey_id', '$question', '$response', '$respondent')";
        $response = \Yii::$app->db->createCommand($sql)->execute();
    
        
        if ($response) {
            return $response;
                }else {
                $data =  array(
                    'status' => 404,
                    'status_message' => 'could not save the response',
                );
            return $data;
        }

    }

}

