<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_Views extends CI_Migration {

	public function up()
	{

		$this->db->query("CREATE VIEW `v_model` 
							AS select 
							`m`.`mod_id` AS `mod_id`,
							`m`.`mod_name` AS `mod_name`,
							`m`.`mod_brand` AS `mod_brand`,
							`m`.`mod_updated_on` AS `mod_updated_on`,
							`m`.`mod_created_on` AS `mod_created_on`,
							`b`.`bra_name` AS `bra_name` 
							from (`model` `m` join `brand` `b`) 
							where (`b`.`bra_id` = `m`.`mod_brand`);
						");

		$this->db->query("CREATE VIEW `v_service_order` 
							AS select 
							`s`.`svo_id` AS `svo_id`,
							`c`.`cli_name` AS `svo_vehicle_owner_name`, 
							`vo`.`vow_vehicle` AS `svo_vehicle_owner_car`, 
							`s`.`svo_vehicle_owner`	AS `svo_vehicle_owner`,
							`s`.`svo_pickup_address` AS `svo_pickup_address`,
							`s`.`svo_pickup_datetime` AS `svo_pickup_datetime`,
							`s`.`svo_delivery_address` AS `svo_delivery_address`,
							`s`.`svo_delivery_datetime` AS `svo_delivery_datetime`,
							`s`.`svo_more_info` AS `svo_more_info`,
							`s`.`svo_created_on` AS `svo_created_on`,
							`s`.`svo_finished_on` AS `svo_finished_on`
							from (`service_order` `s` 
									join `vehicle_owner` `vo` ON `s`.`svo_vehicle_owner` = `vo`.`vow_id`
									join `client` `c` ON `c`.`cli_id` = `vo`.`vow_client`);
						");

		$this->db->query("CREATE VIEW `v_activity` 
							AS select 
							`a`.`act_id` AS `act_id`,
							`a`.`act_service` AS `act_service`,
							`a`.`act_value` AS `act_value`,
							`a`.`act_employee` AS `act_employee`,
							`a`.`act_service_order` AS `act_service_order`,
							`s`.`svc_name` AS `act_service_name`,
							`e`.`emp_name` AS `act_employee_name`
							from (`activity` `a` 
									join `service` `s` ON `a`.`act_service` = `s`.`svc_id`
									join `employee` `e` ON `a`.`act_employee` = `e`.`emp_id`);
						");
	}

	public function down()
	{
		$this->db->query("drop view v_model");
		$this->db->query("drop view v_service_order");
		$this->db->query("drop view v_activity");
	}
}
