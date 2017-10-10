<?php defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
    protected $data = array();
    protected $langs = array();
    protected $default_lang;
    protected $current_lang;

    function __construct()
    {

        parent::__construct();

        // First of all let's see what languages we have and also get the default language

        $this->load->model('language_model');
        $available_languages = $this->language_model->get_all();
        if (isset($available_languages)) {
            foreach ($available_languages as $lang) {
                $this->langs[$lang->slug] = array('id' => $lang->id, 'slug' => $lang->slug, 'language_directory' => $lang->language_directory, 'language_code' => $lang->language_code, 'default' => $lang->default);
                if ($lang->default == '1') $this->default_lang = $lang->slug;
            }
        }

        // Verify if we have a language set in the URL;
        $lang_slug = $this->uri->segment(1);
        // If we do, and we have that languages in our set of languages we store the language slug in the session
        if (isset($lang_slug) && array_key_exists($lang_slug, $this->langs)) {
            $this->current_lang = $lang_slug;
            $_SESSION['set_language'] = $lang_slug;
            $_SESSION['language'] = $lang_slug;

        } // If not, we set the language session to the default language
        else {
            $this->current_lang = $this->default_lang;
            //$_SESSION['set_language'] = $this->default_lang;


            //if(!isset($this->session->language)) { $_SESSION['language'] = $this->default_lang; }
        }
        //var_dump($this->session);
        // Now we store the languages as a $data key, just in case we need them in our views
        $this->data['langs'] = $this->langs;
        // Also let's have our current language in a $data key
        $this->data['current_lang'] = $this->langs[$this->current_lang];

        // For links inside our views we only need the lang slug. If the current language is the default language we don't need to append the language slug to our links
        if ($this->current_lang != $this->default_lang) {
            $this->data['lang_slug'] = $this->current_lang . '/';
        } else {
            $this->data['lang_slug'] = '';
        }

        $slug = $this->session->language;
        if (!isset($slug)) {
            $slug = "en";
        }

        $languageData = $this->language_model->get_by_slug($slug);
        $languageDirectory = $languageData->language_directory;
        $this->lang->load($slug, $languageDirectory);

        $this->config->set_item('language', $languageData->language_directory);

        $this->data['language'] = "en";
        $this->data['page_title'] = $this->config->item("cms_title");
        $this->data['page_description'] = 'Bank360 Ügynök';
        $this->data['before_head'] = '';
        $this->data['before_body'] = '';
        $this->data['actual_page'] = "dashboard";
    }

    protected function render($the_view = NULL, $template = 'master')
    {
        if ($template == 'json' || $this->input->is_ajax_request()) {
            header('Content-Type: application/json');
            echo json_encode($this->data);
        } elseif (is_null($template)) {
            $this->load->view($the_view, $this->data);
        } else {
            $this->data['the_view_content'] = (is_null($the_view)) ? '' : $this->load->view($the_view, $this->data, TRUE);
            $this->load->view('templates/' . $template . '_view', $this->data);
        }
    }
}


class Public_Controller extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('ion_auth');
        if (!$this->ion_auth->logged_in()) {
            //redirect them to the login page
            redirect('user/login', 'refresh');
        }
        $this->data['current_user'] = $this->ion_auth->user()->row();
        $this->data['current_user_menu'] = '';
        if ($this->ion_auth->in_group('admin')) {
            $this->data['current_user_menu'] = $this->load->view('templates/_parts/user_menu_admin_view.php', NULL, TRUE);
        }
        $this->data['page_title'] = $this->config->item("cms_title");

        $slug = $this->session->language;
        if (!isset($slug)) {
            $slug = "en";
        }
        $this->data['language'] = $slug;

    }

    protected function render($the_view = NULL, $template = 'admin_master')
    {
        parent::render($the_view, $template);
    }

    protected function convetDateFromUKToHUN($param)
    {
        if ($param) {
            $phpdate = strtotime($param);
            $date = date('Y-m-d', $phpdate);
        } else
            $date = $param;
        return $date;
    }

    protected function get_mission_header_data($employee_id)
    {
        // echo '<div style="z-index: 100000; background-color: yellow; position: fixed; bottom: 0px; right: 0px; color: black;">get_mission_header_data</div>';

        $this->load->model('countries_model');
        $this->load->model('mission_companies_model');
        $this->load->model('lister_model');
        $this->load->model('mission_model');

        //**Employee header info
        /*$this->load->model('employee_model');
        $emp_id = $this->uri->segment(3) ? $this->uri->segment(3) : $emp_id;
        $employee_header_data = $this->employee_model->get_missions_by_id_for_employee_header($emp_id);
        if(!empty($employee_header_data) && $employee_header_data->employee_id != $emp_id){
            $employee_header_data = $this->employee_model->get_name_by_id($emp_id);
        }*/
        //**Eddig
        //** Missions oldalak Header Információinak lekérése

        /*
        $mission_id = $this->uri->segment(4);
        if (!isset($mission_id)) {
            $mission_id = false;
        }
        */

        $data = array();
        $last_mission = $this->mission_model->get_last_mission("employee_id = " . $employee_id);
        $data[] = $last_mission;
        return $data;
        /*
        $data = $this->lister_model->get_all_header('missions.id = ' . $mission_id);

        if (!empty($data["result"])) {
            foreach ($data["result"] as $res) {
                $countriesLables = $this->countries_model->get_by_id($res->home_country);
                $hostCountriesLables = $this->countries_model->get_by_id($res->host_country);
                $hostCitiesLables = $this->cities_model->get_by_id($res->host_city);
                $homeCompany = $this->mission_companies_model->get_name_by_id($res->home_company);
                $hostCompany = $this->mission_companies_model->get_name_by_id($res->host_company);

                if (isset($homeCompany->company_name)) {
                    $res->home_company_label = $homeCompany->company_name;
                }
                if (isset($hostCompany->company_name)) {
                    $res->host_company_label = $hostCompany->company_name;
                }


                if (!empty($countriesLables)) {
                    foreach ($countriesLables as $country) {
                        if ($country->slug == $this->session->language) {
                            if ($country->label) {
                                $res->home_country_label = $country->label;
                            }
                        }
                    }
                }
                if (!empty($hostCountriesLables)) {
                    foreach ($hostCountriesLables as $country) {
                        if ($country->slug == $this->session->language) {
                            $res->host_country_label = $country->label;
                        }
                    }
                }

                if (!empty($hostCitiesLables)) {
                    foreach ($hostCitiesLables as $city) {
                        if ($city->slug == $this->session->language) {
                            $res->host_city_label = $city->label;
                        }
                    }
                }
            }
        }
        */
        return $data["result"];
    }
}