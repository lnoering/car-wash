<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_Service extends CI_Migration {

	public function up()
	{
		$this->dbforge->add_field("`svc_id` int(11) NOT NULL AUTO_INCREMENT");
		$this->dbforge->add_key("`svc_id`", TRUE);

		$this->dbforge->add_field("`svc_name` varchar(200) NOT NULL");
		$this->dbforge->add_field("`svc_description` text DEFAULT NULL");
		$this->dbforge->add_field("`svc_value` numeric(15,2) NOT NULL");
		$this->dbforge->add_field("`svc_updated_on` timestamp NULL ON UPDATE CURRENT_TIMESTAMP");
		$this->dbforge->add_field("`svc_created_on` timestamp NULL");

		$this->dbforge->create_table("service", TRUE);
	}

	public function down()
	{
		$this->dbforge->drop_table("service");
	}
}
