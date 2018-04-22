<?php

/**
* 
*/
class brand_model extends CI_Model
{
	public function getAll()
	{
		$query = $this->db->query("select * from brand");
		return $query->result();
	}

	public function getId($id){
		$query = $this->db->get_where('brand', array('bra_id' => $id));
		return $query->result();
	}

	public function addBrand($options = array())
	{
		try {
			$this->db->insert('brand',$options);
			$id = $this->db->insert_id();
		} catch (exception $e) {
			return false;
		}
		return $id;
	}

	public function updateBrand($options = array())
	{
		try {
			$id = $options['bra_id'];
			unset($options['bra_id']);
			$this->db->update('brand', $options,array('bra_id'=>$id));
		} catch (exception $e) {
			return false;
		}
		return true;
	}

	public function deleteBrand($id)
	{
		try {
			$this->db->delete('brand', array('bra_id' => $id));
		} catch (exception $e) {
			return false;
		}
		return true;
	}
	
	public function getLikeName($name)
	{
		$this->db->like('UPPER(bra_name)', strtoupper($name), 'after');
		$query = $this->db->get("brand");
		return $query->result();
	}

	public function getName($name)
	{
		$query = $this->db->get_where('brand', array('UPPER(bra_name)' => strtoupper($name)));
		return $query->result();
	}

	public function getWhereIds($values)
	{
		if(count($values) > 0)
		{
			$query = $this->db->select('bra_id, bra_name');
			$query = $this->db->where_in('bra_id',$values);
			$query = $this->db->get('brand');
			$values = $query->result();
			$return = array();
			foreach ($values as $value) {
				$return[$value->bra_id] = $value->bra_name; 
			}
			return $return;
		}
		return false;
	}
}

?>
