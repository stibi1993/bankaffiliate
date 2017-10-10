<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Users_sales_codes_model extends CI_Model
{
    protected $_tableName = "users_sales_codes";

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param null $where
     * @return bool
     */
    public function get_all($where = NULL)
    {
        $this->db->select($this->_tableName.'.*, banks.title as bank');
        $this->db->join('banks', $this->_tableName.'.bank_id = banks.id');
        if(isset($where))
        {
            $this->db->where($where);
        }
        $query = $this->db->get($this->_tableName);
        if($query->num_rows()>0)
        {
            return $query->result();
        }
        return [];
    }


    /**
     * @param null $id
     * @return bool
     */
    public function get_by_id($id)
    {
        if(isset($id))
        {
            $this->db->where('id',$id);
        }
        $query = $this->db->get($this->_tableName);

        if($query->num_rows()>0)
        {
            return $query->row();
        }
        return FALSE;
    }

    /**
     * @param $data
     * @return mixed
     */
    public function create($data)
    {
    	$this->db->insert($this->_tableName,$data);
        return $this->db->insert_id();
    }

    /**
     * @param $id
     * @param $data
     * @return mixed
     */
    public function update($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update($this->_tableName, $data);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->db->delete($this->_tableName, array('id'=>$id));
    }

}