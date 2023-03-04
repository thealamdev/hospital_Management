<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sendsms_library {
    function send_single_sms($company_name,$msg_to,$msg_des)
    {
	
	//company name should be string and between 6 character

    //!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
    // api info modify on 1 april 19
    // user -reml
    // password - reml123
    //Link: sms.ajuratech.com
    //!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

    $message = urlencode($msg_des);

    $url = "http://sms.ajuratech.com/api/mt/SendSMS?APIKey=Z06wKnAOeEKH2BkUVQ0SCA&senderid=$company_name&channel=Normal&DCS=8&flashsms=0&number=$msg_to&text=$message";
            //echo $url;
    
    $ch = curl_init();

    // set URL and other appropriate options
    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);

    // grab URL and pass it to the browser
    $response = curl_exec($ch);
    $err = curl_error($ch);

    // close cURL resource, and free up system resources
    curl_close($ch);

 }

}