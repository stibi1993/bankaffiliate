
<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class Leads_model extends CI_Model
{
    protected $_tableName = "leads";
    protected $_statusTableName = "lead_statuses";

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
        $this->db->order_by('created_time', 'desc');
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
        $this->db->select($this->_tableName.".*");
        $this->db->select("first_name, last_name");
        $this->db->select("(select count(*) from cases_common where lead_id = ".$this->_tableName.".id) as case_count");
        $this->db->select("(select title from banks where bank_id = banks.id) as bank");
        $this->db->join('users',  'agent_id = users.id', 'left');
        if(isset($id))
        {
            $this->db->where($this->_tableName.'.id',$id);
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
    	$this->db->insert($this->_tableName, $data);
        return $this->db->insert_id();
    }

    public function create_status($data)
    {
        $this->db->insert($this->_statusTableName, $data);
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
        $this->db->where('id', $id);
        return $this->db->update($this->_tableName, array('active' => 0));
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
        $this->db->select($this->_tableName.'.*, users.first_name, users.last_name');
        $this->db->join('users', 'users.id = ' . $this->_tableName . '.agent_id', 'left');
        if (! $all)
        {
            $this->db->where_in('user_id', $user_ids);
            $this->db->or_where_in('agent_id', $user_ids);
        }
        $this->db->order_by('splitting_time', 'desc');
        $query = $this->db->get($this->_tableName);
        if($query->num_rows()>0)
        {
            $result = $query->result();
            foreach($result as $item)
                $lead_ids[] = $item->id;

            $status_data = $this->get_statuses_by_lead_id($lead_ids);

            foreach ($result as $item)
                $item->statuses = $status_data[$item->id];

            return ['items' => $result];
        }
        return [];
    }

    public function get_by_structure_id($structure_id)
    {
        if (! $structure_id) return [];
        $this->db->select($this->_tableName.'.*, users.first_name, users.last_name');
        $this->db->join('users', 'users.id = ' . $this->_tableName . '.agent_id', 'left');
        $this->db->where('structure_id', $structure_id);
        $this->db->order_by('splitting_time', 'desc');
        $query = $this->db->get($this->_tableName);
        if($query->num_rows()>0)
        {
            $result = $query->result();
            foreach($result as $item)
                $lead_ids[] = $item->id;

            $status_data = $this->get_statuses_by_lead_id($lead_ids);

            foreach ($result as $item)
                $item->statuses = $status_data[$item->id];

            return ['items' => $result];
        }
        return [];
    }

    public function get_statuses_by_lead_id($lead_id = NULL)
    {
        $this->db->select($this->_statusTableName.'.*, users.first_name, users.last_name');
        $this->db->join('users', 'users.id = user_id');
        if(isset($lead_id))
        {
            if (! is_array($lead_id))
                $lead_id = [$lead_id];
            $this->db->where_in('lead_id', $lead_id);
        }
        $this->db->order_by('created_time', 'desc');
        $query = $this->db->get($this->_statusTableName);

        if($query->num_rows()>0)
        {
            $result = $query->result();
            $now = date('Y-m-d H:i:s');
            $return = [];
            foreach ($result as $item)
            {
                if ($item->reminder_time)
                {
                    if ($item->reminder_time > $return[$item->lead_id]['latest_reminder'])
                        $return[$item->lead_id]['latest_reminder'] = $item->reminder_time;

                    if (($item->reminder_time > $now)
                        && (! $return[$item->lead_id]['next_action_time'] || ($item->reminder_time < $return[$item->lead_id]['next_action_time']))
                    )
                        $return[$item->lead_id]['next_action_time'] = $item->reminder_time;
                }
                $return[$item->lead_id]['items'][] = $item;
            }
            return $return;
        }
        return false;
    }

    public function get_not_splitted($user_ids)
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
        $this->db->select($this->_tableName.'.*, users.first_name, users.last_name, users.structure_id');
        $this->db->select('(select title from banks where banks.id = bank_id) as bank', null, false);
        $this->db->join('users', 'users.id = ' . $this->_tableName . '.user_id');
        $this->db->where('agent_id is null');
        if (! $all)
        {
            $this->db->where_in('user_id', $user_ids);
        }
        $this->db->order_by('created_time', 'desc');
        $query = $this->db->get($this->_tableName);
        if($query->num_rows()>0)
        {
            $result = $query->result();
            return $result;
        }
        return [];
    }

    public function get_not_splitted_by_structure_id($structure_id)
    {
        if (! $structure_id) return [];
        $this->db->select($this->_tableName.'.*, users.first_name, users.last_name, users.structure_id');
        $this->db->select('(select title from banks where banks.id = bank_id) as bank', null, false);
        $this->db->join('users', 'users.id = ' . $this->_tableName . '.user_id');
        $this->db->where('agent_id is null');
        $this->db->where('structure_id', $structure_id);
        $this->db->order_by('created_time', 'desc');
        $query = $this->db->get($this->_tableName);
        if($query->num_rows()>0)
        {
            $result = $query->result();
            return $result;
        }
        return [];
    }
}