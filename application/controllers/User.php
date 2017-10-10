<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('ion_auth');
    }

    public function index()
    {
    }

    public function login()
    {
        $this->data['page_title'] = 'Login';
        if ($this->input->post()) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('identity', 'Identity', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');
            $this->form_validation->set_rules('remember', 'Remember me', 'integer');
            if ($this->form_validation->run() === TRUE) {
                $remember = (bool)$this->input->post('remember');
                if ($this->ion_auth->login($this->input->post('identity'), $this->input->post('password'), $remember)) {
                	//[CL]Add the user groups to the session
                	$usergroups = $this->ion_auth->get_users_groups($this->session->user_id)->result();
                  //var_dump($usergroups);
                	$this->session->set_userdata('usergroups', $usergroups);
                    $this->session->usergroups = $usergroups;

                    $permissions = $this->getPermissions($usergroups[0]->id);
                    //var_dump($permissions);
                	//[CL]Add the user permissions to the session
                	$this->session->set_userdata('permissions', $permissions);
                    $this->session->permissions = $permissions;

                	//[CL]Add the user company id to the session
                	$user = $this->ion_auth->user()->row();
                    $this->session->userdata["company_id"] = $user->company;
                    $this->session->userdata["company_logo"] = $this->getcompanyLogo($user->company);
                    $this->session->userdata["user_picture"] = $user->user_picture;
                    $this->session->userdata['structure_id'] = $user->structure_id;
                    //[CL]set default language from user database
                    /*if(!isset($this->session->language)) */{ $_SESSION['language'] = $user->default_lang; }

                    //[CL]Add the custom labels to the session
                    $this->load->model('label_model');
                    $this->session->set_userdata("custom_labels", $this->label_model->get_all_custom("company_id = ".$user->company." AND lang = '". $user->default_lang ."' "));

                    //$_SESSION['language'] = $this->default_lang;
                    if ($this->session->userdata['usergroups'][0]->name == 'L3'
                       // || $this->session->userdata['usergroups'][0]->name == 'L2'
                       // || $this->session->userdata['usergroups'][0]->name == 'L1'
                    ) {
                        redirect('listing', 'refresh');
                    } else {
                        redirect('dashboard', 'refresh');
                    }
                } else {
                    $this->session->set_flashdata('message', $this->ion_auth->errors());
                    redirect('/user/login', 'refresh');
                }
            }
        }
        $this->load->helper('form');
        $this->render('login_view', 'admin_master');
    }

    public function logout()
    {
        $this->ion_auth->logout();
        redirect('user/login', 'refresh');
    }


    public function _randomPassword() {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 6; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }

    public function forgot()
    {
        $this->data['page_title'] = 'Forgot password';

        if ($this->input->post()) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('identity', 'Identity', 'trim|valid_email|required');
            if ($this->form_validation->run() === TRUE) {
                //  $this->session->set_flashdata('message', $this->ion_auth->errors());

                $query = $this->db->select('id, username, email, password')
                    ->where('email', $this->input->post('identity'))
                    ->limit(1)
                    ->order_by('id', 'desc')
                    ->get('users');
                $data = $query->row();

                if ($_SERVER['HTTP_HOST'] == 'rhexpat.patrik.com') {
                    $new_password = 'admin';
                } else {
                    $new_password = $this->_randomPassword();
                }

                $user_id = $data->id;
                $old_password = $data->password;
                $new_data = array(
                    'password' => $new_password
                );
                $this->ion_auth->update($user_id, $new_data);

                $query = $this->db->select('password')
                    ->where('id', $user_id)
                    ->limit(1)
                    ->order_by('id', 'desc')
                    ->get('users');
                $data = $query->row();

                $this->load->library('email');


                /*$config['protocol']    = 'smtp';
                //$config['smtp_host']    = 'ssl://smtp.gmail.com';
                $config['smtp_host']    = 'auth.smtp.1and1.fr';
                $config['smtp_port']    = '465';
                $config['smtp_timeout'] = '7';
                //$config['smtp_user']    = 'mygmail@gmail.com';
                $config['smtp_user']    = 'support@e-apps.fr';
                $config['smtp_pass']    = 'Support2011%';
                $config['charset']    = 'utf-8';
                $config['newline']    = "\r\n";
                $config['mailtype'] = 'text'; // or html
                $config['validation'] = TRUE; // bool whether to validate email or not
                $this->email->initialize($config);*/

                $this->email->from($this->input->post('identity'));
                $this->email->from('support@e-apps.fr');
                $this->email->to($this->input->post('identity'));
                $this->email->subject('Forgot password');
                $this->email->message('New password: ' . $new_password);
                $this->email->send();

                $this->session->set_flashdata('message', "You're new password has been sent.");
                redirect('user/login');
            }
        }


        $this->load->helper('form');
        $this->render('forgot_view', 'admin_master');

    }

    public function profile()
    {
        $this->load->model('language_model');
        $this->load->model('companies_model');
        $this->load->helper('dropdown');
        $this->data['page_title'] = 'User Profile';
        $user = $this->ion_auth->user()->row();
        $this->data['user'] = $user;
        $this->data['current_user_menu'] = '';
        if ($this->ion_auth->in_group('admin')) {
            $this->data['current_user_menu'] = $this->load->view('templates/_parts/user_menu_admin_view.php', NULL, TRUE);
        }

        $this->load->library('form_validation');
        $this->form_validation->set_rules('first_name', 'First name', 'trim|required');
        $this->form_validation->set_rules('last_name', 'Last name', 'trim|required');
//        $this->form_validation->set_rules('company', 'Company', 'trim');
//        $this->form_validation->set_rules('phone', 'Phone', 'trim');

        if (strlen($this->input->post('password')) > 0 || strlen($this->input->post('password_confirm')) > 0 ) {
            $this->form_validation->set_rules('password', 'Password', 'required');
            $this->form_validation->set_rules('password_confirm', 'Password confirmation', 'required|matches[password]');
        }

        $this->data['companies_list'] = dropdown_data('companies', $this->companies_model);

        if ($this->form_validation->run() === FALSE) {

//            $this->data['lang_list'] = dropdown_data('language', $this->language_model);

            $this->render('user/profile_view', 'admin_master');


        } else {

  /*          $picture = $_FILES["userPicture"]["name"];
            $msg = "";

            if(!empty($picture)){

                $config['upload_path'] = './uploads/user/';
                $config['allowed_types'] = 'jpg|gif|png|';
                $config['max_size'] = 1024 * 2;
                $config['encrypt_name'] = TRUE;
                $this->load->library('upload', $config);

                if (!$this->upload->do_upload("userPicture"))
                {
                    $status = 'error';
                    $msg .= $this->upload->display_errors();

                    //todo [CL] image upload errors flash massege
                    $this->session->set_flashdata('message', $msg);

                    $user_pic_real = null;
                }
                else
                {
                    $data = $this->upload->data();
                        $user_pic_real = $data["file_name"];
                   // }
                }

            }else{
                $user_pic_real = "";
            }
*/
            $new_data = array(
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
 /*               'company' => $this->input->post('company'),
                'phone' => $this->input->post('phone'),
                'default_lang' => $this->input->post('default_lang')
*/            );
 /*           if(!empty($user_pic_real)) {
                $new_data['user_picture'] = $user_pic_real;
                $this->session->userdata["user_picture"] = $user_pic_real;
            }
*/
            if (strlen($this->input->post('password')) > 0 && $this->input->post('password') == $this->input->post('password_confirm')) {
                $new_data['password'] = $this->input->post('password');
            }
            $this->ion_auth->update($user->id, $new_data);

            if (!$msg) {
                $this->session->set_flashdata('message', $this->ion_auth->messages());
            }

            redirect('user/profile', 'refresh');
        }
    }

    public function getPermissions($usergroup_id = null)
    {
		$this->load->model('permissions_model');
		$permissions = $this->permissions_model->get_by_group_id($usergroup_id);
		$session_permissions = array();
		foreach ($permissions as $permission){
			$session_permissions[]=$permission->name;
		}
		return $session_permissions;
    }


    public function getcompanyLogo($id){

        if($id) {
            $this->load->model('companies_model');

            $data = $this->companies_model->get_by_id($id);

            if(isset($data->company_logo)){
                return $data->company_logo;
            }else{
                return FALSE;
            }

        }else{
            return FALSE;
        }
    }

	public function get_companies_list()
    {

        $this->load->model('companies_model');

        $companiesList = $this->companies_model->get_all();

        $companiesDdown = array();
        foreach ($companiesList as $company) {
            $companiesDdown[$company->id] = $company->company_name;
        }

        return $companiesDdown;
    }
}
