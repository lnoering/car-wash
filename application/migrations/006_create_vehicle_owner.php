<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_Vehicle_Owner extends CI_Migration {

	public function up()
	{
		$this->dbforge->add_field("`vow_id` int(11) NOT NULL AUTO_INCREMENT");
		$this->dbforge->add_key("`vow_id`", TRUE);

		$this->dbforge->add_field("`vow_vehicle` varchar(10) ");
		$this->dbforge->add_field("`vow_client` int(11) ");
		$this->dbforge->add_field("`vow_date` datetime NOT NULL");
		$this->dbforge->add_field("`vow_active` boolean DEFAULT TRUE");
		$this->dbforge->add_field("`vow_updated_on` timestamp NULL ON UPDATE CURRENT_TIMESTAMP");
		$this->dbforge->add_field("`vow_created_on` timestamp NULL");

		$this->dbforge->create_table("vehicle_owner", TRUE);

		$this->db->query("ALTER TABLE vehicle_owner ADD FOREIGN KEY (vow_vehicle) REFERENCES vehicle(veh_license)");
		$this->db->query("ALTER TABLE vehicle_owner ADD FOREIGN KEY (vow_client) REFERENCES client(cli_id)");
	}

	public function down()
	{
		$this->dbforge->drop_table("vehicle_owner");
  }
}
