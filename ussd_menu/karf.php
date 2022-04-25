<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

date_default_timezone_set('Africa/Nairobi');

class Menu
{

    protected $MSISDN;
    protected $USSD_STRING;
    protected $EXTRA;
    protected $NEXT_LEVEL;
    protected $strDISPLAY;
    protected $RESPONSE = array();


    public final function __construct($MSISDN, $USSD_STRING)
    {
        $this->MSISDN = $MSISDN;
        $this->USSD_STRING = $USSD_STRING;
        $this->BASE_URL = 'http://104.236.11.199/survey/main/backend/web/index.php';

        if (isset($_SESSION['NEXT_LEVEL'])) {
            $this->EXTRA = $_SESSION['EXTRA'];
            $this->NEXT_LEVEL = $_SESSION['NEXT_LEVEL'];
        } else {
            $this->EXTRA = "0";
            $this->NEXT_LEVEL = "0";
        }
    }

    public static function createInstance($MSISDN, $USSD_STRING)
    {
        $DMENU = new self($MSISDN, $USSD_STRING);
        return $DMENU;
    }


    public function processMenu()
    {

        try {

           $nav = "menuLevel" . "$this->NEXT_LEVEL";

            $this->$nav();

            $outputArray = split("\|", $this->strDISPLAY);

            $menu = $outputArray[0];
            $_SESSION["NEXT_LEVEL"] = $outputArray[1];
            $_SESSION["EXTRA"] = $outputArray[2];

        } catch (Exception $ex) {

            $menu = "Sorry Value Service is currently unavailable. Kindly Bare with us as we work on fixing this issue";

        }

        return $menu;
    }






    private function menuLevel0() {
        $welcome_txt = "Welcome to KARF\n". $this->intializeSurveyContent();
        
        $this->strDISPLAY = $welcome_txt."\n88. Invite a friend to KARF survey|2|EXTRA";
    }



    # process user input
    private function menuLevel1() {

        $input = strtoupper($this->USSD_STRING);

        $current_question = $_SESSION['current_question'];
        $current_options = $_SESSION['current_options'];

        if($current_question->state !== "end"){
            if($current_question->question_type == "closed"){
                # geit the option object selected
                $choice_data = $this->extractChoice($current_options, $input);

                if($choice_data){
                    #pick choice and save
                    $response = $choice_data->choice;
                    $data = [
                        'survey_id' => $current_question->survey_id,
                        'question' => $current_question->title,
                        'response' => $response,
                        'respondent' => $this->MSISDN
                    ];

                    $this->saveResponse($data); # save response

                    if($choice_data->state == "transitional"){

                        $this->strDISPLAY = $this->pickQuestion($choice_data->pointer, $current_question->survey_id)."|1|EXTRA"; # go to next question

                    } else{

                        $this->menuLevel900(); # end survey
                    }
                } else {
                    $this->strDISPLAY = "Invalid input\n".$this->displayQuestionOptions($current_question)."|1|EXTRA";
                }
            }else{
                # open qnded question
                $response = $input;
                $data = [
                    'survey_id' => $current_question->survey_id,
                    #'question' => $current_question->title,
                    'question' => $current_question->id,
                    'response' => $response,
                    'respondent' => $this->MSISDN
                ];

                $this->saveResponse($data); # save response
                $this->strDISPLAY = $this->pickQuestion($current_question->pointer, $current_question->survey_id)."|1|EXTRA";
            }
        } else {
            # open qnded question
            $response = $input;
            $data = [
                'survey_id' => $current_question->survey_id,
                'question' => $current_question->title,
                'response' => $response,
                'respondent' => $this->MSISDN
            ];

            $this->saveResponse($data); # save response
            
            $this->menuLevel900();
        }
        
    }

    private function menuLevel2() {

        if($this->USSD_STRING== "88"){
            $this->strDISPLAY = "Enter your friend's phone number|3|EXTRA";
        } else {
            $this->menuLevel1();
        }

    }

