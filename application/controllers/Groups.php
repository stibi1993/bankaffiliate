<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Groups extends Public_Controller
{

    function __construct()
    {
        parent::__construct();
        //if (!$this->ion_auth->in_group('admin')) {
        if (!in_array('view_group', $this->session->permissions)) {
            $this->session->set_flashdata('message', lang('permission_not_allowed'));
            redirect('admin', 'refresh');
        }
        $this->data['actual_page'] = "groups";
    }

    public function index()
    {
        $this->data['page_title'] = 'Groups';
        $this->data['groups'] = $this->ion_auth->groups()->result();
        $this->render('groups/list_groups_view');
    }

    public function create()
    {
        if (in_array('edit_group', $this->session->permissions)) {
            $this->data['page_title'] = 'Create group';
            $this->load->library('form_validation');
            $this->form_validation->set_rules('group_name', 'Group name', 'trim|required|is_unique[groups.name]');
            $this->form_validation->set_rules('group_description', 'Group description', 'trim|required');

            if ($this->form_validation->run() === FALSE) {
                $this->load->helper('form');
                //$this->render('admin/groups/create_group_view');
            } else {
                $group_name = $this->input->post('group_name');
                $group_description = $this->input->post('group_description');
                $this->ion_auth->create_group($group_name, $group_description);
                $this->session->set_flashdata('message', $this->ion_auth->messages());
                redirect('groups', 'refresh');
            }
            $this->render('groups/create_group_view');
        }
    }

    public function edit($group_id = NULL)
    {
        if (in_array('edit_group', $this->session->permissions)) {
            $group_id = $this->input->post('group_id') ? $this->input->post('group_id') : $group_id;
            $this->data['page_title'] = 'Edit group';
            $this->load->library('form_validation');

            $this->form_validation->set_rules('group_name', 'Group name', 'trim|required');
            $this->form_validation->set_rules('group_description', 'Group description', 'trim|required');
            $this->form_validation->set_rules('group_id', 'Group id', 'trim|integer|required');
            //$this->form_validation->set_rules('groups', 'Groups permission', 'required');

            if ($this->form_validation->run() === FALSE) {
                if ($group = $this->ion_auth->group((int)$group_id)->row()) {
                    $this->data['group_permissions'] = $this->getPermissionsByUserGroupId($group->id);
                    $this->data['permissions'] = $this->permissions_model->get_all();
                    $this->data['group'] = $group;
                } else {
                    $this->session->set_flashdata('message', lang('record_id_error'));
                    redirect('groups', 'refresh');
                }
                $this->load->helper('form');
                $this->render('groups/edit_group_view');
            } else {
                $group_name = $this->input->post('group_name');
                $group_description = $this->input->post('group_description');
                $group_id = $this->input->post('group_id');
                $this->ion_auth->update_group($group_id, $group_name, $group_description);

                //Update the permissions of the group belongs to
                $group_permissions = $this->input->post('groups');
                $this->load->model('permissions_model');
                if (isset($group_permissions) && !empty($group_permissions)) {
                    $this->permissions_model->remove_from_permissions('', $group_id);
                    foreach ($group_permissions as $group_permission) {
                        $this->permissions_model->add_to_permission($group_permission, $group_id);
                    }
                }


                $this->session->set_flashdata('message', $this->ion_auth->messages());
                redirect('groups', 'refresh');
            }
        }
    }

    public function delete($group_id = NULL)
    {
        if (in_array('edit_group', $this->session->permissions)) {
            if (is_null($group_id)) {
                $this->session->set_flashdata('message', lang('record_delete_error'));
            } else {
                $this->ion_auth->delete_group($group_id);
                $this->session->set_flashdata('message', $this->ion_auth->messages());
            }
            redirect('groups', 'refresh');
        }
    }
    
    public function getPermissionsByUserGroupId($usergroup_id = null)
    {
    	$this->load->model('permissions_model');
    	$permissions = $this->permissions_model->get_by_group_id($usergroup_id);
    	$session_permissions = array();
    	if(!empty($permissions)){
	    	foreach ($permissions as $permission){
	    		$session_permissions[]=$permission->perm_id;
	    	}
    	}
    	return $session_permissions;
    }
}