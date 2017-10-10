<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Permissions_model extends CI_Model
{
	protected $_tableGroups = "groups";
    protected $_tableName = "permissions";
    protected $_tableNameGroupsPermission = "groups_permission";

    public function __construct()
    {
        parent::__construct();
    }

    public function get_all()
    {
        $this->db->where('active',1);
        $this->db->order_by("order", "asc");
        $this->db->order_by("name", "asc");
        $query = $this->db->get($this->_tableName);
        if($query->num_rows()>0)
        {
        	$r =  $query->result();
            return $r;

        }
        
    }

    public function get_by_group_id($group_id  = NULL)
    {
    	$this->db->select('permissions.name, groups_permission.perm_id');
    	$this->db->where('groups_permission.group_id',$group_id);
        $this->db->join('permissions','permissions.id = groups_permission.perm_id');
    	$query = $this->db->get($this->_tableNameGroupsPermission);
    
    	if($query->num_rows()>0)
    	{
    		$r =  $query->result();
    		return $r;
    	}
    
    }
	
	    public function get_all_group_and_permission()
    {

		//** SQL~: SELECT `name` FROM `groups` WHERE `groups_permission`.`perm_id` = 70 JOIN `groups as grp`, `grp`.`id` = `groups_permission`.`group_id`
		//** Lényegében: A groupok nevére van szükségünk, amely groupokhoz tartozik a 70-es permission érték (azaz admin jog) Joinok: group.id->groups_permission.group_id, groups_permission.perm_id->perm_id
	
		$this->db->select('*');
		$this->db->from('groups');
		$this->db->where('id not in (select group_id from groups_permission where groups_permission.perm_id = 70) ');
		$this->db->order_by("name", "asc");

		$query = $this->db->get();
		
        if($query->num_rows()>0)
        {
            return $query->result();
        }
        return FALSE;
    
    }
    
    /**
     * add_to_permission
     *
     **/
    public function add_to_permission($permission_id=false, $group_id=false)
    {
    	$dataPermissions = array(
    			'perm_id' => $permission_id,
    			'group_id' => $group_id
    	);
    	//insert permission
    	return $this->db->insert($this->_tableNameGroupsPermission,$dataPermissions);
    }
    
    /**
     * remove_from_permission
     *
     **/
    public function remove_from_permissions($permission_ids=false, $group_id=false)
    {
    	//$this->trigger_events('remove_from_permission');
    
    	// group id is required
    	if(empty($group_id))
    	{
    		return FALSE;
    	}
    
    	// if group id(s) are passed remove group from the permission(s)
    	if( ! empty($permission_ids))
    	{
    		if(!is_array($permission_ids))
    		{
    			$permission_ids = array($permission_ids);
    		}
    
    		foreach($permission_ids as $permission_id)
    		{
    			$this->db->delete('groups_permission', $group_id);
    		}
    
    		$return = TRUE;
    	}
    	// otherwise remove group from all groups
    	else{ 
    		$return = $this->db->delete('groups_permission', array('group_id'=>$group_id));
    	}
 
    	return $return;
    }
    
}