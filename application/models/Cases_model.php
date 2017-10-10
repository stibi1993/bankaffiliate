<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class Cases_model extends CI_Model
{
    protected $_tableName = "cases_common";
    protected $_tableBeneficiary = "cases_beneficiary";
    protected $_tableClientData = "cases_client_data";

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
        $this->db->order_by('szerzodeskotes_datuma', 'desc');
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
    public function get_by_id($id = NULL)
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

    public function get_client_data_by_case_id($case_id = NULL)
    {
        if(isset($case_id))
        {
            if (! is_array($case_id))
                $case_id = [$case_id];
            $this->db->where_in('case_id', $case_id);
        }
        $query = $this->db->get($this->_tableClientData);

        if($query->num_rows()>0)
        {
            return $query->result();
        }
        return FALSE;
    }

    public function get_beneficiary_by_case_id($case_id = NULL)
    {
        if(isset($case_id))
        {
            if (! is_array($case_id))
                $case_id = [$case_id];
            $this->db->where_in('case_id', $case_id);
        }
        $query = $this->db->get($this->_tableBeneficiary);

        if($query->num_rows()>0)
        {
            return $query->result();
        }
        return FALSE;
    }

    /**
     * @param null $id
     * @return bool
     */
    public function get_by_id_all_child_table($id  = NULL)
    {
        if(isset($id))
        {
            $this->db->where('id',$id);
        }
        $query = $this->db->get($this->_tableName);
        $this->db->join($this->_tableBeneficiary,'cases_beneficiary.case_id = cases_common.id');

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
     * @param $data
     * @return mixed
     */
    public function create_beneficiary($data)
    {
        $this->db->insert($this->_tableBeneficiary,$data);
        return $this->db->insert_id();
    }

    /**
     * @param $data
     * @return mixed
     */
    public function create_client_data($data)
    {
        $this->db->insert($this->_tableClientData,$data);
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
     * @param $data
     * @return mixed
     */
    public function update_beneficiary($id, $data)
    {
        $this->db->where('case_id',$id);
        return $this->db->update($this->_tableBeneficiary,$data);
    }

    /**
     * @param $id
     * @param $data
     * @return mixed
     */
    public function update_client_data($id, $data)
    {
        $this->db->where('case_id', $id);
        return $this->db->update($this->_tableClientData, $data);
    }


    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->db->delete($this->_tableBeneficiary, array('id'=>$id));
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete_beneficiary($id)
    {
        return $this->db->delete($this->_tableName, array('case_id'=>$id));
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete_client_data($id)
    {
        return $this->db->delete($this->_tableClientData, array('case_id'=>$id));
    }

    public function get_by_user_ids($user_ids)
    {
        if (! $user_ids) return [];
        $all = false;
        if ($user_ids == 'all')
            $all = true;
        else
        {
            if (! is_array($user_ids))
                $user_ids = [$user_ids];
        }
        $this->db->select($this->_tableName.'.*, users.first_name, users.last_name, users.level')->join('users', 'users.id = ' . $this->_tableName . '.user_id');
        if (! $all)
            $this->db->where_in('user_id', $user_ids);
        $this->db->order_by('szerzodeskotes_datuma', 'desc');
        $query = $this->db->get($this->_tableName);
        if($query->num_rows()>0)
        {
            $cases = $query->result();
            $sum_contract_amount = 0;
            foreach($cases as $item)
            {
                $case_ids[] = $item->id;
                $sum_contract_amount += $item->ltp_szerzodes_osszege;
            }

            $client_data = $this->get_client_data_by_case_id($case_ids);
            foreach ($client_data as $item)
                $client_data_x[$item->case_id] = $item;

            foreach ($cases as $item)
            {
                $item->client_data = $client_data_x[$item->id];
//                $item->beneficiary = $beneficiary_x[$item->id];
            }
            return ['items' => $cases, 'sum_contract_amount' => $sum_contract_amount];
        }
        return [];
    }

    public function get_by_structure_id($structure_id)
    {
        if (! $structure_id) return [];
        $this->db->select($this->_tableName.'.*, users.first_name, users.last_name, users.level')->join('users', 'users.id = ' . $this->_tableName . '.user_id');
        $this->db->where('structure_id', $structure_id);
        $this->db->order_by('szerzodeskotes_datuma', 'desc');
        $query = $this->db->get($this->_tableName);
        if($query->num_rows()>0)
        {
            $cases = $query->result();
            $sum_contract_amount = 0;
            foreach($cases as $item)
            {
                $case_ids[] = $item->id;
                $sum_contract_amount += $item->ltp_szerzodes_osszege;
            }

            $client_data = $this->get_client_data_by_case_id($case_ids);
            foreach ($client_data as $item)
                $client_data_x[$item->case_id] = $item;

            foreach ($cases as $item)
            {
                $item->client_data = $client_data_x[$item->id];
//                $item->beneficiary = $beneficiary_x[$item->id];
            }
            return ['items' => $cases, 'sum_contract_amount' => $sum_contract_amount];
        }
        return [];
    }
}