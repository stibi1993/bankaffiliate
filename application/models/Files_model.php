<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Files_Model extends CI_Model
{
    protected $_tableName = "files";

    public function create($data)
    {
        $this->db->insert($this->_tableName, $data);
        return $this->db->insert_id();
    }

    public function update($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update($this->_tableName, $data);
    }

    public function get_by_id($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get($this->_tableName);
        return $query->row();
    }

    public function get_by_foreign_key($field, $id)
    {
        $this->db->where(array($field => $id, 'active'=>1));
        $this->db->order_by("id", "desc");
        $query = $this->db->get($this->_tableName);
        return $query->result();
    }

    public function delete($id)
    {
        //$file = $this->get_file($file_id);
        $this->db->where('id', $id);

        if (! $this->db->update($this->_tableName, array('active' => 0)))
            return FALSE;
        //unlink('./uploads/' . $file->filename);
        return TRUE;
    }
	
	public function delete_by_table_id($table, $id)
    {
        $this->db->where($table.'_id', $id);

        if (! $this->db->update($this->_tableName, array('active' => 0)))
            return FALSE;
        //unlink('./uploads/' . $file->filename);
        return TRUE;
    }

}
?>