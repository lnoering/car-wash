<?php

/**
* 
*/
class model_model extends CI_Model
{
	public function getAll()
	{
		$query = $this->db->query("select * from v_model");/*" select m.*, b.bra_name bra_name 
									from model m, brand b
									where b.bra_id = m.mod_brand");*/
		return $query->result();
	}

	public function getId($id){
		$query = $this->db->get_where('v_model', array('mod_id' => $id));
		return $query->result();
	}

	public function addModel($options = array())
	{
		try {
			$this->db->insert('model',$options);
			$id = $this->db->insert_id();
		} catch (exception $e) {
			return false;
		}
		return $id;
	}

	public function updateModel($options = array())
	{
		try {
			$id = $options['mod_id'];
			unset($options['mod_id']);
			$this->db->update('model', $options,array('mod_id'=>$id));
		} catch (exception $e) {
			return false;
		}
		return true;
	}

	public function deleteModel($id)
	{
		try {
			$this->db->delete('model', array('mod_id' => $id));
		} catch (exception $e) {
			return false;
		}
		return true;
	}

	public function getLikeName($name)
	{
		$query = $this->db->like('UPPER(mod_name)', strtoupper($name), 'after');
		$query = $this->db->get("model");
		return $query->result();
	}

	public function getLikeNameFilterByBrand($name, $brand)
	{
		$query = $this->db->like('UPPER(mod_name)', strtoupper($name));

		if($brand){
			$query = $this->db->get_where('model', array('mod_brand' => $brand));
		} else {
			$query = $this->db->get("model");
		}

		return $query->result();
	}	

	public function getName($name)
	{
		$query = $this->db->get_where('model', array('UPPER(mod_name)' => strtoupper($name)));
		return $query->result();
	}
}
?>
