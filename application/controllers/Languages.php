<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Languages extends Public_Controller
{
    function __construct()
    {
        parent::__construct();
        //if (!$this->ion_auth->in_group('admin')) {
        if (!in_array('view_languages', $this->session->permissions)) {
            $this->session->set_flashdata('message', lang('permission_not_allowed'));
            redirect('', 'refresh');
        }
        $this->load->library('form_validation');
        $this->load->model('language_model');
        $this->data['actual_page'] = "languages";
    }

    public function index()
    {
        $this->data['languages'] = $this->language_model->get_all();
        $this->render('languages/index_view');
    }

    public function create()
    {
        if (in_array('edit_languages', $this->session->permissions)) {
            $this->form_validation->set_rules('language_name', 'Language name', 'trim|required|is_unique[languages.language_name]');
            $this->form_validation->set_rules('language_slug', 'Slug', 'trim|alpha_dash|required|is_unique[languages.slug]');
            $this->form_validation->set_rules('language_directory', 'Language directory', 'trim|required');
            $this->form_validation->set_rules('language_code', 'Language code', 'trim|alpha_dash|required|is_unique[languages.language_code]');
            $this->form_validation->set_rules('default', 'Default', 'trim|in_list[0,1]');

            if ($this->form_validation->run() === FALSE) {

                if(strlen(validation_errors()) > 0){
                    $this->session->set_flashdata('message', lang("form_error"));
                }

                $this->render('languages/create_view');
            } else {
                $new_language = array(
                    'language_name' => $this->input->post('language_name'),
                    'slug' => $this->input->post('language_slug'),
                    'language_directory' => $this->input->post('language_directory'),
                    'language_code' => $this->input->post('language_code'),
                    'default' => $this->input->post('default')
                );
                $this->session->set_flashdata('message', lang('record_insert_success'));
                if (!$this->language_model->create($new_language)) {
                    $this->session->set_flashdata('message', lang('record_insert_error'));
                }
                redirect('languages', 'refresh');
            }
        }
    }

    public function update($language_id = NULL)
    {
        if (in_array('edit_languages', $this->session->permissions)) {
            $this->form_validation->set_rules('language_name', 'Language name', 'trim|required');
            $this->form_validation->set_rules('language_slug', 'Slug', 'trim|alpha_dash|required');
            $this->form_validation->set_rules('language_directory', 'Language directory', 'trim|required');
            $this->form_validation->set_rules('language_code', 'Language code', 'trim|alpha_dash|required');
            $this->form_validation->set_rules('default', 'Default', 'trim|in_list[0,1]');
            $this->form_validation->set_rules('language_id', 'Language ID', 'trim|integer');

            $language_id = isset($language_id) ? (int)$language_id : (int)$this->input->post('language_id');

            if ($this->form_validation->run() === FALSE) {

                if(strlen(validation_errors()) > 0){
                    $this->session->set_flashdata('message', lang("form_error"));
                }

                $language = $this->language_model->get_by_id($language_id);
                if ($this->data['language'] = $language[0]) {
                    $this->render('languages/edit_view');
                } else {
                    $this->session->set_flashdata('message', lang('record_id_error'));
                    redirect('languages', 'refresh');
                }
            } else {
                $new_data = array(
                    'language_name' => $this->input->post('language_name'),
                    'slug' => $this->input->post('language_slug'),
                    'language_directory' => $this->input->post('language_directory'),
                    'language_code' => $this->input->post('language_code'),
                    'default' => $this->input->post('default')
                );
                $this->session->set_flashdata('message', lang('record_update_success'));
                if (!$this->language_model->update($language_id, $new_data)) {
                    $this->session->set_flashdata('message', lang('record_update_error'));
                }
                redirect('languages', 'refresh');
            }
        }
    }


    public function delete($language_id)
    {
        if (in_array('edit_languages', $this->session->permissions)) {
            $language = $this->language_model->get_by_id($language_id);

            if (!isset($language->default)) {
                $language = new stdClass();
                $language->default = false;
            }

            if ($language && $language->default == '1') {
                $this->session->set_flashdata('message', lang('controller_languages_delete_default'));
            } elseif ($this->language_model->delete($language_id) === FALSE) {
                $this->session->set_flashdata('message', lang('record_delete_error'));
            } else {
                $this->session->set_flashdata('message', lang('record_delete_success'));
            }
            redirect('languages', 'refresh');
        }
    }
}
