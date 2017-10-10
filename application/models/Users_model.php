<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends CI_Model
{
    protected $_tableName = "users";

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
        $this->db->order_by('last_name, first_name');
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
    public function get_by_id($id  = NULL)
    {
        if(isset($id))
        {
            $this->db->where('id',$id);
        }
        $query = $this->db->get($this->_tableName);

        if($query->num_rows()>0)
        {
            return $query->result();
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
        $this->db->where('id',$id);
        return $this->db->update($this->_tableName,$data);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->db->delete($this->_tableName, array('id'=>$id));
    }

    public function get_usernames_like($username)
    {
        $this->db->select('username');
        $this->db->like('username', $username, 'after');
        $query = $this->db->get($this->_tableName);
        $return = [];
        foreach ($query->result() as $row)
            $return[] = $row->username;
        return $return;
    }

    public function get_all_children_id($user_id, $where = NULL)
    {
        $this->db->select('id, superior_id');
        if(isset($where))
        {
            $this->db->where($where);
        }
        $this->db->order_by('id');
        $query = $this->db->get($this->_tableName);
        if($query->num_rows()>0)
        {
            $parent_ids = [$user_id];
            $children_ids = [];
            foreach($query->result() as $item)
            {
                if (in_array($item->superior_id, $parent_ids))
                {
                    $parent_ids[] = $item->id;
                    $children_ids[] = $item->id;
                }
            }
            return $children_ids;
        }
        return [];
    }
    public function get_all_indexed_by_structure($structure_id = null)
    {
        $this->db->select('id, first_name, last_name, structure_id');
        $this->db->where('active', 1);
        if ($structure_id)
            $this->db->where('structure_id', $structure_id);
        $this->db->order_by('last_name, first_name');
        $query = $this->db->get($this->_tableName);
        $return = [];
        if($query->num_rows()>0)
        {
            if ($structure_id)
                $return = $query->result();
            else
            {
                foreach($query->result() as $item)
                {
                    $return[$item->structure_id][] = $item;
                }
            }
        }
        return $return;
    }
    public function get_all_superiors($user_id, $where = NULL)
    {
        $this->db->select('id, superior_id, first_name, last_name');
        if(isset($where))
        {
            $this->db->where($where);
        }
        $this->db->order_by('id');
        $query = $this->db->get($this->_tableName);
        if($query->num_rows()>0)
        {
            $parents = [];
            $user_parent = [];
            foreach($query->result() as $item)
            {
                $user_parent[$item->id] = $item;
            }
            while ($user_parent[$user_id]->superior_id != null)
            {
                $parents[] = $user_parent[$user_parent[$user_id]->superior_id];
                $user_id = $user_parent[$user_id]->superior_id;
            }
            $return['superior'] = $parents[0];
            $return['top_superior'] = end($parents);
            return $return;
        }
        return [];
    }

    function is_unique_field($id = '', $field, $value) {
        $this->db->where($field, $value);
        if($id) {
            $this->db->where_not_in('id', $id);
        }
        return ! (bool)$this->db->get($this->_tableName)->num_rows();
    }

}