<?php

/**
* 
*/
class order_model extends CI_Model
{
	
	public function getAll()
	{
		//$query = $this->db->query("select * from service_order");
		$query = $this->db->query("select * from v_service_order");
		return $query->result();
	}

	public function getId($id){
		$query = $this->db->get_where('service_order', array('svo_id' => $id));
		return $query->result();
	}
	public function getByVehicleOwnerId($id){
		$query = $this->db->get_where('v_service_order', array('svo_vehicle_owner' => $id));
		return $query->result();
	}

	public function addOrder($options = array())
	{
		try {
			$this->db->insert('service_order',$options);
			$id = $this->db->insert_id();
		} catch (exception $e) {
			return false;
		}
		return $id;
	}

	public function updateOrder($options = array())
	{
		try {
			$id = $options['svo_id'];
			unset($options['svo_id']);
			$this->db->update('service_order', $options,array('svo_id'=>$id));
		} catch (exception $e) {
			return false;
		}
		return true;
	}

	public function deleteOrder($id)
	{
		try {
			$this->db->delete('service_order', array('svo_id' => $id));
		} catch (exception $e) {
			return false;
		}
		return true;
	}
	
}
?>