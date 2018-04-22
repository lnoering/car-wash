<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_Service_Order extends CI_Migration {

  public function up()
  {
    $this->dbforge->add_field("`svo_id` int(11) NOT NULL AUTO_INCREMENT");
    $this->dbforge->add_key("`svo_id`", TRUE);

    $this->dbforge->add_field("`svo_vehicle_owner` int(11) NOT NULL");
    $this->dbforge->add_field("`svo_pickup_address` varchar(255)");
    $this->dbforge->add_field("`svo_pickup_datetime` datetime NULL");
    $this->dbforge->add_field("`svo_delivery_address` varchar(255)");
    $this->dbforge->add_field("`svo_delivery_datetime` datetime NULL");

    $this->dbforge->add_field("`svo_more_info` text");

    $this->dbforge->add_field("`svo_created_on` timestamp NULL");
    $this->dbforge->add_field("`svo_finished_on` timestamp NULL");

    $this->dbforge->create_table("service_order", TRUE);

    $this->db->query("ALTER TABLE service_order ADD FOREIGN KEY (svo_vehicle_owner) REFERENCES vehicle_owner(vow_id) ");
  }

  public function down()
  {
    $this->dbforge->drop_table("service_order");
  }
}
