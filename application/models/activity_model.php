<?php

/**
* 
*/
class activity_model extends CI_Model
{
	
	public function getAll()
	{
		$query = $this->db->query("select * from activity");
		return $query->result();
	}

	public function getId($id){
		$query = $this->db->get_where('activity', array('act_id' => $id));
		return $query->result();
	}

	public function addActivity($options = array())
	{
		try {
			$this->db->insert('activity',$options);
		} catch (exception $e) {
			return false;
		}
		return true;
	}

	public function updateActivity($options = array())
	{
		try {
			$id = $options['act_id'];
			unset($options['act_id']);
			$this->db->update('activity', $options,array('act_id'=>$id));
		} catch (exception $e) {
			return false;
		}
		return true;
	}

	public function deleteActivity($id)
	{
		try {
			$this->db->delete('activity', array('act_id' => $id));
		} catch (exception $e) {
			return false;
		}
		return true;
	}

	public function deleteActivitiesByOrderId($orderId)
	{
		try {
			$this->db->delete('activity', array('act_service_order' => $orderId));
		} catch (exception $e) {
			return false;
		}
		return true;
	}

	public function getActivitiesByOrderId($id){
		$query = $this->db->get_where('v_activity', array('act_service_order' => $id));
		return $query->result();
	}
	
}
?>