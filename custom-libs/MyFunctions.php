<?php
/**
 * Created by Naveed Hassan
 * Date: 5/4/2015
 * Time: 10:59 AM
 */
function getTimeFromMins($mins){
    $hrs = floor($mins / 60);
    $min = $mins % 60;
    if(strlen($hrs) <= 1){ $hrs = "0".$hrs; }
    if(strlen($min) <= 1){ $min = "0".$min; }
    return $hrs.":".$min;
}

function getTimeArray(){
    // from 8:00 to 19:00
    $startTime = 8*60;
    $endTime = 19*60;
    $slotDuration = 60; // in minutes
    $output = [];
    for ( $i = $startTime; $i <= $endTime; $i += $slotDuration  ){
        $output[] = getTimeFromMins($i);
    }
    return $output;
}

function dateToCal($timestamp) {
    return date('Ymd\THis\Z', $timestamp);
}

/**
 * @param $keys
 * @param $array
 * @return bool
 * returns true only if all the $keys are set for $array
 */
function areSet($keys,$array){
    $result = true;
    if(!is_array($keys) || !is_array($array)){ return false; }
    foreach ( $keys as $key ){
        if( !isset($array[$key]) ){ $result = false; }
    }
    return $result;
}

function postViaCurl( $data, $url ){
    // Create a curl handle to domain 2
    $ch = curl_init($url);
    //configure a POST request with some options
    curl_setopt($ch, CURLOPT_POST, true);
    //put data to send
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    //this option avoid retrieving HTTP response headers in answer
    curl_setopt($ch, CURLOPT_HEADER, 0);
    //we want to get result as a string
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //execute request
    return curl_exec($ch);
}

function get_user_ip_address() {
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
        $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}
