<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Labels extends Public_Controller
{

    function __construct()
    {
        parent::__construct();
    }

    public function index()
    {

     if (!in_array('edit_custom_labels', $this->session->permissions)) {
        echo redirect("dashboard");
     }
        $this->load->model('label_model');
        $this->load->library('form_validation');
        $this->data['actual_page'] = "labels";
        $this->data['page_title'] = 'Label edit';

        $this->form_validation->set_rules('mission_home_home_country', 'Home country', 'trim');

            $employee_labels = $this->label_model->get_all_by_page("employee");
            if (!empty($employee_labels)) {
                foreach ($employee_labels as $label) {

                    $labelsData = $this->label_model->get_all_custom("company_id = " . $this->session->userdata["company_id"] . " AND lang = '" . $this->session->language . "' AND label_code = '" . $label->label_code . "'");
                    $labelsData = $labelsData[0];

                    if (!empty($labelsData->custom_label)) {
                        $label->custom_label = $labelsData->custom_label;
                    } else {
                        $label->custom_label = null;
                    }

                }
            }
            $this->data['employee_labels'] = $employee_labels;

            $family_labels = $this->label_model->get_all_by_page("family");
            if (!empty($family_labels)) {
                foreach ($family_labels as $label) {

                    $labelsData = $this->label_model->get_all_custom("company_id = " . $this->session->userdata["company_id"] . " AND lang = '" . $this->session->language . "' AND label_code = '" . $label->label_code . "'");
                    $labelsData = $labelsData[0];

                    if (!empty($labelsData->custom_label)) {
                        $label->custom_label = $labelsData->custom_label;
                    } else {
                        $label->custom_label = null;
                    }

                }
            }
            $this->data['family_labels'] = $family_labels;

            $mission_home_labels = $this->label_model->get_all_by_page("mission_home");
            if (!empty($mission_home_labels)) {
                foreach ($mission_home_labels as $label) {

                    $labelsData = $this->label_model->get_all_custom("company_id = " . $this->session->userdata["company_id"] . " AND lang = '" . $this->session->language . "' AND label_code = '" . $label->label_code . "'");
                    $labelsData = $labelsData[0];

                    if (!empty($labelsData->custom_label)) {
                        $label->custom_label = $labelsData->custom_label;
                    } else {
                        $label->custom_label = null;
                    }

                }
            }
            $this->data['mission_home_labels'] = $mission_home_labels;

            $mission_host_labels = $this->label_model->get_all_by_page("mission_host");
            if (!empty($mission_host_labels)) {
                foreach ($mission_host_labels as $label) {

                    $labelsData = $this->label_model->get_all_custom("company_id = " . $this->session->userdata["company_id"] . " AND lang = '" . $this->session->language . "' AND label_code = '" . $label->label_code . "'");
                    $labelsData = $labelsData[0];

                    if (!empty($labelsData->custom_label)) {
                        $label->custom_label = $labelsData->custom_label;
                    } else {
                        $label->custom_label = null;
                    }

                }
            }
            $this->data['mission_host_labels'] = $mission_host_labels;


            $mission_general_labels = $this->label_model->get_all_by_page("mission_general");
            if (!empty($mission_general_labels)) {
                foreach ($mission_general_labels as $label) {

                    $labelsData = $this->label_model->get_all_custom("company_id = " . $this->session->userdata["company_id"] . " AND lang = '" . $this->session->language . "' AND label_code = '" . $label->label_code . "'");
                    $labelsData = $labelsData[0];

                    if (!empty($labelsData->custom_label)) {
                        $label->custom_label = $labelsData->custom_label;
                    } else {
                        $label->custom_label = null;
                    }

                }
            }
            $this->data['mission_general_labels'] = $mission_general_labels;

            $mission_social_labels = $this->label_model->get_all_by_page("mission_social");
            if (!empty($mission_social_labels)) {
                foreach ($mission_social_labels as $label) {

                    $labelsData = $this->label_model->get_all_custom("company_id = " . $this->session->userdata["company_id"] . " AND lang = '" . $this->session->language . "' AND label_code = '" . $label->label_code . "'");
                    $labelsData = $labelsData[0];

                    if (!empty($labelsData->custom_label)) {
                        $label->custom_label = $labelsData->custom_label;
                    } else {
                        $label->custom_label = null;
                    }

                }
            }
            $this->data['mission_social_labels'] = $mission_social_labels;


            $mission_relocation_labels = $this->label_model->get_all_by_page("mission_relocation");
            if (!empty($mission_relocation_labels)) {
                foreach ($mission_relocation_labels as $label) {

                    $labelsData = $this->label_model->get_all_custom("company_id = " . $this->session->userdata["company_id"] . " AND lang = '" . $this->session->language . "' AND label_code = '" . $label->label_code . "'");
                    $labelsData = $labelsData[0];

                    if (!empty($labelsData->custom_label)) {
                        $label->custom_label = $labelsData->custom_label;
                    } else {
                        $label->custom_label = null;
                    }

                }
            }
            $this->data['mission_relocation_labels'] = $mission_relocation_labels;

        if ($this->form_validation->run() === FALSE) {

            if(strlen(validation_errors()) > 0){
                $this->session->set_flashdata('message', lang("form_error"));
            }

        }else{
            //var_dump($employee_labels);
            $updated_labels_array = array();
            $i = 0;

            foreach ($employee_labels as $label){
                if($this->input->post($label->label_code) != null) {
                    $updated_labels_array[$i]["label_id"] = $label->id;
                    //$updated_labels_array[$i]["label_code"] = $label->label_code;
                    $updated_labels_array[$i]["custom_label"] = $this->input->post($label->label_code);
                    //$updated_labels_array[$i]["page"] = $label->page;
                    $updated_labels_array[$i]["company_id"] = $this->session->userdata["company_id"];
                    $updated_labels_array[$i]["lang"] = $this->session->language;
                    $i++;
                }
            }


            foreach ($family_labels as $label){
                if($this->input->post($label->label_code) != null) {
                    $updated_labels_array[$i]["label_id"] = $label->id;
                    //$updated_labels_array[$i]["label_code"] = $label->label_code;
                    $updated_labels_array[$i]["custom_label"] = $this->input->post($label->label_code);
                    //$updated_labels_array[$i]["page"] = $label->page;
                    $updated_labels_array[$i]["company_id"] = $this->session->userdata["company_id"];
                    $updated_labels_array[$i]["lang"] = $this->session->language;
                    $i++;
                }
            }

            foreach ($mission_home_labels as $label){
                if($this->input->post($label->label_code) != null) {
                    $updated_labels_array[$i]["label_id"] = $label->id;
                    //$updated_labels_array[$i]["label_code"] = $label->label_code;
                    $updated_labels_array[$i]["custom_label"] = $this->input->post($label->label_code);
                    //$updated_labels_array[$i]["page"] = $label->page;
                    $updated_labels_array[$i]["company_id"] = $this->session->userdata["company_id"];
                    $updated_labels_array[$i]["lang"] = $this->session->language;
                    $i++;
                }
            }

            foreach ($mission_host_labels as $label){
                if($this->input->post($label->label_code) != null) {
                    $updated_labels_array[$i]["label_id"] = $label->id;
                    //$updated_labels_array[$i]["label_code"] = $label->label_code;
                    $updated_labels_array[$i]["custom_label"] = $this->input->post($label->label_code);
                    //$updated_labels_array[$i]["page"] = $label->page;
                    $updated_labels_array[$i]["company_id"] = $this->session->userdata["company_id"];
                    $updated_labels_array[$i]["lang"] = $this->session->language;
                    $i++;
                }
            }

            foreach ($mission_host_labels as $label){
                if($this->input->post($label->label_code) != null) {
                    $updated_labels_array[$i]["label_id"] = $label->id;
                    //$updated_labels_array[$i]["label_code"] = $label->label_code;
                    $updated_labels_array[$i]["custom_label"] = $this->input->post($label->label_code);
                    //$updated_labels_array[$i]["page"] = $label->page;
                    $updated_labels_array[$i]["company_id"] = $this->session->userdata["company_id"];
                    $updated_labels_array[$i]["lang"] = $this->session->language;
                    $i++;
                }
            }

            foreach ($mission_general_labels as $label){
                if($this->input->post($label->label_code) != null) {
                    $updated_labels_array[$i]["label_id"] = $label->id;
                    //$updated_labels_array[$i]["label_code"] = $label->label_code;
                    $updated_labels_array[$i]["custom_label"] = $this->input->post($label->label_code);
                    //$updated_labels_array[$i]["page"] = $label->page;
                    $updated_labels_array[$i]["company_id"] = $this->session->userdata["company_id"];
                    $updated_labels_array[$i]["lang"] = $this->session->language;
                    $i++;
                }
            }

            foreach ($mission_social_labels as $label){
                if($this->input->post($label->label_code) != null) {
                    $updated_labels_array[$i]["label_id"] = $label->id;
                    //$updated_labels_array[$i]["label_code"] = $label->label_code;
                    $updated_labels_array[$i]["custom_label"] = $this->input->post($label->label_code);
                    //$updated_labels_array[$i]["page"] = $label->page;
                    $updated_labels_array[$i]["company_id"] = $this->session->userdata["company_id"];
                    $updated_labels_array[$i]["lang"] = $this->session->language;
                    $i++;
                }
            }

            foreach ($mission_relocation_labels as $label){
                if($this->input->post($label->label_code) != null) {
                    $updated_labels_array[$i]["label_id"] = $label->id;
                    //$updated_labels_array[$i]["label_code"] = $label->label_code;
                    $updated_labels_array[$i]["custom_label"] = $this->input->post($label->label_code);
                    //$updated_labels_array[$i]["page"] = $label->page;
                    $updated_labels_array[$i]["company_id"] = $this->session->userdata["company_id"];
                    $updated_labels_array[$i]["lang"] = $this->session->language;
                    $i++;
                }
            }

            //var_dump($updated_labels_array);

            $this->label_model->delete($this->session->userdata["company_id"], $this->session->language);
            $this->label_model->insert($updated_labels_array, $this->session->language);

            $this->session->set_userdata("custom_labels", $this->label_model->get_all_custom("company_id = ".$this->session->userdata["company_id"]." AND lang = '". $this->session->language ."'" ));

        }
        $this->render('label/label_edit_view');

        //var_dump($this->session);
    }


}
