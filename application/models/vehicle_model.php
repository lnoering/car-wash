<?php

/**
* 
*/
class vehicle_model extends CI_Model
{
	
	public function getAll()
	{
		$query = $this->db->query("select 	v.veh_license veh_license, 
											v.veh_model veh_model_id, 
											m.mod_name veh_model, 
											v.veh_year veh_year, 
											m.mod_brand veh_brand_id,
											b.bra_name bra_name,
											v.veh_updated_on veh_updated_on, 
											v.veh_created_on veh_created_on 
									from 	vehicle v, 
											model m, 
											brand b 
									where m.mod_id = v.veh_model
									and m.mod_brand = b.bra_id");
		return $query->result();
	}

	public function getId($id){
		$query = $this->db->get_where('vehicle', array('veh_license' => $id));
		return $query->result();
	}
	
	public function getViewId($id){
		$query = $this->db->query("select 	v.veh_license veh_license, 
											v.veh_model veh_model_id, 
											m.mod_name veh_model, 
											v.veh_year veh_year, 
											m.mod_brand veh_brand_id,
											b.bra_name bra_name,
											v.veh_updated_on veh_updated_on, 
											v.veh_created_on veh_created_on 
									from 	vehicle v, 
											model m, 
											brand b 
									where v.veh_license = '$id'
									AND m.mod_id = v.veh_model
									AND m.mod_brand = b.bra_id" 
									);
		return $query->result();
	}

	public function getLikeId($id){
		$this->db->like('veh_license', $id, 'after');
		$query = $this->db->get("vehicle");
		return $query->result();
	}

	public function getIdLikeId($id){
		$this->db->like('veh_license', $id, 'after');
		$query = $this->db->select("veh_license");
		$query = $this->db->get("vehicle");
		return $query->result();
	}

	public function addVehicle($options = array())
	{
		try {
			$this->db->insert('vehicle',$options);
		} catch (exception $e) {
			return false;
		}
		return true;
	}

	public function updateVehicle($options = array())
	{
		try {
			$id = $options['veh_license'];
			unset($options['veh_license']);
			$this->db->update('vehicle', $options,array('veh_license'=>$id));
		} catch (exception $e) {
			return false;
		}
		return true;
	}

	public function deleteVehicle($id)
	{
		try {
			$this->db->delete('vehicle', array('veh_license' => $id));
		} catch (exception $e) {
			return false;
		}
		return true;
	}
	
}
?>
