<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends Public_Controller
{

    /**
     *
     */
    function __construct()
    {
        parent::__construct();
        if (! in_array('view_users', $this->session->permissions)){
            $this->session->set_flashdata('message', 'You are not allowed to visit the Users page');
            redirect('', 'refresh');
        }
        $this->data['actual_page'] = "users";
    }

    /**
     * @param null $group_id
     */
    public function index($group_id = NULL)
    {
        $this->data['page_title'] = 'Partnerek';
        if (in_array('view_all_users', $this->session->permissions))
            $users = $this->get_users_data($this->ion_auth->users()->result());

        elseif (in_array('view_structure_users', $this->session->permissions))
        {
            $users = $this->get_users_data($this->ion_auth->where('structure_id', $this->session->userdata('structure_id'))->users()->result());
        }

#print_r($users);
        $this->load->helper('dropdown');
        $this->load->model('structures_model');
        $structures = dropdown_data('structure', $this->structures_model);
        unset($structures['']);


        foreach ($users as $user) {

            $user->group = $this->ion_auth->get_users_groups($user->id)->result();
            $user->structure = $structures[$user->structure_id];
        }
        $this->data['users'] = $users;
        $this->render('users/list_users_view');
    }

    /**
     *
     */
    public function create()
    {

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $_SESSION['upload_user'] = null;
        }

        if (in_array('edit_users', $this->session->permissions))
        {
            $this->data['page_title'] = 'Partner felvitel';
            $this->load->library('form_validation');
            $new_company = trim($this->input->post('new_company'));
            if ($this->input->post('temp_submit'))
            {
                $this->form_validation->set_rules('first_name', 'First name', 'trim|required');
                $this->form_validation->set_rules('last_name', 'Last name', 'trim|required');
            }
            else
            {
                $this->form_validation->set_rules('groups[]', 'Groups', 'required|integer');
                if ($new_company)
                {
                    $this->form_validation->set_rules('company_name', '', 'trim|required');
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
                    $this->form_validation->set_rules('phone', '', 'required');
                    $this->form_validation->set_rules('company_email', '', 'trim|valid_email|required');
                }
                else
                    $this->form_validation->set_rules('company', 'Company', 'required|integer');
                $this->form_validation->set_rules('first_name', 'First name', 'trim|required');
                $this->form_validation->set_rules('last_name', 'Last name', 'trim|required');
                $this->form_validation->set_rules('status', '', 'required');
                $this->form_validation->set_rules('legal_relation', '', 'required');
                $this->form_validation->set_rules('last_name', 'Last name', 'trim|required');
                $this->form_validation->set_rules('birth_place', '', 'trim|required');
                $this->form_validation->set_rules('birth_date', '', 'trim|required|callback_date_valid');
                $this->form_validation->set_rules('mothers_name', '', 'trim|required');
                $this->form_validation->set_rules('id_card_no', '', 'trim|required|regex_match_id_card[/^\d{6}[A-Z]{2}$/]');
                $this->form_validation->set_rules('address_card_no', '', 'trim|required|regex_match_address_card[/^\d{6}[A-Z]{2}$/]');
//                $this->form_validation->set_rules('company_reg_no', '', 'trim|required|regex_match[/^(\d{2}-\d{2}-\d{6}|[A-Z]{2}-\d{6})$/]');
                $this->form_validation->set_rules('tax_id', '', 'trim|required|regex_match_tax_id[/^8\d{9}$/]');
                $this->form_validation->set_rules('education', '', 'trim|required');
                $this->form_validation->set_rules('education_date', '', 'trim|required|callback_date_valid');
                if ($this->input->post('education') == 'M')
                    $this->form_validation->set_rules('mnb_no', '', 'trim|required');
                $this->form_validation->set_rules('password', 'Password', 'required');
                $this->form_validation->set_rules('password_confirm', 'Password confirmation', 'required|matches[password]');
                $this->form_validation->set_rules('structure_id', '', 'integer|required');
                $this->form_validation->set_rules('product_categories[]', '', 'required');
                $this->form_validation->set_rules('level', '', 'integer|required');
                if ($this->input->post('level') < 6)
                    $this->form_validation->set_rules('superior_id', '', 'integer|required');
                $this->form_validation->set_rules('iranyitoszam', '', 'trim|integer_ir_szam|required|exact_length[4]');
                $this->form_validation->set_rules('varos', '', 'trim|required');
                $this->form_validation->set_rules('utca_hazszam', '', 'trim|required');
                if (! $this->input->post('levelezesi_cim_is'))
                {
                    $this->form_validation->set_rules('levelezes_iranyitoszam', '', 'trim|integer|required|exact_length[4]');
                    $this->form_validation->set_rules('levelezes_varos', '', 'trim|required');
                    $this->form_validation->set_rules('levelezes_utca_hazszam', '', 'trim|required');
                }
                $this->form_validation->set_rules('area_code', '', 'required');
                $this->form_validation->set_rules('phone_no', '', 'trim|required|exact_length[7]|integer');
                $this->form_validation->set_rules('email_privat', '', 'trim|valid_email|required');
            }
            $msg = "";

            if ($this->ion_auth->in_group('admin')) {
                $this->data['group_permissions'] = $this->getPermissionsByUserGroupId();
            }

            $this->load->helper('dropdown');
            if ($this->form_validation->run() === FALSE)
            {
                if (strlen(validation_errors()) > 0) {
                    $this->session->set_flashdata('message', $msg . lang("form_error"));
                }

                //** Eldönti hogy az admin listát irassa ki vagy a hiányosat
                if ($this->ion_auth->in_group('admin')) {
                    $groups = $this->ion_auth->order_by('name', 'asc')->groups()->result();
                } else {
                    $groups = $this->getPermissionsByUserGroupId();
                }

                $this->data['groups'] = $groups;

                $this->load->model('companies_model');
                $this->data['companies_list'] = dropdown_data('companies', $this->companies_model);

                $this->load->model('structures_model');
                $this->data['structures_list'] = dropdown_data('structure', $this->structures_model);

                $this->data['product_categories'] = dropdown_data('product_category');
                array_shift($this->data['product_categories']);
                $this->data['current_product_categories'] = [];

                $this->load->model('banks_model');
                $this->data['bank_list'] = dropdown_data('bank', $this->banks_model);

                $this->load->helper('form');
                $this->data['document_types'] = dropdown_data('users_document_type');

                $this->render('users/create_user_view');
            }
            else
            {
                $this->load->helper('text');
                $username = str_replace(' ', '.', strtolower(convert_accented_characters($this->input->post('last_name') . ' ' . $this->input->post('first_name'))));
                $username = $this->get_non_duplicated_username($username);
                $email = $username;
                $password = $this->input->post('password');
                $group_ids = ($this->input->post('groups')[0] === '' ? [] : $this->input->post('groups'));
                if ($new_company)
                    $company_id = $this->insert_company();

                $additional_data = array(
                    'first_name' => $this->input->post('first_name'),
                    'last_name' => $this->input->post('last_name'),
                    'company' => $new_company ? $company_id : (int)$this->input->post('company'),
                    'default_lang' => ($this->input->post('default_lang') ? $this->input->post('default_lang') : 'hu'),
                    'phone' => $this->input->post('phone'),
                    'level' => (int)$this->input->post('level'),
                    'status' => $this->input->post('status'),
                    'legal_relation' => $this->input->post('legal_relation'),
                    'birth_place' => $this->input->post('birth_place'),
                    'birth_date' => $this->input->post('birth_date'),
                    'mothers_name' => $this->input->post('mothers_name'),
                    'id_card_no' => $this->input->post('id_card_no'),
                    'address_card_no' => $this->input->post('address_card_no'),
                    'company_reg_no' => $this->input->post('company_reg_no'),
                    'tax_no' => $this->input->post('tax_id'),
                    'education' => $this->input->post('education'),
                    'education_date' => ($this->input->post('education_date') ? $this->input->post('education_date') : null),
                    'mnb_no' => $this->input->post('mnb_no'),
                    'comment' => $this->input->post('comment'),
                    'product_categories' => ($this->input->post('product_categories[]') ? implode(',', $this->input->post('product_categories[]')) : ''),
                    'structure_id' => (int)$this->input->post('structure_id'),
                    'superior_id' => (int)$this->input->post('superior_id')
                );
                if ($this->input->post('perm_submit'))
                    $additional_data['active'] = 1;

                $last_insert_id = $this->ion_auth->register($username, $password, $email, $additional_data, $group_ids);
                $other_info = array(
                    'user_id' => $last_insert_id,
                    'iranyitoszam' => ($this->input->post('iranyitoszam') ? $this->input->post('iranyitoszam') : null),
                    'varos' => $this->input->post('varos'),
                    'utca_hazszam' => $this->input->post('utca_hazszam'),
                    'mobiltelefonszam' => $this->input->post('mobiltelefonszam'),
                    'email_privat' => $this->input->post('email_privat'),
                    'levelezesi_cim_is' => $this->input->post('levelezesi_cim_is')
                );
                if (! $this->input->post('levelezesi_cim_is'))
                {
                    $other_info['levelezes_iranyitoszam'] = ($this->input->post('levelezes_iranyitoszam') ? $this->input->post('levelezes_iranyitoszam') : null);
                    $other_info['levelezes_varos'] = $this->input->post('levelezes_varos');
                    $other_info['levelezes_utca_hazszam'] = $this->input->post('levelezes_utca_hazszam');
                }
                $this->load->model('users_contact_info_model');
                $this->users_contact_info_model->create($other_info);

                $document_types = dropdown_data('users_document_type');
                unset($document_types['']);

                foreach ($document_types as $key => $item)
                    $this->create_file_from_params('file_'.$key, 'file_title_'.$key, $key, 'user', $last_insert_id);

                if ($this->input->post('perm_submit'))
                    $this->send_email($other_info['email_privat'], $additional_data['last_name']. ' ' . $additional_data['first_name'], $username);

                if ($msg) {
                    redirect('users/edit/' . $last_insert_id, 'refresh');
                } else {
                    $this->session->set_flashdata('message', $msg . $this->ion_auth->messages());
                    redirect('users', 'refresh');
                }


                /* $this->session->set_flashdata('message', $this->ion_auth->messages());
                 redirect('users', 'refresh');
                 */
            }
        }
    }

    private function send_email($to, $name, $username, $changes = null)
    {
        $this->load->library('email');
        $this->email->from('agent@bank360.hu');
        $this->email->to($to);
        $this->email->cc('agent@bank360.hu');
        $this->email->subject('Bank 360 LTP Partner ' . ($changes ? 'adatainak módosítása' : 'rögzítése sikeres'));
        if ($changes)
        {
            $this->email->message('Kedves '.$name.'!
A Bank360 rendszerében a profilodon az Adminisztrátor által az alábbi mezők módosításra kerültek:

'.implode(', ', $changes).'

Amennyiben a módosításokkal nem értesz egyet, azt jelezd az admin@bank360.hu-n.

Üdvözlettel,
A Bank360 Csapata');

        }
        else
            $this->email->message('Kedves '.$name.'!

A Partner profil létrehozása a Bank360 rendszerébe sikeresen megtörtént. A belépéshez használható felhasználóneved: '.$username.'
A profil létrehozásának véglegesítéséhez kattints az alábbi linkre, ahol meg kell adnod a belépéshez használt jelszavadat.

http://sas.bank360.hu

Üdvözlettel,
A Bank360 Csapata');
        $this->email->send();
    }

    public function date_valid($date){
        if (! $date) return true;
        $year = (int) substr($date, 0, 4);
        $month = (int) substr($date, 5, 2);
        $day = (int) substr($date, 8, 2);
        return checkdate($month, $day, $year);
    }
    /**
     * @param null $user_id
     */
    public function edit($user_id = NULL)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $_SESSION['upload_user'] = null;
        }

        if (in_array('view_users', $this->session->permissions))
        {
            $user_id = $this->input->post('user_id') ? $this->input->post('user_id') : $user_id;
            $user = $this->ion_auth->user((int)$user_id)->row();

            $this->data['page_title'] = 'Partner módosítás';
            $this->load->library('form_validation');
            $new_company = trim($this->input->post('new_company'));
            if ($this->input->post('temp_submit'))
            {
                $this->form_validation->set_rules('user_id', 'User ID', 'integer|required');
            }
            else
            {
                $this->form_validation->set_rules('groups[]', 'Groups', 'required|integer');
                if ($new_company)
                {
                    $this->form_validation->set_rules('company_name', '', 'trim|required');
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
                    $this->form_validation->set_rules('phone', '', 'required');
                    $this->form_validation->set_rules('company_email', '', 'trim|valid_email|required');
                }
                else
                    $this->form_validation->set_rules('company', 'Company', 'required|integer');
                $this->form_validation->set_rules('first_name', 'First name', 'trim|required');
                $this->form_validation->set_rules('last_name', 'Last name', 'trim|required');
                $this->form_validation->set_rules('status', '', 'required');
                $this->form_validation->set_rules('legal_relation', '', 'required');
                $this->form_validation->set_rules('last_name', 'Last name', 'trim|required');
                $this->form_validation->set_rules('birth_place', '', 'trim|required');
                $this->form_validation->set_rules('birth_date', '', 'trim|required|callback_date_valid');
                $this->form_validation->set_rules('mothers_name', '', 'trim|required');
                $this->form_validation->set_rules('id_card_no', '', 'trim|required|regex_match[/^\d{6}[A-Z]{2}$/]');
                $this->form_validation->set_rules('address_card_no', '', 'trim|required|regex_match[/^\d{6}[A-Z]{2}$/]');
//                $this->form_validation->set_rules('company_reg_no', '', 'trim|required|regex_match[/^(\d{2}-\d{2}-\d{6}|[A-Z]{2}-\d{6})$/]');
                $this->form_validation->set_rules('tax_id', '', 'trim|required|regex_match[/^8\d{9}$/]');
                $this->form_validation->set_rules('education', '', 'trim|required');
                $this->form_validation->set_rules('education_date', '', 'trim|required|callback_date_valid');
                if ($this->input->post('education') == 'M')
                    $this->form_validation->set_rules('mnb_no', '', 'trim|required');
                $this->form_validation->set_rules('mothers_name', '', 'trim|required');
    //            $this->form_validation->set_rules('default_lang', 'Default lang', 'trim');
//                $this->form_validation->set_rules('username', 'Username', 'trim|required');
    //            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

                if (strlen($this->input->post('password')) > 0 || strlen($this->input->post('password_confirm')) > 0) {
                    $this->form_validation->set_rules('password', 'Password', 'required');
                    $this->form_validation->set_rules('password_confirm', 'Password confirmation', 'required|matches[password]');
                }

                $this->form_validation->set_rules('structure_id', '', 'integer|required');
                $this->form_validation->set_rules('product_categories[]', '', 'required');
                $this->form_validation->set_rules('level', '', 'integer|required');
                if ($this->input->post('level') < 6)
                    $this->form_validation->set_rules('superior_id', '', 'integer|required');
                $this->form_validation->set_rules('iranyitoszam', '', 'trim|integer|required|exact_length[4]');
                $this->form_validation->set_rules('varos', '', 'trim|required');
                $this->form_validation->set_rules('utca_hazszam', '', 'trim|required');
                if (! $this->input->post('levelezesi_cim_is'))
                {
                    $this->form_validation->set_rules('levelezes_iranyitoszam', '', 'trim|integer|required|exact_length[4]');
                    $this->form_validation->set_rules('levelezes_varos', '', 'trim|required');
                    $this->form_validation->set_rules('levelezes_utca_hazszam', '', 'trim|required');
                }
                $this->form_validation->set_rules('area_code', '', 'required');
                $this->form_validation->set_rules('phone_no', '', 'trim|required|exact_length[7]|integer');
                $this->form_validation->set_rules('email_privat', '', 'trim|valid_email|required');
                if ($user->active && $this->input->post('bank_id'))
                {
                    $this->form_validation->set_rules('kapcsolattarto_fiok_neve', '', 'trim');
                    $this->form_validation->set_rules('kapcsolattarto_fiok_kodja', '', 'trim');
                    $this->form_validation->set_rules('kapcsolattarto_fiok_cime', '', 'trim');
                    $this->form_validation->set_rules('datum', '', 'trim|required|callback_date_valid');
                    $this->form_validation->set_rules('azonosito', '', 'trim|required');
                    $this->form_validation->set_rules('sales_code_product_categories[]', '', 'required');
                }
                $this->form_validation->set_rules('user_id', 'User ID', 'integer|required');
    //            $this->form_validation->set_rules('userPicture', 'User Picture', 'trim');
                if ($this->ion_auth->is_admin())
                {
                    $this->form_validation->set_rules('username', '', 'trim|required|callback_is_unique_username[users.username]');
                    $this->form_validation->set_rules('email', '', 'trim|valid_email|required|callback_is_unique_email[users.email]');
                }
            }

            $this->load->helper('dropdown');
            if ($this->form_validation->run() === FALSE)
            {
                if (strlen(validation_errors()) > 0) {
                    $this->session->set_flashdata('message', lang("form_error"));
                }

                if ($user)
                {

                    $this->load->model('users_contact_info_model');
                    $contact_info = $this->users_contact_info_model->get_by_id($user_id);
                    if ($contact_info->id)
                    {
                        $contact_info->users_contact_info_id = $contact_info->id;
                        unset($contact_info->id, $contact_info->user_id);
                    }
                    $user = (object) array_merge((array) $user, (array) $contact_info);
                    if ($user->mobiltelefonszam)
                    {
                        $user->area_code = substr($user->mobiltelefonszam, 3, 2);
                        $user->phone_no = substr($user->mobiltelefonszam, 5);
                    }

                    $this->load->model('users_sales_codes_model');
                    $user->sales_codes = $this->users_sales_codes_model->get_all('user_id = '.$user_id);
//                    print_r($user);

                    $this->load->model('files_model');
                    $documents = $this->files_model->get_by_foreign_key('user_id', $user_id);
                    if ($documents)
                        foreach ($documents as $doc)
                            $user->documents[$doc->document_type][] = $doc;

                    if ($user->company)
                    {
                        $this->load->model('companies_model');
                        $this->data['company'] = $this->companies_model->get_by_id($user->company);
                    }


                    $this->data['user'] = $user;

//                    $this->load->model('language_model');
//                    $this->data['lang_list'] = dropdown_data('language', $this->language_model);

                    $this->load->model('companies_model');
                    $this->data['companies_list'] = dropdown_data('companies', $this->companies_model);

                    $this->load->model('structures_model');
                    $this->data['structures_list'] = dropdown_data('structure', $this->structures_model);

                    $this->data['product_categories'] = dropdown_data('product_category');
                    array_shift($this->data['product_categories']);
                    $this->data['current_product_categories'] = explode(',', $user->product_categories);

                    $this->load->model('users_model');
                    $this->data['superiors_list'] = dropdown_data('superior', $this->users_model, $user);

                    $this->load->model('banks_model');
                    $this->data['bank_list'] = dropdown_data('bank', $this->banks_model);

                    $this->data['document_types'] = dropdown_data('users_document_type');
                }
                else
                {
                    $this->session->set_flashdata('message', lang('record_id_error'));
                    redirect('users', 'refresh');
                }

                //** Eldönti hogy az admin listát irassa ki vagy a hiányosat
                if ($this->ion_auth->in_group('admin')) {
                    $groups = $this->ion_auth->order_by('name', 'asc')->groups()->result();
                } else {
                    $groups = $this->getPermissionsByUserGroupId();
                }
                $this->data['groups'] = $groups;

                $usergroups = $this->ion_auth->get_users_groups($user->id)->result();
                $usergroups = $usergroups[0];
                $this->data['usergroups'] = $usergroups->id;

                $this->load->helper('form');
                $this->data['update'] = true;
                $this->render('users/create_user_view');
            }
            elseif (in_array('edit_users', $this->session->permissions))
            {
                $user_id = $this->input->post('user_id');
                if ($new_company)
                    $company_id = $this->insert_company();
                $new_data = array(
//                    'username' => $this->input->post('username'),
//                    'email' => $this->input->post('email'),
                    'first_name' => $this->input->post('first_name'),
                    'last_name' => $this->input->post('last_name'),
                    'company' => $new_company ? $company_id : (int)$this->input->post('company'),
//                    'default_lang' => $this->input->post('default_lang'),
                    'phone' => $this->input->post('phone'),
                    'level' => (int)$this->input->post('level'),
                    'status' => $this->input->post('status'),
                    'legal_relation' => $this->input->post('legal_relation'),
                    'birth_place' => $this->input->post('birth_place'),
                    'birth_date' => $this->input->post('birth_date'),
                    'mothers_name' => $this->input->post('mothers_name'),
                    'id_card_no' => $this->input->post('id_card_no'),
                    'address_card_no' => $this->input->post('address_card_no'),
                    'company_reg_no' => $this->input->post('company_reg_no'),
                    'tax_no' => $this->input->post('tax_id'),
                    'education' => $this->input->post('education'),
                    'education_date' => ($this->input->post('education_date') ? $this->input->post('education_date') : null),
                    'mnb_no' => $this->input->post('mnb_no'),
                    'comment' => $this->input->post('comment'),
                    'product_categories' => ($this->input->post('product_categories[]') ? implode(',', $this->input->post('product_categories[]')) : ''),
                    'structure_id' => (int)$this->input->post('structure_id'),
                    'superior_id' => (int)$this->input->post('superior_id')
                );
                if ($this->ion_auth->is_admin())
                {
                    $new_data['username'] = $this->input->post('username');
                    $new_data['email'] = $this->input->post('email');
                }
                if ($this->input->post('perm_submit'))
                    $new_data['active'] = 1;

                if (strlen($this->input->post('password')) > 0 && $this->input->post('password') == $this->input->post('password_confirm')) {
                    $new_data['password'] = $this->input->post('password');
                }

                if ($this->input->post('submit'))
                {
/*
 * TODO
 */
                    $changes = ['field'];
                }

                if (! $this->ion_auth->update($user_id, $new_data))
                {
                    $this->session->set_flashdata('message', lang("user_error"));
                }
                else
                {
                    $other_info = array(
                        'iranyitoszam' => ($this->input->post('iranyitoszam') ? $this->input->post('iranyitoszam') : null),
                        'varos' => $this->input->post('varos'),
                        'utca_hazszam' => $this->input->post('utca_hazszam'),
                        'mobiltelefonszam' => $this->input->post('mobiltelefonszam'),
                        'email_privat' => $this->input->post('email_privat'),
                        'levelezesi_cim_is' => $this->input->post('levelezesi_cim_is')
                    );
                    if (! $this->input->post('levelezesi_cim_is'))
                    {
                        $other_info['levelezes_iranyitoszam'] = ($this->input->post('levelezes_iranyitoszam') ? $this->input->post('levelezes_iranyitoszam') : null);
                        $other_info['levelezes_varos'] = $this->input->post('levelezes_varos');
                        $other_info['levelezes_utca_hazszam'] = $this->input->post('levelezes_utca_hazszam');
                    }
                    $this->load->model('users_contact_info_model');

                    $this->users_contact_info_model->update($user_id, $other_info);

                    $document_types = dropdown_data('users_document_type');
                    unset($document_types['']);

                    foreach ($document_types as $key => $item)
                        $this->create_file_from_params('file_'.$key, 'file_title_'.$key, $key, 'user', $user_id);

                    if ($user->active && $this->input->post('bank_id'))
                    {
                        $sales_code = array(
                            'user_id' => $user_id,
                            'bank_id' => $this->input->post('bank_id'),
                            'kapcsolattarto_fiok_neve' => ($this->input->post('kapcsolattarto_fiok_neve') ? $this->input->post('kapcsolattarto_fiok_neve') : null),
                            'kapcsolattarto_fiok_kodja' => ($this->input->post('kapcsolattarto_fiok_kodja') ? $this->input->post('kapcsolattarto_fiok_kodja') : null),
                            'kapcsolattarto_fiok_cime' => ($this->input->post('kapcsolattarto_fiok_cime') ? $this->input->post('kapcsolattarto_fiok_cime') : null),
                            'datum' => $this->input->post('datum'),
                            'azonosito' => $this->input->post('azonosito'),
                            'product_categories' => implode(',', $this->input->post('sales_code_product_categories[]'))
                        );
                        $this->load->model('users_sales_codes_model');
                        $this->users_sales_codes_model->create($sales_code);
                    }

                    $this->session->set_flashdata('message', $this->ion_auth->messages());
                    //$this->session->set_flashdata('message', lang("user_update"));
                }

                //Update the groups user belongs to
                $groups = $this->input->post('groups');
                if (isset($groups) && !empty($groups)) {
                    $this->ion_auth->remove_from_group('', $user_id);
                    foreach ($groups as $group) {
                        $this->ion_auth->add_to_group($group, $user_id);
                    }
                }
                if ($this->input->post('perm_submit'))
                    $this->send_email($other_info['email_privat'], $new_data['last_name']. ' ' . $new_data['first_name'], $user->username);
                elseif ($changes)
                    $this->send_email($other_info['email_privat'], $new_data['last_name']. ' ' . $new_data['first_name'], $user->username, $changes);

                redirect('users/edit/' . $user_id, 'refresh');
//                redirect('users', 'refresh');

            }
        }
    }

    public function update($user_id = null)
    {
        $this->edit($user_id);
    }

    /**
     * @param null $user_id
     */
    public function delete($user_id = NULL)
    {
        if (in_array('delete_users', $this->session->permissions)) {
            if (is_null($user_id)) {
                $this->session->set_flashdata('message', lang('record_delete_error'));
            } else {
                $this->ion_auth->delete_user($user_id);
                $this->session->set_flashdata('message', $this->ion_auth->messages());
            }
            redirect('users', 'refresh');
        }
    }

    public function getPermissionsByUserGroupId()
    {
        $this->load->model('permissions_model');
        $permissions = $this->permissions_model->get_all_group_and_permission();

        return $permissions;
    }

    /**
     * @param $data
     * @return mixed
     */
    public function get_users_data($data)
    {

        $this->load->model('companies_model');

        foreach ($data as $u) {
            $thisCompany = $this->companies_model->get_name_by_id($u->company);
            if (isset($thisCompany->company_name))
                $u->company_name = $thisCompany->company_name;
        }

        return $data;
    }

    public function get_possible_superiors()
    {
        $this->load->model('users_model');
        $this->load->helper('dropdown');
        $data = $_POST['data'];
        $result = dropdown_data('superior', $this->users_model, (object)['structure_id'=>$data['structureId'], 'level'=>$data['level'], 'id'=>$data['ownId']]);
        if ($result)
            foreach ($result as $id => $item)
                $this->data['superiors'][] = array('id'=>$id, 'value'=> $item);
        $this->render('users/superior_options', 'json');
    }

    private function get_non_duplicated_username($username)
    {
        $this->load->model('users_model');
        $usernames = $this->users_model->get_usernames_like($username);
        $counter = '';
        while (in_array($username . $counter . '@bank360.hu', $usernames))
        {
            if ($counter == '') $counter = 2;
            else $counter++;
        }
        return $username . $counter . '@bank360.hu';
    }

    public function is_unique_email($email)
    {
        $this->load->model('users_model');
        return $this->users_model->is_unique_field($this->input->post('user_id'), 'email', $email);
    }

    public function is_unique_username($username)
    {
        $this->load->model('users_model');
        return $this->users_model->is_unique_field($this->input->post('user_id'), 'username', $username);
    }
    public function insert_company()
    {
        $company = array(
            'company_name' => $this->input->post('company_name'),
//                    'company_description' => $this->input->post('company_description'),
            'default_language' => ($this->input->post('default_language') ? $this->input->post('default_language') : 'hu'),
            'tax_no' => $this->input->post('tax_no'),
            'fundation_date' => $this->input->post('fundation_date'),
            'reg_office_postcode' => $this->input->post('reg_office_postcode'),
            'reg_office_town' => $this->input->post('reg_office_town'),
            'reg_office_street' => $this->input->post('reg_office_street'),
            'representative_name' => $this->input->post('representative_name'),
            'representative_birth_date' => ($this->input->post('representative_birth_date') ? $this->input->post('representative_birth_date') : null),
            'representative_id_card_no' => $this->input->post('representative_id_card_no'),
            'representative_address' => $this->input->post('representative_address'),
            'teaor' => $this->input->post('teaor'),
            'bank_account_no' => $this->input->post('bank_account_no'),
            'reg_no' => $this->input->post('reg_no'),
            'phone' => $this->input->post('phone'),
            'email' => $this->input->post('company_email')
        );
        $this->load->model('companies_model');
        return $this->companies_model->create($company);

    }

    public function create_file_from_params($file_input, $title_input, $type, $path_piece, $foreign_key)
    {
        if (! in_array('edit_files', $this->session->permissions))
            return false;
        $file = $_FILES[$file_input]["name"];
        if (empty($file))
            return false;
        else
        {
            $config['upload_path'] = './uploads/'.$path_piece.'/';
            $config['allowed_types'] = 'jpg|gif|png|pdf';
            //    $config['max_size'] = 1024 * 2;
            $config['encrypt_name'] = TRUE;

            $this->load->library('upload', $config);

            //var_dump($this->upload->do_upload("userPicture"));
            if (! $this->upload->do_upload($file_input))
            {
                return false;

            } else {
                $data = $this->upload->data();
                $filename = $data["file_name"];
                $new = array(
                    'filename' => $filename,
                    'title' => ($this->input->post($title_input) ? $this->input->post($title_input) : null),
                    'document_type'=> $type,
                    $path_piece.'_id' => $foreign_key
                );

                $this->load->model('files_model');
                $this->files_model->create($new);
            }
        }
    }

}
