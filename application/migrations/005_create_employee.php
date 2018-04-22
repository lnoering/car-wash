<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_Employee extends CI_Migration {

  public function up()
  {
    $this->dbforge->add_field("`emp_id` int(11) NOT NULL AUTO_INCREMENT");
    $this->dbforge->add_key("`emp_id`", TRUE);

    $this->dbforge->add_field("`emp_name` varchar(255) NOT NULL");
    $this->dbforge->add_field("`emp_email` varchar(255) NOT NULL");
    $this->dbforge->add_field("`emp_phone` varchar(255) NOT NULL");
    $this->dbforge->add_field("`emp_birth` date DEFAULT NULL");
    $this->dbforge->add_field("`emp_password` varchar(255) NOT NULL");
    $this->dbforge->add_field("`emp_updated_on` timestamp NULL ON UPDATE CURRENT_TIMESTAMP");
    $this->dbforge->add_field("`emp_created_on` timestamp NULL");

    $this->dbforge->create_table("employee", TRUE);
  }

  public function down()
  {
    $this->dbforge->drop_table("employee");
  }
}
