<?php
/**
 * Created by PhpStorm.
 * User: patrikx3
 * Date: 4/3/2016
 * Time: 2:04 AM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

function cvs_row($field) {
    $field = str_replace("\"", '\"', $field);
    $field = str_replace("\r", ' ', $field);
    $field = str_replace("\n", ' ', $field);

    return '"'. $field . '"';
}