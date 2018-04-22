<?php

/**
* 
*/
class service_model extends CI_Model
{

	public function getAll()
	{
		$query = $this->db->query("select * from service");
		return $query->result();
	}

	public function getId($id){
		$query = $this->db->get_where('service', array('svc_id' => $id));
		return $query->result();
	}

	public function getLikeName($name){
		$this->db->like('svc_name', $name);
		$query = $this->db->get("service");
		return $query->result();
	}
	
	public function addService($options = array())
	{
		try {
			$this->db->insert('service',$options);
			$id = $this->db->insert_id();
		} catch (exception $e) {
			return false;
		}
		return $id;
	}

	public function updateService($options = array())
	{
		try {
			$id = $options['svc_id'];
			unset($options['svc_id']);
			$this->db->update('service', $options,array('svc_id'=>$id));
		} catch (exception $e) {
			return false;
		}
		return true;
	}

	public function deleteService($id)
	{
		try {
			$this->db->delete('service', array('svc_id' => $id));
		} catch (exception $e) {
			return false;
		}
		return true;
	}

}
?>