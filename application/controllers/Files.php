<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Files extends Public_Controller
{
    function __construct()
    {
        parent::__construct();

        $this->load->library('form_validation');
        $this->load->model('files_model');
        $this->data['actual_page'] = "files";
    }

    public function create()
    {
        if (in_array('edit_files', $this->session->permissions))
        {
            $this->form_validation->set_rules('title', '', 'trim');
            $this->form_validation->set_rules('document_type', '', 'required');
            $this->form_validation->set_rules('table', 'Tábla', 'required');
            $this->form_validation->set_rules('table_id', 'Tábla azonosító', 'required');

            $msg = '';
            $file = $_FILES["file"]["name"];
            $path_piece = rtrim($this->input->post('table'), 's');
            if (empty($file))
                $msg = 'file missing';
            else
            {
                $config['upload_path'] = './uploads/'.$path_piece.'/';
                $config['allowed_types'] = 'jpg|gif|png|pdf';
            //    $config['max_size'] = 1024 * 2;
                $config['encrypt_name'] = TRUE;

                $this->load->library('upload', $config);

                //var_dump($this->upload->do_upload("userPicture"));
                if (! $this->upload->do_upload("file"))
                {
                    //echo "BENT"; exit();
                    $status = 'error';
                    $msg .= $this->upload->display_errors();

                    //todo [CL] image upload errors flash massege
                    $this->session->set_flashdata('message', $msg);
                    //redirect('employees/create', 'refresh');

                } else {
                    $data = $this->upload->data();
                    /*if ($data['image_width'] != $data['image_height']) {
                        $msg .= lang('upload_picture_cubic') . '<br/>';
                        $this->session->set_flashdata('message', $msg);
                        $user_pic_real = null;
                        @unlink($data['full_path']);
                    } else {*/
                    $filename = $data["file_name"];
                    //}
                }
            }

            if (($this->form_validation->run() === FALSE) || $msg)
            {
                if(strlen(validation_errors()) > 0){
                    $this->session->set_flashdata('message', $msg . lang("form_error"));
                }
                $this->load->helper('dropdown');
                $this->render('files/create_view');
            }
            else
            {
                $new = array(
                    'filename' => $filename,
                    'title' => ($this->input->post('title') ? $this->input->post('title') : null),
                    'document_type'=> $this->input->post('document_type'),
                    rtrim($this->input->post('table'), 's').'_id' => $this->input->post('table_id')
                );

                $last_insert_id  = $this->files_model->create($new);

                if($msg)
                {
                	redirect($this->input->post('table').'/update/'.$this->input->post('table_id'), 'refresh');
                }
                else
                {
                	$this->session->set_flashdata('message', lang("file_success"));

                    redirect($this->input->post('table').'/update/'.$this->input->post('table_id'), 'refresh');
                }
                
                //redirect('companies', 'refresh');
            }
        }
    }

    public function update($id = NULL)
    {
        if (in_array('edit_files', $this->session->permissions))
        {
            $this->form_validation->set_rules('title', '', 'trim');
            $this->form_validation->set_rules('document_type', '', 'required');
            $this->form_validation->set_rules('table', 'Tábla', 'required');
            $this->form_validation->set_rules('table_id', 'Tábla azonosító', 'required');

            $id = isset($id) ? (int)$id : (int)$this->input->post('id');


            if ($this->form_validation->run() === FALSE) {

                if (strlen(validation_errors()) > 0){
                    $this->session->set_flashdata('message', lang("form_error"));
                }

                $item = $this->files_model->get_by_id($id);
                if ($this->data['file'] = $item)
                {
                    $this->load->helper('dropdown');
                    $this->data['document_path'] = base_url('uploads/'.rtrim($_GET['table'], 's').'/'.$item->filename);
                    $this->data['update'] = true;
                    $this->render('files/create_view');
                }
                else
                {
                    $this->session->set_flashdata('message', lang("file_id_error"));
                    redirect($this->input->post('table').'/update/'.$this->input->post('table_id'), 'refresh');
                }
            }
            else
            {
                $new_data = array(
                    'title' => $this->input->post('title'),
                    'document_type' => $this->input->post('document_type')
                );

            //    $this->session->set_flashdata('message', 'Company updated successfuly');
                if (! $this->files_model->update($id, $new_data))
                     $this->session->set_flashdata('message', lang("file_error"));

                redirect($this->input->post('table').'/update/'.$this->input->post('table_id'), 'refresh');
            }
        }
    }


    public function delete($id)
    {
        if (in_array('edit_files', $this->session->permissions))
        {
            $this->session->set_flashdata('message', lang("record_delete_".($this->files_model->delete($id) === FALSE ? 'error' : 'success')));
            redirect(($this->input->post('table') ? $this->input->post('table') : $_GET['table']).'/update/'.($this->input->post('table_id') ? $this->input->post('table_id') : $_GET['table_id']), 'refresh');
        }
    }

    public function get()
    {
        $id = $_POST["data"];
        $item = $this->structures_model->get_by_id($id);
        $this->data['item'] = $item;
        $this->render('structure/show_structure', "json");

    }
}
