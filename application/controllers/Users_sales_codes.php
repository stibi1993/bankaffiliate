<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Users_sales_codes extends Public_Controller
{
    function __construct()
    {
        parent::__construct();
        //if (!$this->ion_auth->in_group('admin')) {
        if (! in_array('edit_users', $this->session->permissions)){
            $this->session->set_flashdata('message', lang("structure_allowed"));
            redirect('', 'refresh');
        }
        
        $this->load->library('form_validation');
        $this->load->model('users_sales_codes_model');
        $this->data['actual_page'] = "users_sales_codes";
    }

    public function create()
    {
        if (in_array('edit_structures', $this->session->permissions))
        {
            $this->form_validation->set_rules('title', 'Company name', 'trim|required');

        	$msg = "";

            if ($this->form_validation->run() === FALSE)
            {
                if(strlen(validation_errors()) > 0){
                    $this->session->set_flashdata('message', lang("form_error"));
                }

                $this->load->helper('dropdown');
                $this->data['product_categories'] = dropdown_data('product_category');
                array_shift($this->data['product_categories']);
                $this->data['current_product_categories'] = [];
                $this->render('structures/create_structures_view');
            }
            else
            {
                $new = array(
                    'title' => $this->input->post('title'),
                    'product_categories' => implode(',', $_REQUEST['product_categories'])
                );
                

                $last_insert_id  = $this->structures_model->create($new);

                if($msg){
                	redirect('structures/update/'.$last_insert_id, 'refresh');
                }else{
                	$this->session->set_flashdata('message', lang("structure_success"));

                	redirect('structures', 'refresh');
                }
                
                //redirect('companies', 'refresh');
            }
        }
    }

   
    
    public function update($id = NULL)
    {
        if (in_array('edit_users', $this->session->permissions))
        {
            $this->form_validation->set_rules('bank_id', '', 'required');
            $this->form_validation->set_rules('datum', '', 'trim|required');
            $this->form_validation->set_rules('azonosito', '', 'trim|required');
            $this->form_validation->set_rules('product_categories[]', '', 'required');

            $id = isset($id) ? (int)$id : (int)$this->input->post('id');
            $sales_code = $this->users_sales_codes_model->get_by_id($id);


            if ($this->form_validation->run() === FALSE) {

                if(strlen(validation_errors()) > 0){
                    $this->session->set_flashdata('message', lang("form_error"));
                }

                if ($this->data['users_sales_code'] = $sales_code)
                {
                    $this->load->helper('dropdown');
                    $all_product_categories = dropdown_data('product_category');
                    array_shift($all_product_categories);
                    $user = $this->ion_auth->user((int)$sales_code->user_id)->row();
                    $possible_product_categories = explode(',', $user->product_categories);

                    foreach ($possible_product_categories as $item)
                        $this->data['product_categories'][$item] = $all_product_categories[$item];

                    $this->load->model('banks_model');
                    $this->data['bank_list'] = dropdown_data('bank', $this->banks_model);

                    $this->data['current_product_categories'] = explode(',', $sales_code->product_categories);
                    $this->data['update'] = true;
                    $this->render('users_sales_codes/create_users_sales_codes_view');
                }
                else
                {
                    $this->session->set_flashdata('message', lang("error"));
                    redirect('companies', 'refresh');
                }
            }
            else
            {
                $new_data = array(
                    'bank_id' => $this->input->post('bank_id'),
                    'kapcsolattarto_fiok_neve' => ($this->input->post('kapcsolattarto_fiok_neve') ? $this->input->post('kapcsolattarto_fiok_neve') : null),
                    'kapcsolattarto_fiok_kodja' => ($this->input->post('kapcsolattarto_fiok_kodja') ? $this->input->post('kapcsolattarto_fiok_kodja') : null),
                    'kapcsolattarto_fiok_cime' => ($this->input->post('kapcsolattarto_fiok_cime') ? $this->input->post('kapcsolattarto_fiok_cime') : null),
                    'datum' => $this->input->post('datum'),
                    'azonosito' => $this->input->post('azonosito'),
                    'product_categories' => implode(',', $this->input->post('product_categories[]'))
                );

            //    $this->session->set_flashdata('message', 'Company updated successfuly');
                if (! $this->users_sales_codes_model->update($id, $new_data))
                     $this->session->set_flashdata('message', lang("error"));

                redirect('users/edit/'.$sales_code->user_id, 'refresh');
            }
        }
    }

    public function delete($id)
    {
        $item = $this->users_sales_codes_model->get_by_id($id);
        if (in_array('edit_users', $this->session->permissions))
        {
            $this->session->set_flashdata('message', lang("record_delete_".($this->users_sales_codes_model->delete($id) === FALSE ? 'error' : 'success')));
            redirect('users/edit/' . $item->user_id, 'refresh');
        }
    }

}
