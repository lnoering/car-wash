<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_Activity extends CI_Migration {

	public function up()
	{
		$this->dbforge->add_field("`act_id` int(11) NOT NULL AUTO_INCREMENT");
		$this->dbforge->add_key("`act_id`", TRUE);

		//$this->dbforge->add_field("`act_vehicle_owner` int(11) NOT NULL");
		$this->dbforge->add_field("`act_service` int(11) NOT NULL");
		$this->dbforge->add_field("`act_value` numeric(15,2) NOT NULL");
		$this->dbforge->add_field("`act_employee` int(11) NOT NULL");
		$this->dbforge->add_field("`act_service_order` int(11) NOT NULL");
		$this->dbforge->add_field("`act_updated_on` timestamp NULL ON UPDATE CURRENT_TIMESTAMP");
		$this->dbforge->add_field("`act_created_on` timestamp NULL");

		$this->dbforge->create_table("activity", TRUE);

		//$this->db->query("ALTER TABLE activity ADD FOREIGN KEY (act_vehicle_owner) REFERENCES vehicle_owner(vow_id) ");
		$this->db->query("ALTER TABLE activity ADD FOREIGN KEY (act_service) REFERENCES service(svc_id) ");
		$this->db->query("ALTER TABLE activity ADD FOREIGN KEY (act_employee) REFERENCES employee(emp_id) ");
		$this->db->query("ALTER TABLE activity ADD FOREIGN KEY (act_service_order) REFERENCES service_order(svo_id) ");
	}

	public function down()
	{
		$this->dbforge->drop_table("activity");
	}
}
