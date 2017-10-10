<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Label_model extends CI_Model
{
    protected $_tableName = "labels";
    protected $_customLabel = "labels_custom";

    public function __construct()
    {
        parent::__construct();
    }

    public function get_all_by_page($page){

        $this->db->where("page", $page);

        //$this->db->join($this->_tableName, 'labels.id = labels_custom.label_id');

        $query = $this->db->get($this->_tableName);

        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return FALSE;
    }

    public function get_all_custom($where = NULL){

        //var_dump($where);

        if (isset($where)) {
            $this->db->where($where);
        }

        $this->db->join($this->_tableName, 'labels.id = labels_custom.label_id');

        $query = $this->db->get($this->_customLabel);

        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return FALSE;
    }



    public function insert($data){
        foreach($data as $d){
            //var_dump($d);
            $this->db->insert($this->_customLabel,$d);
        }
    }

    public function delete($company_id, $lang){
        return $this->db->delete($this->_customLabel, array('company_id' => $company_id, "lang" => $lang));
    }

}