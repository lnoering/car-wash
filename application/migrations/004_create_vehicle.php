<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_Vehicle extends CI_Migration {

	public function up()
	{
		$this->dbforge->add_field("`veh_license` varchar(10) NOT NULL");
		$this->dbforge->add_key("`veh_license`", TRUE);

		$this->dbforge->add_field("`veh_model` int(11) NOT NULL");
		$this->dbforge->add_field("`veh_vehicle` int(11) NOT NULL");
		$this->dbforge->add_field("`veh_year` varchar(8) DEFAULT NULL");
		$this->dbforge->add_field("`veh_updated_on` timestamp NULL ON UPDATE CURRENT_TIMESTAMP");
		$this->dbforge->add_field("`veh_created_on` timestamp NULL");

		$this->dbforge->create_table("vehicle", TRUE);

		$this->db->query("ALTER TABLE vehicle ADD FOREIGN KEY (veh_model) REFERENCES model(mod_id)");		
}

	public function down()
	{
		$this->dbforge->drop_table("vehicle");
	}
}
