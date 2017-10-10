<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Public_Controller
{

    /**
     *
     */
    function __construct()
    {
        parent::__construct();
        $this->data['page_title'] = 'Dashboard - '.$this->config->item("cms_title");
    }

    /**
     * @param null $year
     * @param null $month
     */
    public function index($year = NULL, $month = NULL)
    {

        $this->load->library('calendar',$pref);
        $data=array('year'=>$this->uri->segment(3), 'month'=>$this->uri->segment(4), );


        $this->load->view('show_calendar',$data);
        $this->render('dashboard_view');
    }

}