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
        $welcome_txt = "Welcome to KARF\nWhich of the following activities did you do?\n1.Listened to the radio\n2.Watched TV\n3.Read a newspaper\n4.Visited an online site";
        
        $this->strDISPLAY = $welcome_txt."|1|EXTRA";
    }

    private function menuLevel1() {
        switch ($this->USSD_STRING) {
            case "1":
                $this->menuLevel2();
                break;
            case "2":
                $this->menuLevel3();
                break;
            case "3":
                $this->menuLevel4();
                break;
            case "4":
                $this->menuLevel5();
                break;
            default:
                $this->strDISPLAY = "Invalid Input.\n1.Listened to the radio\n2.Watched TV\n3.Read a newspaper\n4.Visited an online site|1|EXTRA";
        }
    }

    # listened to radio
    private function menuLevel2() {
        $this->strDISPLAY = "Which radio station did you listen to?|200|EXTRA";
    }

    # radio time
    private function menuLevel200() {
        $_SESSION['radio_station'] = $this->USSD_STRING;
        $welcome_txt = "What time did you listen to ".$_SESSION['radio_station']."?\n1. 06.00 - 06.30\n2. 06.30 - 07.00\n3. 07.00 - 07.30\n4. 07.30 - 08.00\n5. 08.30 - 09.00\n\n0.Home";
        $this->strDISPLAY = $welcome_txt."|201|EXTRA";
    }

    # navigator
    private function menuLevel201() {
        if($this->USSD_STRING == "0"){
            $this->menuLevel0();
        } else{
            $this->menuLevel900();
        }

    }

    # Watched TV`
    private function menuLevel3() {
        $this->strDISPLAY = "Which TV station did you watch?|300|EXTRA";
    }

    # TV time
    private function menuLevel300() {
        $_SESSION['tv_station'] = $this->USSD_STRING;
        $welcome_txt = "What time did you watch ".$_SESSION['tv_station']."?\n1. 06.00 - 06.30\n2. 06.30 - 07.00\n3. 07.00 - 07.30\n4. 07.30 - 08.00\n5. 08.30 - 09.00\n\n0.Home";
        $this->strDISPLAY = $welcome_txt."|201|EXTRA";
    }


    # Newspaper
    private function menuLevel4() {
        $this->strDISPLAY = "Which newspaper did your read?\n1. Nation\n2. Standard\n3. People Daily|400|EXTRA";
    }

    # newspaper sections
    private function menuLevel400() {
        switch ($this->USSD_STRING) {
            case "1":
                $_SESSION['newspaper'] = "Nation";
                break;
            case "2":
                $_SESSION['newspaper'] = "Standard";
                break;
            case "3":
                $_SESSION['newspaper'] = "People Daily";
                break;
            case "0":
                $this->menuLevel0();
                break;
            default:
                $this->strDISPLAY = "Invalid Input.\n1. Nation\n2. Standard\n3. People Daily|400|EXTRA";
        }

        $welcome_txt = "Which section of ".$_SESSION['newspaper']." did you read?\n1. Politics\n2. Business\Economy\n3. Sports\n4. Blogs & Opinions\n5. Life & Style\n6.Entertainment\n\n0.Home";
        $this->strDISPLAY = $welcome_txt."|201|EXTRA";
    }


    # Online site
    private function menuLevel5() {
        $this->strDISPLAY = "Which online site did you visit?\n1. WhatsApp\n2. Facebook\n3. Twitter\n4. TikTok|500|EXTRA";
    }

    # online
    private function menuLevel500() {
        switch ($this->USSD_STRING) {
            case "1":
                $_SESSION['online_site'] = "WhatsApp";
                break;
            case "2":
                $_SESSION['online_site'] = "Facebook";
                break;
            case "3":
                $_SESSION['online_site'] = "Twitter";
                break;
            case "4":
                $_SESSION['online_site'] = "TikTok";
                break;
            case "0":
                $this->menuLevel0();
                break;
            default:
                $this->strDISPLAY = "Invalid Input.\n1. WhatsApp\n2. Facebook\n3. Twitter\4. TikTok|400|EXTRA";
        }

        $welcome_txt = "How much time did you spend on ".$_SESSION['online_site']."?\n\n0.Home";
        $this->strDISPLAY = $welcome_txt."|201|EXTRA";
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

}





