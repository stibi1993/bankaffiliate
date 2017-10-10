<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Cases extends Public_Controller
{
    function __construct()
    {
        parent::__construct();
        //if (!$this->ion_auth->in_group('admin')) {
        if (! in_array('view_cases', $this->session->permissions)){
            $this->session->set_flashdata('message', lang("cases_allowed"));
            redirect('', 'refresh');
        }

        $this->load->library('form_validation');
        $this->load->model('cases_model');
        $this->data['actual_page'] = "cases";
    }

    public function index()
    {
        $this->load->model('banks_model');
        $this->load->model('users_model');
        $this->load->helper('dropdown');
        $this->load->helper('string');
        $this->data['bank_list'] = dropdown_data('bank', $this->banks_model);
        $this->data['befizetes_allapota'] = dropdown_data('befizetes_allapota');

        $this->data['befizetes_modja'] = dropdown_data('befizetes_modja');

        if (in_array('view_all_cases', $this->session->permissions))
        {
            $cases = $this->cases_model->get_by_user_ids('all');
            $users = $this->users_model->get_all();
            foreach ($users as $item)
                $user_ids[] = $item->id;
        }
        elseif (in_array('view_structure_cases', $this->session->permissions))
        {
            $cases = $this->cases_model->get_by_structure_id($this->session->userdata('structure_id'));
            $users = $this->users_model->get_all();
            foreach ($users as $item)
                $user_ids[] = $item->id;

        }
        else
        {
            $logged_user_id = $this->session->userdata('user_id');
            $user_ids = $this->users_model->get_all_children_id($logged_user_id);
            $user_ids[] = $logged_user_id;
            $cases = $this->cases_model->get_by_user_ids($user_ids);
        }
        $this->data['cases'] = $cases['items'];
        $this->data['sum_contract_amount'] = $cases['sum_contract_amount'];

        foreach ($user_ids as $item)
            $this->data['superiors'][$item] = $this->users_model->get_all_superiors($item);

        unset($this->data['befizetes_modja']['']);
        $this->render('cases/list_cases_view');
    }

    public function create()
    {
        if (in_array('edit_cases', $this->session->permissions))
        {
            $this->set_rules();

            $msg = "";

            if ($this->form_validation->run() === FALSE)
            {
                if(strlen(validation_errors()) > 0){
                    $this->session->set_flashdata('message', lang("form_error"));
                }

                if ($_GET['lead_id'])
                {
                    $this->load->model('leads_model');
                    $lead = $this->leads_model->get_by_id($_GET['lead_id']);
                    $case = new stdClass();
                    $case->client_data = new stdClass();
                    $case->client_data->nev = $lead->name;
                    $case->client_data->iranyitoszam = $lead->postcode;
                    $case->client_data->varos = $lead->town;
                    $case->client_data->utca_hazszam = $lead->street;
                    $case->client_data->area_code = substr($lead->phone, 3, 2);
                    $case->client_data->phone_no = substr($lead->phone, 5);
                    $case->client_data->email = $lead->email;
                    $case->product_category = $lead->product_category;
                    $case->bank_id = $lead->bank_id;
                    $case->lead_id = $lead->id;
                    $this->data['case'] = $case;
                }

                $this->load->model('banks_model');
                $this->load->helper('dropdown');
                $this->data['partner_updater'] = false;
                $this->data['bank_list'] = dropdown_data('building_society', $this->banks_model);
                $this->data['document_types'] = dropdown_data('cases_document_type');
                $this->render('cases/create_case_view');
            }
            else
            {
                $new_case = array(
                    'user_id' => $this->session->userdata('user_id'),
                    'bank_id' => $this->input->post('bank_id'),
                    'lead_id' => $this->input->post('lead_id'),
//                    'penztar' => $this->input->post('penztar'),
                    'product_category' => 'HS',
                    'szerzodes_szam' => $this->input->post('szerzodes_szam'),
                    'szerzodeses_osszeg_emeles' => (int)$this->input->post('szerzodeses_osszeg_emeles'),
                    'szerzodeskotes_datuma' => $this->input->post('szerzodeskotes_datuma'),
                    'varhato_indulas_datuma' => $this->input->post('varhato_indulas_datuma'),
                    'befizetes_allapota' => $this->input->post('befizetes_allapota'),
                    'termekcsalad' => $this->input->post('termekcsalad'),
                    'futamido_ev' => $this->input->post('futamido_ev'),
                    'futamido_ho' => $this->input->post('futamido_ho'),
                    'befizetes_modja' => $this->input->post('befizetes_modja'),
                    'szamlanyitasi_dij' => $this->input->post('szamlanyitasi_dij'),
                    'havi_befizetes' => $this->input->post('havi_befizetes'),
                    'szamlavezetesi_dij' => $this->input->post('szamlavezetesi_dij'),
                    'ltp_szerzodes_osszege' => $this->input->post('ltp_szerzodes_osszege'),
                    'megjegyzes' => $this->input->post('megjegyzes')
                );
                $new_case_client_data = array(
                    'ugyfel_forras' => $this->input->post('ugyfel_forras'),
                    'ugyfel_tipusa' => $this->input->post('ugyfel_tipusa'),
                    'nev' => $this->input->post('nev'),
                    'ceg_kepviselojenek_neve' => ($this->input->post('ugyfel_tipusa') == 'LT' ? $this->input->post('ceg_kepviselojenek_neve') : null),
                    'szuletesi_nev' => $this->input->post('szuletesi_nev'),
                    'anyja_szuletesi_neve' => $this->input->post('anyja_szuletesi_neve'),
                    'szuletesi_hely' => $this->input->post('szuletesi_hely'),
                    'szuletesi_ido' => $this->input->post('szuletesi_ido'),
                    'adoszam' => $this->input->post('adoszam'),
                    'azonosito_okmany_tipusa' => $this->input->post('azonosito_okmany_tipusa'),
                    'azonosito_okmany_szama' => $this->input->post('azonosito_okmany_szama'),
                    'lakcimkartya_szama' => $this->input->post('lakcimkartya_szama'),
                    'allampolgarsag' => $this->input->post('allampolgarsag'),
                    'iranyitoszam' => $this->input->post('iranyitoszam'),
                    'varos' => $this->input->post('varos'),
                    'utca_hazszam' => $this->input->post('utca_hazszam'),
                    'levelezesi_cim' => $this->input->post('levelezesi_cim'),
                    'telefonszam' => $this->input->post('telefonszam'),
                    'email' => $this->input->post('email'),
                    'epulet_cime' => ($this->input->post('ugyfel_tipusa') == 'LT' ? $this->input->post('epulet_cime') : null),
                    'lakasok_szama' => ($this->input->post('ugyfel_tipusa') == 'LT' ? $this->input->post('lakasok_szama') : null)
                );
                if ($this->input->post('van_kedvezmenyezett'))
                {
                    $new_case_beneficiary = array(
                        'van_kedvezmenyezett' => 1,
                        'nev' => $this->input->post('beneficiary_nev'),
                        'szuletesi_nev' => $this->input->post('beneficiary_szuletesi_nev'),
                        'anyja_szuletesi_neve' => $this->input->post('beneficiary_anyja_szuletesi_neve'),
                        'szuletesi_hely' => $this->input->post('beneficiary_szuletesi_hely'),
                        'szuletesi_ido' => $this->input->post('beneficiary_szuletesi_ido'),
                        'adoazonosito_jel' => $this->input->post('beneficiary_adoazonosito_jel'),
                        'allampolgarsag' => $this->input->post('beneficiary_allampolgarsag'),
                        'iranyitoszam' => $this->input->post('beneficiary_iranyitoszam'),
                        'varos' => $this->input->post('beneficiary_varos'),
                        'utca_hazszam' => $this->input->post('beneficiary_utca_hazszam'),
                        'levelezesi_cim' => $this->input->post('beneficiary_levelezesi_cim'),
                        'telefonszam' => $this->input->post('beneficiary_telefonszam'),
                    );
                }
                else
                    $new_case_beneficiary['van_kedvezmenyezett'] = 0;

                $last_insert_id  = $this->cases_model->create($new_case);
                $new_case_client_data['case_id'] = $last_insert_id;
                $new_case_beneficiary['case_id'] = $last_insert_id;
                $this->cases_model->create_client_data($new_case_client_data);
                $this->cases_model->create_beneficiary($new_case_beneficiary);

                $this->load->helper('dropdown');
                $document_types = dropdown_data('cases_document_type');
                unset($document_types['']);

                foreach ($document_types as $key => $item)
                {
                    $this->create_file_from_params('file_'.$key, 'file_title_'.$key, $key, 'case', $last_insert_id);
                    if ($key == 'KA') // Közvetítői adatlap
                        $this->cases_model->update($last_insert_id, array('ugyfelelegedettsegi_lap_beerkezese' => date('Y-m-d H:i:s')));
                }

                if($msg)
                {
                    redirect('cases/update/'.$last_insert_id, 'refresh');
                }
                else
                    {
                    $this->session->set_flashdata('message', lang("cases_success"));
                    redirect('cases', 'refresh');
                }
            }
        }
    }

    public function update($id = NULL)
    {
        if (in_array('edit_cases', $this->session->permissions))
        {
            $this->set_rules();

            $id = isset($id) ? (int)$id : (int)$this->input->post('id');


            if ($this->form_validation->run() === FALSE) {

                if(strlen(validation_errors()) > 0){
                    $this->session->set_flashdata('message', lang("form_error"));
                }

                $item = $this->cases_model->get_by_id($id);
                if ($item)
                {
                    $item->client_data = $this->cases_model->get_client_data_by_case_id($id)[0];

                    $item->client_data->area_code = substr($item->client_data->telefonszam, 3, 2);
                    $item->client_data->phone_no = substr($item->client_data->telefonszam, 5);

                    $item->beneficiary = $this->cases_model->get_beneficiary_by_case_id($id)[0];

                    if ($item->beneficiary->telefonszam)
                    {
                        $item->beneficiary->area_code = substr($item->beneficiary->telefonszam, 3, 2);
                        $item->beneficiary->phone_no = substr($item->beneficiary->telefonszam, 5);
                    }

                    $this->load->model('files_model');
                    $documents = $this->files_model->get_by_foreign_key('case_id', $id);
                    if ($documents)
                        foreach ($documents as $doc)
                            $item->documents[$doc->document_type][] = $doc;

                    $this->data['case'] = $item;
                    $this->load->model('banks_model');
                    $this->load->helper('dropdown');
                    $this->data['partner_updater'] = $this->ion_auth->get_users_groups()->row()->name == 'partners';
                    $this->data['bank_list'] = dropdown_data('building_society', $this->banks_model);
                    $this->data['document_types'] = dropdown_data('cases_document_type');
                    if ($this->data['partner_updater'])
                        foreach ($this->data['bank_list'] as $key => $val)
                            if ($key != $item->bank_id)
                                unset($this->data['bank_list'][$key]);

                    $this->data['update'] = true;
                    $this->render('cases/create_case_view');
                }
                else
                {
                    $this->session->set_flashdata('message', lang("case_id_error"));
                    redirect('cases', 'refresh');
                }
            }
            else
            {
                $new_data = array(
                    'bank_id' => $this->input->post('bank_id'),
                    'szerzodes_szam' => $this->input->post('szerzodes_szam'),
                    'szerzodeses_osszeg_emeles' => (int)$this->input->post('szerzodeses_osszeg_emeles'),
                    'szerzodeskotes_datuma' => $this->input->post('szerzodeskotes_datuma'),
                    'varhato_indulas_datuma' => $this->input->post('varhato_indulas_datuma'),
                    'befizetes_allapota' => $this->input->post('befizetes_allapota'),
                    'termekcsalad' => $this->input->post('termekcsalad'),
                    'futamido_ev' => $this->input->post('futamido_ev'),
                    'futamido_ho' => $this->input->post('futamido_ho'),
                    'befizetes_modja' => $this->input->post('befizetes_modja'),
                    'szamlanyitasi_dij' => $this->input->post('szamlanyitasi_dij'),
                    'havi_befizetes' => $this->input->post('havi_befizetes'),
                    'szamlavezetesi_dij' => $this->input->post('szamlavezetesi_dij'),
                    'ltp_szerzodes_osszege' => $this->input->post('ltp_szerzodes_osszege'),
                    'megjegyzes' => $this->input->post('megjegyzes')
                );
                $new_case_client_data = array(
                    'ugyfel_forras' => $this->input->post('ugyfel_forras'),
                    'ugyfel_tipusa' => $this->input->post('ugyfel_tipusa'),
                    'nev' => $this->input->post('nev'),
                    'ceg_kepviselojenek_neve' => ($this->input->post('ugyfel_tipusa') == 'LT' ? $this->input->post('ceg_kepviselojenek_neve') : null),
                    'szuletesi_nev' => $this->input->post('szuletesi_nev'),
                    'anyja_szuletesi_neve' => $this->input->post('anyja_szuletesi_neve'),
                    'szuletesi_hely' => $this->input->post('szuletesi_hely'),
                    'szuletesi_ido' => $this->input->post('szuletesi_ido'),
                    'adoszam' => $this->input->post('adoszam'),
                    'azonosito_okmany_tipusa' => $this->input->post('azonosito_okmany_tipusa'),
                    'azonosito_okmany_szama' => $this->input->post('azonosito_okmany_szama'),
                    'lakcimkartya_szama' => $this->input->post('lakcimkartya_szama'),
                    'allampolgarsag' => $this->input->post('allampolgarsag'),
                    'iranyitoszam' => $this->input->post('iranyitoszam'),
                    'varos' => $this->input->post('varos'),
                    'utca_hazszam' => $this->input->post('utca_hazszam'),
                    'levelezesi_cim' => $this->input->post('levelezesi_cim'),
                    'telefonszam' => $this->input->post('telefonszam'),
                    'email' => $this->input->post('email'),
                    'epulet_cime' => ($this->input->post('ugyfel_tipusa') == 'LT' ? $this->input->post('epulet_cime') : null),
                    'lakasok_szama' => ($this->input->post('ugyfel_tipusa') == 'LT' ? $this->input->post('lakasok_szama') : null)
                );
                if ($this->input->post('van_kedvezmenyezett'))
                {
                    $new_case_beneficiary = array(
                        'van_kedvezmenyezett' => 1,
                        'nev' => $this->input->post('beneficiary_nev'),
                        'szuletesi_nev' => $this->input->post('beneficiary_szuletesi_nev'),
                        'anyja_szuletesi_neve' => $this->input->post('beneficiary_anyja_szuletesi_neve'),
                        'szuletesi_hely' => $this->input->post('beneficiary_szuletesi_hely'),
                        'szuletesi_ido' => $this->input->post('beneficiary_szuletesi_ido'),
                        'adoazonosito_jel' => $this->input->post('beneficiary_adoazonosito_jel'),
                        'allampolgarsag' => $this->input->post('beneficiary_allampolgarsag'),
                        'iranyitoszam' => $this->input->post('beneficiary_iranyitoszam'),
                        'varos' => $this->input->post('beneficiary_varos'),
                        'utca_hazszam' => $this->input->post('beneficiary_utca_hazszam'),
                        'levelezesi_cim' => $this->input->post('beneficiary_levelezesi_cim'),
                        'telefonszam' => $this->input->post('beneficiary_telefonszam')
                    );
                }
                else
                    $new_case_beneficiary = array(
                        'van_kedvezmenyezett' => 0,
                        'szuletesi_nev' => null,
                        'anyja_szuletesi_neve' => null,
                        'szuletesi_hely' => null,
                        'szuletesi_ido' => null,
                        'adoazonosito_jel' => null,
                        'allampolgarsag' => null,
                        'iranyitoszam' => null,
                        'varos' => null,
                        'utca_hazszam' => null,
                        'levelezesi_cim' => null,
                        'telefonszam' => null
                    );

                //    $this->session->set_flashdata('message', 'Company updated successfuly');
                if (! $this->cases_model->update($id, $new_data))
                    $this->session->set_flashdata('message', lang("case_error"));
                else
                {
                    $this->cases_model->update_client_data($id, $new_case_client_data);
                    $this->cases_model->update_beneficiary($id, $new_case_beneficiary);
                    $this->session->set_flashdata('message', 'Ügylet módosult');

                    $this->load->helper('dropdown');
                    $document_types = dropdown_data('cases_document_type');
                    unset($document_types['']);

                    foreach ($document_types as $key => $item)
                    {
                        $this->create_file_from_params('file_'.$key, 'file_title_'.$key, $key, 'case', $id);
                        if ($key == 'KA') // Közvetítői adatlap
                            $this->cases_model->update($id, array('ugyfelelegedettsegi_lap_beerkezese' => date('Y-m-d H:i:s')));
                    }
                }

                redirect('cases/update/'.$id, 'refresh');
            }
        }
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

    public function date_valid($date){
        if (! $date) return true;
        $year = (int) substr($date, 0, 4);
        $month = (int) substr($date, 5, 2);
        $day = (int) substr($date, 8, 2);
        return checkdate($month, $day, $year);
    }

    public function delete($id)
    {
        if (in_array('delete_cases', $this->session->permissions))
        {
            $this->session->set_flashdata('message', lang("record_delete_".($this->cases_model->delete($id) === FALSE ? 'error' : 'success')));
            redirect('cases', 'refresh');
        }
    }

    private function set_rules()
    {
        $this->form_validation->set_rules('bank_id', '', 'required');
        $this->form_validation->set_rules('szerzodes_szam', '', 'trim|required|regex_match[/^\d{8}$/]');
        $this->form_validation->set_rules('szerzodeskotes_datuma', '', 'trim|required|callback_date_valid');
        $this->form_validation->set_rules('varhato_indulas_datuma', '', 'trim|required|callback_date_valid');
        $this->form_validation->set_rules('befizetes_allapota', '', 'required');
        $this->form_validation->set_rules('termekcsalad', '', 'required');
        $this->form_validation->set_rules('futamido_ev', '', 'required');
        $this->form_validation->set_rules('befizetes_modja', '', 'required');
        $this->form_validation->set_rules('szamlanyitasi_dij', '', 'required');
        $this->form_validation->set_rules('havi_befizetes', '', 'trim|required');
        $this->form_validation->set_rules('szamlavezetesi_dij', '', 'trim|required');
        $this->form_validation->set_rules('ltp_szerzodes_osszege', '', 'required');
        $this->form_validation->set_rules('ugyfel_forras', '', 'required');
        $this->form_validation->set_rules('ugyfel_tipusa', '', 'required');
        $this->form_validation->set_rules('nev', '', 'trim|required');
        if ($this->input->post('ugyfel_tipusa') == 'LT')
        {
            $this->form_validation->set_rules('ceg_kepviselojenek_neve', '', 'trim|required');
        }
        $this->form_validation->set_rules('szuletesi_nev', '', 'trim|required');
        $this->form_validation->set_rules('anyja_szuletesi_neve', '', 'trim|required');
        $this->form_validation->set_rules('szuletesi_hely', '', 'trim|required');
        $this->form_validation->set_rules('szuletesi_ido', '', 'trim|required|callback_date_valid');
        $this->form_validation->set_rules('adoszam', '', 'trim|required|regex_match[/^8\d{9}$/]');
        $this->form_validation->set_rules('azonosito_okmany_tipusa', '', 'required');
        switch ($this->input->post('azonosito_okmany_tipusa'))
        {
            case 'SI':
                $this->form_validation->set_rules('azonosito_okmany_szama', '', 'trim|required|regex_match[/^\d{6}[A-Z]{2}$/]');
                break;
            case 'VE':
                $this->form_validation->set_rules('azonosito_okmany_szama', '', 'trim|required|regex_match[/^[A-Z]{2}\d{6}$/]');
                break;
            case 'UT':
                $this->form_validation->set_rules('azonosito_okmany_szama', '', 'trim|required|regex_match[/^[A-Z]{2}\d{7}$/]');
                break;
            default:
                $this->form_validation->set_rules('azonosito_okmany_szama', '', 'trim|required');
        }
        $this->form_validation->set_rules('lakcimkartya_szama', '', 'trim');
        $this->form_validation->set_rules('allampolgarsag', '', 'trim|required');
        $this->form_validation->set_rules('iranyitoszam', '', 'trim|required|exact_length[4]');
        $this->form_validation->set_rules('varos', '', 'trim|required');
        $this->form_validation->set_rules('utca_hazszam', '', 'trim|required');
        $this->form_validation->set_rules('levelezesi_cim', '', 'trim|required');
        $this->form_validation->set_rules('area_code', '', 'required');
        if (in_array($this->input->post('area_code'), array('20', '30', '31', '70', '1')))
            $this->form_validation->set_rules('phone_no', '', 'trim|required|integer|exact_length[7]');
        else
            $this->form_validation->set_rules('phone_no', '', 'trim|required|integer|exact_length[6]');
        $this->form_validation->set_rules('email', '', 'trim|required|valid_email');
        if ($this->input->post('ugyfel_tipusa') == 'LT')
        {

            $this->form_validation->set_rules('epulet_cime', '', 'trim|required');
            $this->form_validation->set_rules('lakasok_szama', '', 'trim|required|integer');
        }
        if ($this->input->post('van_kedvezmenyezett'))
        {
            $this->form_validation->set_rules('beneficiary_nev', '', 'trim|required');
            $this->form_validation->set_rules('beneficiary_szuletesi_nev', '', 'trim|required');
            $this->form_validation->set_rules('beneficiary_anyja_szuletesi_neve', '', 'trim|required');
            $this->form_validation->set_rules('beneficiary_szuletesi_hely', '', 'trim|required');
            $this->form_validation->set_rules('beneficiary_szuletesi_ido', '', 'trim|required|callback_date_valid');
            $this->form_validation->set_rules('beneficiary_adoazonosito_jel', '', 'trim|required|regex_match[/^8\d{9}$/]');
            $this->form_validation->set_rules('beneficiary_allampolgarsag', '', 'trim|required');
            $this->form_validation->set_rules('beneficiary_iranyitoszam', '', 'trim|required|exact_length[4]');
            $this->form_validation->set_rules('beneficiary_varos', '', 'trim|required');
            $this->form_validation->set_rules('beneficiary_utca_hazszam', '', 'trim|required');
            $this->form_validation->set_rules('beneficiary_levelezesi_cim', '', 'trim');
            if ($this->input->post('beneficiary_area_code'))
            {
                if (in_array($this->input->post('beneficiary_area_code'), array('20', '30', '31', '70', '1')))
                    $this->form_validation->set_rules('beneficiary_phone_no', '', 'trim|required|integer|exact_length[7]');
                else
                    $this->form_validation->set_rules('beneficiary_phone_no', '', 'trim|required|integer|exact_length[6]');
            }
        }
    }
}
