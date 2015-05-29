<?php
/**
 * Created by Naveed ul Hassan Malik
 * Date: 5/4/2015
 * Time: 10:59 AM
 */

class DL{

    static function dateToCal($timestamp) {
        return date('Ymd\THis\Z', $timestamp);
    }

    /**
     * @param $keys
     * @param $array
     * @return bool
     * returns true only if all the $keys are set for $array
     */
    static function areSet($keys,$array){
        $result = true;
        if(!is_array($keys) || !is_array($array)){ return false; }
        foreach ( $keys as $key ){
            if( !isset($array[$key]) ){ $result = false; }
        }
        return $result;
    }

    static function postViaCurl( $data, $url ){
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


    /**
     * @param $array
     * @param $inputName
     * @return string
     * safely get the value of an input from an array like $_POST or $_SESSION
     */
    static function valFromArray( $array , $inputName )
    {
        if($array && is_array($array) && array_key_exists($inputName,$array)){ return $array[$inputName]; }
        return "";
    }

    /**
     * @param $array
     * @param $selectTagName
     * @param $optionTagValue
     * @return string
     * safely get the selected attribute of an <option> from an array like $_POST or $_SESSION
     */
    static function selectAttrFromArray( $array , $selectTagName , $optionTagValue )
    {
        if($array && is_array($array) && array_key_exists($selectTagName,$array)){
            return $array[$selectTagName] == $optionTagValue ? "selected" : "";
        }
        return "";
    }

    /**
     * @param $array
     * @return string
     * Generate the hidden input markups for an array
     */
    static function hiddenInputsForArray($array)
    {
        $output = "";
        if( $array && is_array($array) ){
            foreach ( $array as $key => $value ){
                $output .= "<input type='hidden' id='{$key}' name='{$key}' value='{$value}'>";
            }
        }
        return $output;
    }
}
