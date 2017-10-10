<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('googlemaps_data')) {

    /**
     * @param $id
     * @param $type
     * @return string
     */
    function googlemaps_data($id, $type)
    {

        $CI = get_instance();
        $CI->load->model('countries_model');
        $CI->load->model('cities_model');

        switch ($type) {
            case "hostcountry":
                $country_labels = $CI->countries_model->get_by_id($id);
                $country_labels = $country_labels[0];
                return $country_labels->name;
                break;
            case "hostcity":
                $cites_labels = $CI->cities_model->get_by_id($id);
                $cites_labels = $cites_labels[1];
                return $cites_labels->label;
                break;
            case "homecountry":
                $country_labels = $CI->countries_model->get_by_id($id);
                $country_labels = $country_labels[0];
                return $country_labels->name;
                break;
            case "homecity":
                $cites_labels = $CI->cities_model->get_by_id($id);
                $cites_labels = $cites_labels[1];
                return $cites_labels->label;
                break;
        }
    }

}