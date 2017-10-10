<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Leads extends Public_Controller
{
    function __construct()
    {
        parent::__construct();
        //if (!$this->ion_auth->in_group('admin')) {
        if (! in_array('view_leads', $this->session->permissions)){
            $this->session->set_flashdata('message', lang("leads_allowed"));
            redirect('', 'refresh');
        }

        $this->load->library('form_validation');
        $this->load->model('leads_model');
        $this->data['actual_page'] = "leads";
    }

    public function index()
    {
        $this->load->model('users_model');
        $this->load->helper('dropdown');
        $this->data['user_list'] = dropdown_data('user', $this->users_model);
        $this->data['user_list'][''] = 'Bank360';
        $this->data['status_list'] = dropdown_data('lead_status');
        if (in_array('view_all_leads', $this->session->permissions))
        {
            $leads = $this->leads_model->get_by_user_ids('all');
        }
        elseif (in_array('view_structure_leads', $this->session->permissions))
        {
            $leads = $this->leads_model->get_by_structure_id($this->session->userdata('structure_id'));
        }
        else
        {
            $logged_user_id = $this->session->userdata('user_id');
            $user_ids = $this->users_model->get_all_children_id($logged_user_id);
            $user_ids[] = $logged_user_id;
            $leads = $this->leads_model->get_by_user_ids($user_ids);
        }
        $this->data['leads'] = $leads['items'];
        $this->data['now'] = date('Y-m-d H:i:s');

        $this->render('leads/list_view');
    }

    public function split()
    {
        if ($this->input->post('submit'))
        {
            $this->load->model('leads_model');
            foreach ($_POST as $key => $val)
            {
                if ((substr($key, 0, 5) == 'lead_') && $val)
                {
                    $lead_id = substr($key, 5);
                    $new = array(
                        'agent_id' => $val,
                        'splitter_id' => $this->session->userdata('user_id'),
                        'splitting_time' => date('Y-m-d H:i:s')
                    );
                    if (! $this->leads_model->update($lead_id, $new))
                    {
                        $this->session->set_flashdata('message', lang("lead_error"));
                        redirect('leads/split', 'refresh');
                    }
                    else
                    {
                        $agent = $this->ion_auth->user($val)->row();
                        $lead = $this->leads_model->get_by_id($lead_id);
                        $this->send_email($agent->email, $agent->last_name .' '.$agent->first_name, $lead);
                    }
                }
            }
            $this->session->set_flashdata('message', 'Lead leosztás megtörtént');
            redirect('leads/split', 'refresh');
        }
        else
        {
            $this->load->model('users_model');
            $this->load->helper('dropdown');
            $this->data['befizetes_allapota'] = dropdown_data('befizetes_allapota');
            $this->load->model('structures_model');
            $this->data['structure_list'] = dropdown_data('structure', $this->structures_model);
            $this->data['user_list'] = dropdown_data('user', $this->users_model);
            $this->data['status_list'] = dropdown_data('lead_status');
            $this->data['structures_agents'] = $this->users_model->get_all_indexed_by_structure();

            if (in_array('split_all_leads', $this->session->permissions))
            {
                $leads = $this->leads_model->get_not_splitted('all');
            }
            elseif (in_array('split_structure_leads', $this->session->permissions))
            {
                $leads = $this->leads_model->get_not_splitted_by_structure_id($this->session->userdata('structure_id'));
            }
            else
            {
                $logged_user_id = $this->session->userdata('user_id');
                $user_ids = $this->users_model->get_all_children_id($logged_user_id);
                $user_ids[] = $logged_user_id;
                $leads = $this->leads_model->get_not_splitted($user_ids);
            }
            $this->data['leads'] = $leads;
            $this->render('leads/list_split_view');
        }
    }

    public function create()
    {
        if (in_array('create_leads', $this->session->permissions))
        {
            $this->set_rules();

            $msg = "";

            if ($this->form_validation->run() === FALSE)
            {
                if(strlen(validation_errors()) > 0){
                    $this->session->set_flashdata('message', lang("form_error"));
                }
                $this->load->helper('dropdown');
                if ($this->ion_auth->get_users_groups()->row()->name != 'partners')
                {
                    $current_user = $this->ion_auth->user()->row();
                    $this->load->model('users_model');
                    $agents = $this->users_model->get_all_indexed_by_structure($current_user->structure_id);

                    $this->data['source_list'] = dropdown_data('agent', null, $agents);
                    $first = $this->data['source_list'][''];
                    unset($this->data['source_list']['']);
                    $this->data['source_list'] = array('' => $first, 'Bank360' => 'Bank360') + $this->data['source_list'];
                }

                $this->load->model('banks_model');
                $this->data['bank_list'] = dropdown_data('building_society', $this->banks_model);
                $this->render('leads/create_view');
            }
            else
            {
                $new = array(
                    'source' => $this->input->post('source') == 'Bank360' ? null : $this->input->post('source'),
                    'product_category' => 'HS',
                    'name' => $this->input->post('name'),
                    'postcode' => $this->input->post('postcode'),
                    'town' => $this->input->post('town'),
                    'street' => $this->input->post('street'),
                    'phone' => $this->input->post('phone'),
                    'email' => $this->input->post('email'),
                    'bank_id' => $this->input->post('bank_id'),
                    'call_time' => $this->input->post('call_time'),
                    'meeting_time' => $this->input->post('meeting_time') ? $this->input->post('meeting_time') : null,
                    'comment' => $this->input->post('comment'),
                    'user_id' => $this->session->userdata('user_id')
                );

                if ($this->input->post('source') == 'Bank360')
                    $new['lead_id'] = $this->input->post('lead_id');
                else
                    $new['lead_id'] = $this->randomPassword();

                $last_insert_id  = $this->leads_model->create($new);

                if($msg)
                {
                    redirect('leads/update/'.$last_insert_id, 'refresh');
                }
                else
                {
                    $this->session->set_flashdata('message', lang("leads_success"));
                    redirect('leads', 'refresh');
                }
            }
        }
    }

    public function update($id = NULL)
    {
        if (in_array('edit_leads', $this->session->permissions))
        {
            $this->set_rules();

            $id = isset($id) ? (int)$id : (int)$this->input->post('id');

            if ($this->form_validation->run() === FALSE)
            {
                if(strlen(validation_errors()) > 0){
                    $this->session->set_flashdata('message', lang("form_error"));
                }

                $item = $this->leads_model->get_by_id($id);
                if ($item)
                {
                    $item->area_code = substr($item->phone, 3, 2);
                    $item->phone_no = substr($item->phone, 5);
                    if ($item->source == null)
                        $item->source = 'Bank360';
                    $this->data['lead'] = $item;
                    $this->load->helper('dropdown');
                    if ($this->ion_auth->get_users_groups()->row()->name != 'partners')
                    {
                        $current_user = $this->ion_auth->user()->row();
                        $this->load->model('users_model');
                        $agents = $this->users_model->get_all_indexed_by_structure($current_user->structure_id);
                        $this->data['source_list'] = dropdown_data('agent', null, $agents);
                        $first = $this->data['source_list'][''];
                        unset($this->data['source_list']['']);
                        $this->data['source_list'] = array('' => $first, 'Bank360' => 'Bank360') + $this->data['source_list'];
                    }

                    $this->load->model('banks_model');
                    $this->data['bank_list'] = dropdown_data('building_society', $this->banks_model);
                    $this->data['update'] = true;
                    $this->render('leads/create_view');
                }
                else
                {
                    $this->session->set_flashdata('message', lang("lead_id_error"));
                    redirect('leads', 'refresh');
                }
            }
            else
            {
                $new = array(
                    'source' => $this->input->post('source') == 'Bank360' ? null : $this->input->post('source'),
                    'name' => $this->input->post('name'),
                    'postcode' => $this->input->post('postcode'),
                    'town' => $this->input->post('town'),
                    'street' => $this->input->post('street'),
                    'phone' => $this->input->post('phone'),
                    'email' => $this->input->post('email'),
                    'bank_id' => $this->input->post('bank_id'),
                    'call_time' => $this->input->post('call_time'),
                    'meeting_time' => $this->input->post('meeting_time') ? $this->input->post('meeting_time') : null,
                    'comment' => $this->input->post('comment')
                );
                if ($this->input->post('source') == 'Bank360')
                    $new['lead_id'] = $this->input->post('lead_id');


                //    $this->session->set_flashdata('message', 'Company updated successfuly');
                if (! $this->leads_model->update($id, $new))
                    $this->session->set_flashdata('message', lang("lead_error"));
                else
                {
                    $this->session->set_flashdata('message', 'Lead módosult');
                }

                redirect('leads/update/'.$id, 'refresh');
            }
        }
    }

    public function status($id = NULL)
    {
        if (in_array('edit_leads', $this->session->permissions))
        {
            $this->set_status_rules();

            $id = isset($id) ? (int)$id : (int)$this->input->post('id');

            if ($this->form_validation->run() === FALSE)
            {
                if(strlen(validation_errors()) > 0){
                    $this->session->set_flashdata('message', lang("form_error"));
                }

                $item = $this->leads_model->get_by_id($id);
                $item->statuses = $this->leads_model->get_statuses_by_lead_id($id);
                if ($item)
                {
                    $this->data['lead'] = $item;
                    $this->load->helper('dropdown');

                    $this->load->model('banks_model');
                    $this->data['bank_list'] = dropdown_data('building_society', $this->banks_model);
                    $this->data['status_list'] = dropdown_data('lead_status');
                    $this->data['update'] = true;
                    $this->render('leads/create_status_view');
                }
                else
                {
                    $this->session->set_flashdata('message', lang("lead_id_error"));
                    redirect('leads', 'refresh');
                }
            }
            else
            {
                $new = array(
                    'lead_id' => $this->input->post('lead_id'),
                    'status' => $this->input->post('status'),
                    'comment' => $this->input->post('comment'),
                    'reminder_time' => $this->input->post('reminder_time') ? $this->input->post('reminder_time') : null,
                    'user_id' => $this->session->userdata('user_id')
                );


                //    $this->session->set_flashdata('message', 'Company updated successfuly');
                if (! $this->leads_model->create_status($new))
                    $this->session->set_flashdata('message', lang("lead_error"));
                else
                {
                    $this->session->set_flashdata('message', 'Lead módosult');
                }

                redirect('leads/status/'.$this->input->post('lead_id'), 'refresh');
            }
        }
    }

    public function date_valid($date){
        if (! $date) return true;
        $year = (int) substr($date, 0, 4);
        $month = (int) substr($date, 5, 2);
        $day = (int) substr($date, 8, 2);
        return checkdate($month, $day, $year);
    }

    public function delete($id)
    {
        if (in_array('delete_leads', $this->session->permissions))
        {
            $this->session->set_flashdata('message', lang("record_delete_".($this->leads_model->delete($id) === FALSE ? 'error' : 'success')));
            redirect('leads', 'refresh');
        }
    }

    private function set_rules()
    {
        $this->form_validation->set_rules('source', '', 'required');
        $this->form_validation->set_rules('name', '', 'trim|required');
        $this->form_validation->set_rules('postcode', '', 'trim|required|exact_length[4]');
        $this->form_validation->set_rules('town', '', 'trim|required');
        $this->form_validation->set_rules('street', '', 'trim|required');
        $this->form_validation->set_rules('area_code', '', 'required');
        $this->form_validation->set_rules('phone_no', '', 'trim|required|exact_length[7]');
        $this->form_validation->set_rules('email', '', 'trim|required|valid_email');
        $this->form_validation->set_rules('bank_id', '', 'required');
        if ($this->input->post('source') == 'Bank360')
            $this->form_validation->set_rules('lead_id', '', 'trim|required');
    }
    private function set_status_rules()
    {
        $this->form_validation->set_rules('status', '', 'required');
    }

    private function randomPassword($len = 8) {
        $alphabet = "abcdefghijkmnprstuwxyzABCDEFGHJKLMNPQRSTUWXYZ123456789";
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < $len; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }

    private function send_email($to, $name, $lead)
    {
        $this->load->library('email');
        $this->email->from('agent@bank360.hu');
        $this->email->to($to);
        $this->email->cc('agent@bank360.hu');
        $this->email->subject('LTP Lead ' . $lead['name']);
        $this->email->message('Kedves '.$name.'!

A Bank360 rendszerében az alábbi Lead-et rendelték hozzád:
Név: '.$lead['name'].'
Város: '.$lead['town']. (strtolower($lead['town']) == 'budapest' ? ' ('.substr($lead['postcode'] ,1, 2).')' : '').' 
Utca, házszám: '.$lead['street'].'
Mobiltelefonszám: '.$lead['phone'].'
E-mail cím: '.$lead['email'].'
Termék: LTP
Pénzintézet: '.$lead['bank'].'
Komment: '.$lead['comment'].'
Rögzítés időpontja: '.$lead['created_time'].'
Lead ID: '.$lead['lead_id'].'
A Lead megnyitásához kattints az alábbi linkre:

'.base_url().'leads/status/'.$lead['id'].'

Üdvözlettel,
A Bank360 Csapata');
        $this->email->send();
    }

}
