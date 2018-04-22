<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_Client extends CI_Migration {

	public function up()
  {
		$this->dbforge->add_field("`cli_id` int(11) NOT NULL AUTO_INCREMENT");
		$this->dbforge->add_key("`cli_id`", TRUE);

		$this->dbforge->add_field("`cli_name` varchar(255) NOT NULL");
		$this->dbforge->add_field("`cli_cpfcnpj` varchar(14) NOT NULL");
		$this->dbforge->add_field("`cli_email` varchar(255) NOT NULL");
		$this->dbforge->add_field("`cli_phone` varchar(255) NOT NULL");
		$this->dbforge->add_field("`cli_birth` date DEFAULT NULL");
		$this->dbforge->add_field("`cli_updated_on` timestamp NULL ON UPDATE CURRENT_TIMESTAMP");
		$this->dbforge->add_field("`cli_created_on` timestamp NULL");

		$this->dbforge->create_table("client", TRUE);
  }

	public function down()
  {
		$this->dbforge->drop_table("client");
  }
}
