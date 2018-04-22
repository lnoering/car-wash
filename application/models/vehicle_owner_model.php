<?php

/**
* 
*/
class vehicle_owner_model extends CI_Model
{
	
	public function getAll()
	{
		$query = $this->db->query("select 	v.vow_id vow_id, 
									v.vow_vehicle vow_vehicle, 
									v.vow_date vow_date, 
									v.vow_active vow_active, 
									v.vow_updated_on vow_updated_on, 
									v.vow_created_on vow_created_on, 
									m.cli_name vow_client, 
									m.cli_id cli_id
							from 	vehicle_owner v, 
									client m
							where m.cli_id = v.vow_client");
		//$query = $this->db->query("select * from vehicle_owner");
		return $query->result();
	}

	public function getId($id){

		$query = $this->db->query("select 	v.vow_id vow_id, 
									v.vow_vehicle vow_vehicle, 
									v.vow_date vow_date, 
									v.vow_active vow_active, 
									v.vow_updated_on vow_updated_on, 
									v.vow_created_on vow_created_on, 
									m.cli_name vow_client, 
									m.cli_id cli_id
							from 	vehicle_owner v, 
									client m
							where m.cli_id = v.vow_client AND v.vow_id = $id");

		//$query = $this->db->get_where('vehicle_owner', array('vow_id' => $id));
		return $query->result();
	}

	public function getByVehicle($id){
		$query = $this->db->select("vow_id");
		$query = $this->db->get_where('vehicle_owner', array('vow_vehicle' => $id));
		return $query->result();
	}

	public function getByClient($id){
		$query = $this->db->select("vow_id");
		$query = $this->db->get_where('vehicle_owner', array('vow_client' => $id));
		return $query->result();
	}

	public function addVehicleOwner($options = array())
	{
		try {
			$this->db->insert('vehicle_owner',$options);
			$id = $this->db->insert_id();
		} catch (exception $e) {
			return false;
		}
		return $id;
	}

	public function updateVehicleOwner($options = array())
	{
		try {
			$id = $options['vow_id'];
			unset($options['vow_id']);
			$this->db->update('vehicle_owner', $options,array('vow_id'=>$id));
		} catch (exception $e) {
			return false;
		}
		return true;
	}

	public function deleteVehicleOwner($id)
	{
		try {
			$this->db->delete('vehicle_owner', array('vow_id' => $id));
		} catch (exception $e) {
			return false;
		}
		return true;
	}

	public function getLikeName($name)
	{
		$query = $this->db->query("select 	v.vow_id vow_id,
											m.cli_name cli_name, 
											ve.veh_license veh_license
									from 	vehicle_owner v, 
											client m,
											vehicle ve
									where v.vow_client = m.cli_id 
										AND 
										  v.vow_vehicle = ve.veh_license 
										AND 
										  m.cli_name LIKE '$name%'");
		/*
		$query = $this->db->like('UPPER(veh_owner_name)', strtoupper($name), 'after');
		$query = $this->db->get("vehicle_owner");
		*/
		return $query->result();
	}
	
}
?>
