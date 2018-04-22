<?php

/**
* 
*/
class client_model extends CI_Model
{
	
	public function getAll()
	{
		$query = $this->db->query("select * from client");
		return $query->result();
	}
	
	public function getId($id){
		$query = $this->db->get_where('client', array('cli_id' => $id));
		return $query->result();
	}

	public function getLikeName($name){
		$this->db->like('cli_name', $name);
		$query = $this->db->get("client");
		return $query->result();
	}

	public function getIdLikeName($name){
		$this->db->like('cli_name', $name);
		$query = $this->db->select("cli_id");
		$query = $this->db->get("client");
		return $query->result();
	}
	
	public function addClient($options = array())
	{
		try {
			$this->db->insert('client',$options);
			$id = $this->db->insert_id();
		} catch (exception $e) {
			return false;
		}
		return $id;
	}

	public function updateClient($options = array())
	{
		try {
			$id = $options['cli_id'];
			unset($options['cli_id']);
			$this->db->update('client', $options,array('cli_id'=>$id));
		} catch (exception $e) {
			return false;
		}
		return true;
	}

	public function deleteClient($id)
	{
		try {
			$this->db->delete('client', array('cli_id' => $id));
		} catch (exception $e) {
			return false;
		}
		return true;
	}
	
}


?>
