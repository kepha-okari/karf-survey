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
use backend\models\Contacts;
use backend\models\Options;
use backend\models\Questions;
use backend\models\Responses;
use backend\models\SurveySessions;



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
                    'send-notifications' => ['GET'],
                    'export-response' => ['GET'],
      
                ],
            ],

        ];

    }


    /**
     * @inheritdoc
     */
    public function beforeAction($action) {
        if ( $action->id == 'get-surveys' || $action->id == 'get-current-survey' || $action->id == 'fetch-questions' 
        || $action->id == 'get-question' || $action->id == 'fetch-all -options' || $action->id == 'send-notifications' 
        || $action->id == 'get-options' ||  $action->id == 'post-response' ||  $action->id == 'export-response' ){

            $this->enableCsrfValidation = false;
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        }
        return parent::beforeAction($action);
    }

    public function actionExportResponse() {
        
        header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename=\"survey-responses.csv\"");
        $data = "";

        $responses = Responses::find()->all();

        foreach ($responses as $response) {
            # code...
            $data.=$response->question.",".$response->response.",".$response->respondent.",".$response->created_at."\n";
        }
        
        echo $data;
    }

    public function timeRange($timeOfDay){
        date_default_timezone_set('Africa/Nairobi');
        // $currentTime = date("G:i A");
        $currentTime =  date('d M Y H:i:s');
        $current_hour   =   date('H', strtotime($currentTime));


        if($timeOfDay == "morning" ){
            #if( $currentTime > date("4.00 AM") && $currentTime < date("G:i A", strtotime('12:00 PM')) ) {
            if($current_hour > 4 && $current_hour < 12) {
                return true;
            }else{
                return false;
                
            }
        }elseif($timeOfDay == "afternoon"){
            #if( $currentTime > date("12:00") && $currentTime < date("G:i A", strtotime('15:00')) ) {
            if($current_hour >= 12 && $current_hour <= 15) {

                return true;
            }else{
                return false;
            }
        }elseif($timeOfDay == "evening"){
            #if( $currentTime > date("15:00") && $currentTime < date("G:i A", strtotime('18:00')) ) {
            if($current_hour >= 16 && $current_hour <= 18) {
                return true;
            }else{
                return false;
            }
        }elseif($timeOfDay == "all-day"){
            #if( $currentTime > date("03:00") && $currentTime < date("G:i A", strtotime('18:00')) ) {
            if($current_hour >= 04 && $current_hour <= 18) {
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
          
    }


    public function actionSendNotifications() {

        $survey = Surveys::find()->where(['is_active' => 1])->orderBy(['id' => SORT_DESC])->one();

        if($survey) {
            if($this->timeRange($survey->duration)){
                $session = SurveySessions::find()->where(['survey_id' => $survey->id])->orderBy(['id' => SORT_DESC])->one();
                $diff_time=(strtotime(date("Y/m/d H:i:s"))-strtotime($session->next_session))/60;
                if($diff_time >= 0 && $diff_time < 1 ){
                    $phone_numbers = Contacts::find()->where(['group_id' => $survey->contact_group])->all();

                    #set the next survey session time
                    $minutesToAdd = 60/($survey->frequency);
                    $date1 = str_replace('-', '/', $session->next_session);
                    $next_session = date('Y-m-d H:i:s',strtotime($date1 . "+{$minutesToAdd} minutes"));

                    $sql = "UPDATE survey_sessions SET next_session='$next_session' WHERE id='$session->id' ";
                    $saved = \Yii::$app->db->createCommand($sql)->execute();

                    foreach ($phone_numbers as $phone_number) {
                        # code...
                        $this->sendSMS($survey->message, $phone_number->contact);
                    }

                }
                $minutesToAdd = 60/($survey->frequency);
                $date1 = str_replace('-', '/', $session->next_session);
                $next_session = date('Y-m-d H:i:s',strtotime($date1 . "+{$minutesToAdd} minutes"));
           
                return $next_session;
            }

        }

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
        $survey = Surveys::find()->where(['is_active' => 1])->orderBy(['id' => SORT_DESC])->one();

        $questions = Questions::find()->where(['survey_id' => $survey->id ])->all();

        $options = [];
        foreach ($questions as $question) {
            # code...
            $set = Options::find()->where(['question_id' => $question->id])->all();
            foreach ($set as $option) {
                # code...
                array_push($options, $option );
            }
        }

        if ($questions) {
            return [
                "questions" => $questions,
                "options" =>  $options
            ];
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
        
        #$sql = "INSERT INTO responses (survey_id, question, response, respondent ) VALUES ('$survey_id', '$question', '$response', '$respondent')";
        $sql = "INSERT INTO responses (survey_id, msisdn,  question_id, response ) VALUES ('$survey_id', '$respondent', '$question', '$response')";
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

    public function sendSMS($message, $msisdn){
        
        $url = 'https://app.bongasms.co.ke/api/send-sms-v1';

        $post_data = http_build_query([
            "apiClientID" => 89,
            "key" => 'bfbp5vAovgAgY4B',
            "secret" => 'lSf6YheFI3K7krY0vEPCXoka1nnik9',
            "txtMessage" => $message,
            "MSISDN" => $msisdn,
            "serviceID" => 1
        ]);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded '));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);

        $result = json_decode($result);
        return $result;
    }

}

