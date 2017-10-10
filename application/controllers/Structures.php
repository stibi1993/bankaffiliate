<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Structures extends Public_Controller
{
    function __construct()
    {
        parent::__construct();
        //if (!$this->ion_auth->in_group('admin')) {
        if (! in_array('view_structures', $this->session->permissions)){
            //$this->session->set_flashdata('message', lang("structure_allowed"));
            redirect('', 'refresh');
        }

        $this->load->library('form_validation');
        $this->load->model('structures_model');
        $this->data['actual_page'] = "structures";
    }

    public function index()
    {
        $this->load->helper('dropdown');
        $this->data['product_categories'] = dropdown_data('product_category');
        $this->data['structures'] = $this->structures_model->get_all();
        $this->render('structures/list_structures_view');
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
        if (in_array('edit_structures', $this->session->permissions))
        {
            $this->form_validation->set_rules('title', 'Title', 'trim|required');

            $id = isset($id) ? (int)$id : (int)$this->input->post('id');


            if ($this->form_validation->run() === FALSE) {

                if(strlen(validation_errors()) > 0){
                    $this->session->set_flashdata('message', lang("form_error"));
                }

                $item = $this->structures_model->get_by_id($id);
                if ($this->data['structure'] = $item)
                {
                    $this->load->helper('dropdown');
                    $this->data['product_categories'] = dropdown_data('product_category');
                    array_shift($this->data['product_categories']);

                    $this->data['current_product_categories'] = explode(',', $item->product_categories);
                    $this->data['update'] = true;
                    $this->render('structures/create_structures_view');
                }
                else
                {
                    $this->session->set_flashdata('message', lang("structure_id_error"));
                    redirect('structures', 'refresh');
                }
            }
            else
            {
                $new_data = array(
                    'title' => $this->input->post('title'),
                    'product_categories' => implode(',', $this->input->post('product_categories[]'))
                );

            //    $this->session->set_flashdata('message', 'Company updated successfuly');
                if (! $this->structures_model->update($id, $new_data))
                     $this->session->set_flashdata('message', lang("file_error"));

                redirect('structures/update/'.$id, 'refresh');
            }
        }
    }


    public function delete($id)
    {
        if (in_array('edit_structures', $this->session->permissions))
        {
            $this->session->set_flashdata('message', lang("record_delete_".($this->structures_model->delete($id) === FALSE ? 'error' : 'success')));
            redirect('structures', 'refresh');
        }
    }

    public function get()
    {
        $id = $_POST["data"];
        $item = $this->structures_model->get_by_id($id);
        $this->data['item'] = $item;
        $this->render('', "json");

    }
}
