<?php

/**
* 
*/
class employee_model extends CI_Model
{
	
	public function getAll()
	{
		$query = $this->db->query("select * from employee");
		return $query->result();
	}

	public function getId($id){
		$query = $this->db->get_where('employee', array('emp_id' => $id));
		return $query->result();
	}

	public function addEmployee($options = array())
	{
		try {
			$this->db->insert('employee',$options);
			$id = $this->db->insert_id();
		} catch (exception $e) {
			return false;
		}
		return $id;
	}

	public function updateEmployee($options = array())
	{
		try {
			$id = $options['emp_id'];
			unset($options['emp_id']);
			$this->db->update('employee', $options,array('emp_id'=>$id));
		} catch (exception $e) {
			return false;
		}
		return true;
	}

	public function deleteEmployee($id)
	{
		try {
			$this->db->delete('employee', array('emp_id' => $id));
		} catch (exception $e) {
			return false;
		}
		return true;
	}
	
	public function getLikeName($name)
	{
		$this->db->like('UPPER(emp_name)', strtoupper($name), 'after');
		$query = $this->db->get("employee");
		return $query->result();
	}
}

?>