    private function menuLevel3() {

        $phone_number = $this->USSD_STRING;
        #format the submitted contact
        $phone_number = (substr($phone_number, 0, 1) == "+") ? str_replace("+", "", $phone_number) : $phone_number;
        $phone_number = (substr($phone_number, 0, 1) == "0") ?  preg_replace("/^0/", "254", $phone_number) : $phone_number;
        $phone_number = (substr($phone_number, 0, 1) == "7") ? "254{$phone_number}" : $phone_number;
        $phone_number = (substr($phone_number, 0, 1) == "7") ? "254{$phone_number}" : $phone_number;
        $phone_number = str_replace(" ", "", $phone_number);

        $this->sendSMS("Your friend ".$this->MSISDN." is inviting you to participate in KARF Survey", $phone_number);

        $thank_you_note = "Your friend ".$phone_number." has received the invitation.\n\n1.Continue\n";
        
        $this->strDISPLAY = $thank_you_note."|4|EXTRA";
    }



    private function menuLevel4() {

        if($this->USSD_STRING == "1"){
            $this->menuLevel0();
        } else {
            $this->strDISPLAY = "Invalid input\n1.Continue|4|EXTRA";
        }

    }

    private function extractChoice($current_options, $input) {
        foreach ($current_options as $option) {
            # code...
            if($option->label == $input){
                return $option;
            }
        }
    }
 


    # thank you note message
    private function menuLevel900() {
        $welcome_txt = "END Thank you for taking your time to respond";
        $this->sendSMS("Thank you for taking your time to respond.", $this->MSISDN);
        $this->strDISPLAY = $welcome_txt."|201|EXTRA";
    }
 
    private function sendSMS($message, $msisdn){
        
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


    public function postRequest($url, $post_array) {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($post_array));
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

        $result = curl_exec($curl);
        if (!$result) {
            die("Connection Failure");
        }
        curl_close($curl);
        return json_decode($result);
    }



    public function getRequest($url) {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

        $result = curl_exec($curl);
        if (!$result) {
            die("Connection Failure");
        }
        curl_close($curl);
        return json_decode($result);
    }


    public function getSurvey() {
        $response = $this->getRequest($this->BASE_URL.'?r=api/get-current-survey');
        return $response;
    }

    public function saveResponse($data) {
        $response = $this->postRequest($this->BASE_URL.'?r=api/post-response&'.http_build_query($data), $data);
        return $response;
    }

    public function fetchAllQuestions() {
        $response = $this->getRequest($this->BASE_URL.'?r=api/fetch-questions');
        return $response;
    }


    public function findOption($question_id) {
        $payload = ['question_id' => $question_id];
        $response = $this->getRequest($this->BASE_URL.'?r=api/get-options&'.http_build_query($payload));
        return $response;
    }

    public function intializeSurveyContent(){
        $_SESSION['survey_id'] = $this->getSurvey()->id;
        $survey_id  = $_SESSION['survey_id']; 
        $_SESSION['questions'] = $this->fetchAllQuestions();
        $_SESSION['options'] = $_SESSION['questions']->options;
        $pointer = 1;
        return $this->pickQuestion($pointer, $survey_id);
    }


    public function pickQuestion($pointer, $survey_id){
        $questions = $_SESSION['questions']->questions;

        # questions for this survey
        $survey_questions = array_filter($questions, function ($question) use ($survey_id) {
            return $question->survey_id == $survey_id;
        });

        # cureent question
        $current_question = array_filter($survey_questions, function ($question) use ($pointer) {
            return $question->question_number == $pointer;
        });

        $current_question = current($current_question);
        $_SESSION['current_question'] = $current_question;
       
        # if question has options
        if($current_question->question_type == 'closed'){
            return $this->displayQuestionOptions($current_question);
        } else {
            return $current_question->title;
        }
    }


    public function displayQuestionOptions($question){
        $options = $_SESSION['questions']->options;;
        $question_id = $question->id;

        $current_options = array_filter($options, function ($option) use ($question_id) {
            return $option->question_id == $question_id;
        });
        $_SESSION['current_options'] = $current_options;

        $option_string = '';
        foreach ($current_options as $option) {
            $option_string.= $option->label.". ".ucfirst($option->choice)."\n";
        }
        #return $question->question_number.". ".$question->title."\n".$option_string;
        return ucfirst($question->title)."\n".$option_string;
      
    }




}


