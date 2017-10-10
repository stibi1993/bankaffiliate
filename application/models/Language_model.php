<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Language_model
 */
class Language_model extends CI_Model
{

    /**
     *
     */
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
        if(isset($where))
        {
            $this->db->where($where);
        }
        $this->db->order_by('language_name','ASC');
        $query = $this->db->get('languages');
        if($query->num_rows()>0)
        {
            return $query->result();
        }
        return [];
    }

    /**
     * @param $id
     * @return bool
     */
    public function get_by_id($id)
    {
        if(isset($id))
        {
            $this->db->where('id',$id);
        }
        $query = $this->db->get('languages');

        if($query->num_rows()>0)
        {
            return $query->result();
        }
        return FALSE;
    }

    /**
     * @param $slug
     * @return bool
     */
    public function get_by_slug($slug)
    {
        if(isset($slug))
        {
            $this->db->where('slug', $slug);
        }
        $query = $this->db->get('languages');

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
        if($data['default']=='1')
        {
            $this->db->where('default', '1');
            $this->db->update('languages', array('default'=>'0'));
        }
        return $this->db->insert('languages',$data);
    }

    /**
     * @param $language_id
     * @param $data
     * @return mixed
     */
    public function update($language_id, $data)
    {
        if($data['default']=='1')
        {
            $this->db->where('default', '1');
            $this->db->update('languages', array('default'=>'0'));
        }
        $this->db->where('id',$language_id);
        return $this->db->update('languages',$data);
    }

    /**
     * @param $language_id
     * @return mixed
     */
    public function delete($language_id)
    {
        return $this->db->delete('languages', array('id'=>$language_id));
    }

}