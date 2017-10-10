<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Companies extends Public_Controller
{
    function __construct()
    {
        parent::__construct();
        //if (!$this->ion_auth->in_group('admin')) {
        if (!in_array('view_companies', $this->session->permissions)){
            $this->session->set_flashdata('message', lang("company_allowed"));
            redirect('', 'refresh');
        }

        $this->load->library('form_validation');
        $this->load->model('companies_model');
        $this->data['actual_page'] = "companies";
    }

    public function index()
    {
        $this->data['companies'] = $this->companies_model->get_all();
        $this->render('companies/list_companies_view');
    }

    public function create()
    {
        if (in_array('edit_companies', $this->session->permissions)) {
        	$msg = "";
            $this->form_validation->set_rules('company_name', 'Company name', 'trim|required|is_unique_company_name[companies.company_name]');
//            $this->form_validation->set_rules('company_description', 'Company description', 'trim|is_unique[companies.company_description]');
//            $this->form_validation->set_rules('companyPicture', 'Company Logo', 'trim');
            $this->form_validation->set_rules('tax_no', '', 'trim|required|regex_match[/^\d{8}-\d{1}-\d{2}$/]');
            $this->form_validation->set_rules('fundation_date', '', 'trim|required|callback_date_valid');
            $this->form_validation->set_rules('reg_office_postcode', '', 'trim|integer|required|exact_length[4]');
            $this->form_validation->set_rules('reg_office_town', '', 'trim|required');
            $this->form_validation->set_rules('reg_office_street', '', 'trim|required');
            $this->form_validation->set_rules('representative_name', '', 'trim');
            $this->form_validation->set_rules('representative_birth_date', '', 'trim|callback_date_valid');
            $this->form_validation->set_rules('representative_id_card_no', '', 'trim|regex_match[/^\d{6}[A-Z]{2}$/]');
            $this->form_validation->set_rules('representative_address', '', 'trim');
            $this->form_validation->set_rules('teaor', '', 'trim|required');
            $this->form_validation->set_rules('bank_account_no', '', 'trim|required|regex_match[/^\d{8}-\d{8}(-\d{8})?$/]');
            $this->form_validation->set_rules('reg_no', '', 'trim|required');
            $this->form_validation->set_rules('area_code', '', 'required');
            if (in_array($this->input->post('area_code'), array('20', '30', '31', '70', '1')))
                $this->form_validation->set_rules('phone_no', '', 'trim|required|exact_length[7]');
            else
                $this->form_validation->set_rules('phone_no', '', 'trim|required|exact_length[6]');
            $this->form_validation->set_rules('email', '', 'trim|valid_email|required');


            if ($this->form_validation->run() === FALSE) {

                if(strlen(validation_errors()) > 0){
                    $this->session->set_flashdata('message', lang("form_error"));
                }

                $this->load->helper('dropdown');

                $this->render('companies/create_companies_view');
            } else {

                $picture = $_FILES["companyPicture"]["name"];

                if (!empty($picture)) {

                    $config['upload_path'] = './uploads/company/';
                    $config['allowed_types'] = 'jpg|gif|png|';
                    $config['max_size'] = 1024 * 2;
                    $config['encrypt_name'] = TRUE;

                    $this->load->library('upload', $config);

                    if (!$this->upload->do_upload("companyPicture")) {
                        $status = 'error';
                        $msg .= $this->upload->display_errors();
                        //todo [CL] image upload errors flash massege
                        $this->session->set_flashdata('message', $msg);
                        $company_pic_real = $data["file_name"] = null;
                    } else {
                        $data = $this->upload->data();
                        if ($data['image_width'] <= $data['image_height'] * 1.6) {
                            $msg .= 'Wrong picture dimensions, because width: ' . $data['image_width'] .  ' and height: ' . $data['image_height'] .' but the height can\'t bigger like the 60% of the width.<br/>';
                            $this->session->set_flashdata('message', $msg);
                            $company_pic_real  = null;
                            @unlink($data['full_path']);
                        } else {
                            $company_pic_real  = $data["file_name"];
                        }
                    }

                } else {
                    $company_pic_real = "";
                }

                $new_company = array(
                    'company_name' => $this->input->post('company_name'),
//                    'company_description' => $this->input->post('company_description'),
                    'default_language' => ($this->input->post('default_language') ? $this->input->post('default_language') : 'hu'),
                    'tax_no' => $this->input->post('tax_no'),
                    'fundation_date' => $this->input->post('fundation_date'),
                    'reg_office_postcode' => $this->input->post('reg_office_postcode'),
                    'reg_office_town' => $this->input->post('reg_office_town'),
                    'reg_office_street' => $this->input->post('reg_office_street'),
                    'representative_name' => $this->input->post('representative_name'),
                    'representative_birth_date' => $this->input->post('representative_birth_date'),
                    'representative_id_card_no' => $this->input->post('representative_id_card_no'),
                    'representative_address' => $this->input->post('representative_address'),
                    'teaor' => $this->input->post('teaor'),
                    'bank_account_no' => $this->input->post('bank_account_no'),
                    'reg_no' => $this->input->post('reg_no'),
                    'phone' => $this->input->post('phone'),
                    'email' => $this->input->post('email')
                );


                if(!empty($company_pic_real))
                	$new_company['company_logo'] = $company_pic_real;


              //$this->session->set_flashdata('message', 'Company added successfully');

             $last_insert_id  = $this->companies_model->create($new_company);

                //die($last_insert_id);

                if($msg){
                	redirect('companies/update/'.$last_insert_id, 'refresh');
                }else{
                	$this->session->set_flashdata('message', lang("company_sucess"));

                	redirect('companies', 'refresh');
                }

                //redirect('companies', 'refresh');
            }
        }
    }



    public function update($company_id = NULL)
    {
        if (in_array('edit_companies', $this->session->permissions)) {
            $this->form_validation->set_rules('company_name', 'Company name', 'trim|required');
//            $this->form_validation->set_rules('company_description', 'Company description', 'trim');
//            $this->form_validation->set_rules('companyPicture', 'Company Logo', 'trim');
            $this->form_validation->set_rules('tax_no', '', 'trim|required|regex_match[/^\d{8}-\d{1}-\d{2}$/]');
            $this->form_validation->set_rules('fundation_date', '', 'trim|required|callback_date_valid');
            $this->form_validation->set_rules('reg_office_postcode', '', 'trim|integer|required|exact_length[4]');
            $this->form_validation->set_rules('reg_office_town', '', 'trim|required');
            $this->form_validation->set_rules('reg_office_street', '', 'trim|required');
            $this->form_validation->set_rules('representative_name', '', 'trim');
            $this->form_validation->set_rules('representative_birth_date', '', 'trim|callback_date_valid');
            $this->form_validation->set_rules('representative_id_card_no', '', 'trim|regex_match[/^\d{6}[A-Z]{2}$/]');
            $this->form_validation->set_rules('representative_address', '', 'trim');
            $this->form_validation->set_rules('teaor', '', 'trim|required|regex_match[/^\d{4}$/]');
            $this->form_validation->set_rules('bank_account_no', '', 'trim|required|regex_match[/^\d{8}-\d{8}(-\d{8})?$/]');
            $this->form_validation->set_rules('reg_no', '', 'trim|required');
            $this->form_validation->set_rules('area_code', '', 'required');
            if (in_array($this->input->post('area_code'), array('20', '30', '31', '70', '1')))
                $this->form_validation->set_rules('phone_no', '', 'trim|required|exact_length[7]');
            else
                $this->form_validation->set_rules('phone_no', '', 'trim|required|exact_length[6]');
            $this->form_validation->set_rules('email', '', 'trim|valid_email|required');

            $company_id = isset($company_id) ? (int)$company_id : (int)$this->input->post('id');

            if ($this->form_validation->run() === FALSE)
            {
                if(strlen(validation_errors()) > 0){
                    $this->session->set_flashdata('message', lang("form_error"));
                }

                if ($this->data['company'] = $this->companies_model->get_by_id($company_id))
                {
                    $this->data['company']->area_code = substr($this->data['company']->phone, 3, 2);
                    $this->data['company']->phone_no = substr($this->data['company']->phone, 5);
                    $this->load->helper('dropdown');
                    $this->data['update'] = true;
                    $this->render('companies/create_companies_view');
                }
                else
                {
                    $this->session->set_flashdata('message', lang("company_id_error"));
                    redirect('companies', 'refresh');
                }
            }
            else
            {
                $picture = $_FILES["companyPicture"]["name"];
                $msg = "";

                if (!empty($picture)) {

                    $config['upload_path'] = './uploads/company/';
                    $config['allowed_types'] = 'jpg|gif|png|';
                    $config['max_size'] = 1024 * 2;
                    $config['encrypt_name'] = TRUE;

                    $this->load->library('upload', $config);

                    if (!$this->upload->do_upload("companyPicture")) {
                        $status = 'error';
                        //todo [CL] image upload errors flash massege
                      	$msg .= $this->upload->display_errors();
                      	$this->session->set_flashdata('message', $msg);
                        $company_pic_real = $data["file_name"] = null;
                    } else {
                        $data = $this->upload->data();

                        if ($data['image_width'] <= $data['image_height'] * 1.6) {
                            //$msg .= 'Wrong picture dimensions, the height can\'t bigger like the 60% of the width.<br/>';
                            $msg .= 'Wrong picture dimensions, because width: ' . $data['image_width'] .  ' and height: ' . $data['image_height'] .' but the height can\'t bigger like the 60% of the width.<br/>';
                            $this->session->set_flashdata('message', $msg);
                            $company_pic_real  = null;
                            @unlink($data['full_path']);
                        } else {
                            $company_pic_real  = $data["file_name"];
                        }

                    }

                } else {
                    $company_pic_real = "";
                }

                $new_data = array(
                    'company_name' => $this->input->post('company_name'),
//                    'company_description' => $this->input->post('company_description'),
                    'tax_no' => $this->input->post('tax_no'),
                    'fundation_date' => $this->input->post('fundation_date'),
                    'reg_office_postcode' => $this->input->post('reg_office_postcode'),
                    'reg_office_town' => $this->input->post('reg_office_town'),
                    'reg_office_street' => $this->input->post('reg_office_street'),
                    'representative_name' => $this->input->post('representative_name'),
                    'representative_birth_date' => $this->input->post('representative_birth_date'),
                    'representative_id_card_no' => $this->input->post('representative_id_card_no'),
                    'representative_address' => $this->input->post('representative_address'),
                    'teaor' => $this->input->post('teaor'),
                    'bank_account_no' => $this->input->post('bank_account_no'),
                    'reg_no' => $this->input->post('reg_no'),
                    'phone' => $this->input->post('phone'),
                    'email' => $this->input->post('email')
                );
                if(!empty($company_pic_real))
                	$new_data['company_logo'] = $company_pic_real;


            //    $this->session->set_flashdata('message', 'Company updated successfuly');
                if (!$this->companies_model->update($company_id, $new_data)) {

                    if(!$msg) {
                        $this->session->set_flashdata('message', lang("company_error"));
                    }
                }else{

                    if(!$msg){
                        $this->session->set_flashdata('message', lang("company_update"));
                    }

                }

                redirect('companies/update/'.$company_id, 'refresh');
            }
        }
    }

    public function date_valid($date){
        $year = (int) substr($date, 0, 4);
        $month = (int) substr($date, 5, 2);
        $day = (int) substr($date, 8, 2);
        return checkdate($month, $day, $year);
    }

    public function delete($id)
    {
        if (in_array('edit_companies', $this->session->permissions)) {

            if ($this->companies_model->delete($id) === FALSE) {
                $this->session->set_flashdata('message', lang("company_delete_error"));
            } else {
                $this->session->set_flashdata('message', lang("company_delete"));
            }
            redirect('companies', 'refresh');

        }
    }
    public function get()
    {
        $id = $_POST["data"];
        $item = $this->companies_model->get_by_id($id);
        $this->data['item'] = $item;
        $this->render('', "json");

    }

}
