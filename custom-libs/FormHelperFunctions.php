<?php
/**
 * Created by Naveed ul Hassan
 * Date: 4/27/2015
 * Time: 4:21 PM
 */

/**
 * @param $array
 * @param $inputName
 * @return string
 * safely get the value of an input from an array like $_POST or $_SESSION
 */
function valFromArray( $array , $inputName )
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
function selectAttrFromArray( $array , $selectTagName , $optionTagValue )
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
function hiddenInputsForArray($array)
{
    $output = "";
    if( $array && is_array($array) ){
        foreach ( $array as $key => $value ){
            $output .= "<input type='hidden' id='{$key}' name='{$key}' value='{$value}'>";
        }
    }
    return $output;
}