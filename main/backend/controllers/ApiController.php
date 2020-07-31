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
                    'get-current-session' => ['GET'],
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
        if ( $action->id == 'get-surveys' || $action->id == 'get-current-survey' || $action->id == 'get-current-session' || $action->id == 'fetch-questions' 
        || $action->id == 'get-question' || $action->id == 'fetch-all -options' || $action->id == 'send-notifications' 
        || $action->id == 'get-options' ||  $action->id == 'post-response' ||  $action->id == 'export-response' ){

            $this->enableCsrfValidation = false;
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        }
        return parent::beforeAction($action);
    }

    public function generateCSV($session_id) {

        #$session_id = $_GET['session_id'];

        
        header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename=\"survey-responses-".date("Y-m-d H:i:s").".csv\"");
        $data = "";


        $survey = Surveys::find()->where(['is_active' => 1])->orderBy(['id' => SORT_DESC])->one();
        #$session = SurveySessions::find()->andwhere(['status' => 0])->orderBy(['id' => SORT_DESC])->one();
        $responses = Responses::find()->select('msisdn')->distinct()->where(['survey_id'=>$survey_id])->all();
        $questions = Questions::find()->where(['survey_id' => $survey->id])->all();
        
        $header ="SURVEY,MSISDN,DATE";
        $quiz_items = "";
        foreach ($questions as $question) {
            # code...
            $quiz_items.=",".strtoupper($question->title);
        }
        $header.=$quiz_items."\n";

        $profile="";
        foreach ($responses as $response) {
            $respondent = Responses::find()->where(['survey_id'=>$survey->id])->andWhere(['msisdn'=>$response])->one();
            
            $profile.=$respondent->survey_id.",".$respondent->msisdn.",".$respondent->inserted_at;
            $resp="";
            foreach ($questions as $question) {
                # fetch this particular response from respondent if it exists
                $attempt = Responses::find()->where(['survey_id' => $survey->id])->andWhere(['msisdn'=>$response->msisdn])
                                            ->andWhere(['question_id'=>$question->id])
                                            ->orderBy(['id' => SORT_DESC])->one();


                if($attempt){
                        $resp.=",".$attempt->response;
                }else{
                    $resp.=","."NR";
                }
                #$resp.=",".($response->response?$response->response:"NR");
            }
            $profile.=$resp."\n";
            
        }
        
        $header.=$profile;
        echo $data.=$header;

    }

    public function actionExportResponse() {

        $session_id = $_GET['session_id'];

        $responses =SurveySessions::find()->where(['id'=>$session_id])->one();
        

        header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename=\"survey-responses-".date("Y-m-d")."-".$responses->session_name.".csv\"");
        $data = "";


        $survey = Surveys::find()->where(['is_active' => 1])->orderBy(['id' => SORT_DESC])->one();
        #$session = SurveySessions::find()->andwhere(['status' => 0])->orderBy(['id' => SORT_DESC])->one();
        $responses = Responses::find()->select('msisdn')->distinct()->where(['session_id'=>$session_id])->all();
        #$responses = Responses::find()->select('msisdn')->distinct()->where(['survey_id'=>$survey->id])->all();
        $questions = Questions::find()->where(['survey_id' => $survey->id])->all();
        
        $header ="SURVEY,MSISDN,DATE";
        $quiz_items = "";
        foreach ($questions as $question) {
            # code...
            $quiz_items.=",".strtoupper($question->title);
        }
        $header.=$quiz_items."\n";

        $profile="";
        foreach ($responses as $response) {
            $respondent = Responses::find()->where(['session_id'=>$session_id])->andWhere(['msisdn'=>$response])->one();
            
            $profile.=$respondent->survey_id.",".$respondent->msisdn.",".$respondent->inserted_at;
            $resp="";
            foreach ($questions as $question) {
                # fetch this particular response from respondent if it exists
                $attempt = Responses::find()->where(['survey_id' => $survey->id])->andWhere(['msisdn'=>$response->msisdn])
                                            ->andWhere(['question_id'=>$question->id])
                                            ->andWhere(['session_id'=>$session_id])
                                            ->orderBy(['id' => SORT_DESC])->one();


                if($attempt){
                        $resp.=",".$attempt->response;
                }else{
                    $resp.=","."NR";
                }
                #$resp.=",".($response->response?$response->response:"NR");
            }
            $profile.=$resp."\n";
            
        }
        
        $header.=$profile;
        echo $data.=$header;

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
            if($current_hour >= 06 && $current_hour <= 18) {
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
                $session = SurveySessions::find()->where(['survey_id' => $survey->id])->andwhere(['status' => 1])->orderBy(['id' => SORT_DESC])->one();
                $diff_time=(strtotime(date("Y/m/d H:i:s"))-strtotime($session->start_time))/60;

                if($diff_time >= 0 && $diff_time < 1 ){
                    $phone_numbers = Contacts::find()->where(['group_id' => $survey->contact_group])->all();

                    #set the next survey session time
                    $minutesToAdd = 60/($survey->frequency);
                    $date1 = str_replace('-', '/', $session->start_time);
                    $next_session = date('Y-m-d H:i:s',strtotime($date1 . "+{$minutesToAdd} minutes"));

                    #$sql = "UPDATE survey_sessions SET start_time='$next_session', status=false WHERE id='$session->id' ";
                    $sql = "UPDATE survey_sessions SET status=0 WHERE id='$session->id' ";
                    $saved = \Yii::$app->db->createCommand($sql)->execute();

                    $session_name = date('H:i:s');
                    $sql = "INSERT INTO survey_sessions(survey_id, session_name, start_time) VALUES('$survey->id', '$session_name', '$next_session') ";
                    $saved = \Yii::$app->db->createCommand($sql)->execute();

                    foreach ($phone_numbers as $phone_number) {
                        # code...
                        $this->sendSMS($survey->message, $phone_number->contact);
                    }

                }
                $minutesToAdd = 720/($survey->frequency);
                $date1 = str_replace('-', '/', $session->start_time);
                $start_time = date('Y-m-d H:i:s',strtotime($date1 . "+{$minutesToAdd} minutes"));
           
                return $start_time;
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

        $survey = Surveys::find()->where(['is_active' => 1])->orderBy(['id' => SORT_DESC])->one();

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


    public function pickTargetSession($msisdn){
        $today = date('Y-m-d')." 00:00:00";
        $survey = Surveys::find()->where(['is_active' => 1])->orderBy(['id' => SORT_DESC])->one();
        $sessions = SurveySessions::find()->where(['>=', 'inserted_at', $today])->orderBy(['id' => SORT_ASC])->all();
        if($sessions){
            foreach ($sessions as $session) {
                $resp = Responses::find()->where(['msisdn' =>$msisdn])->andWhere(['session_id' => $session->id])->all();
                if(!$resp){
                    return $session;
                }
                
            }
            return SurveySessions::find()->where(['survey_id' => $survey->id])->andwhere(['status' => 1])->orderBy(['id' => SORT_DESC])->one();
        }else{
            $session = SurveySessions::find()->where(['survey_id' => $survey->id])->andwhere(['status' => 1])->orderBy(['id' => SORT_DESC])->one();
            return $session;
        }
    }


    public function actionGetCurrentSession() {
        $msisdn = $_GET['msisdn'];
        
        #$session = SurveySessions::find()->where(['survey_id' => $survey->id])->andwhere(['status' => 1])->orderBy(['id' => SORT_DESC])->one();
        #$session = SurveySessions::find()->where(['survey_id' => $survey->id])->andwhere(['not in','msisdn',$msisdn])->orderBy(['id' => SORT_DESC])->one();

        $session = $this->pickTargetSession($msisdn);
        
        if ($session) {
            return $session;
        }else {
            $data =  array(
                'status' => 404,
                'status_message' => 'No session found',
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
        
      
        $session = SurveySessions::find()->where(['survey_id' => $survey_id])->andwhere(['status' => 1])->orderBy(['id' => SORT_DESC])->one();
        $session_id = $session->id;

        #$sql = "INSERT INTO responses (survey_id, question, response, respondent ) VALUES ('$survey_id', '$question', '$response', '$respondent')";
        $sql = "INSERT INTO responses (survey_id, msisdn,  question_id, response, session_id ) VALUES ('$survey_id', '$respondent', '$question', '$response', '$session_id')";
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

