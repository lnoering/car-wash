<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_Brand extends CI_Migration {

    public function up()
    {
        $this->dbforge->add_field("`bra_id` int(11) NOT NULL AUTO_INCREMENT");
        $this->dbforge->add_key("`bra_id`", TRUE);

        $this->dbforge->add_field("`bra_name` varchar(255) NOT NULL");
        $this->dbforge->add_field("`bra_updated_on` timestamp NULL ON UPDATE CURRENT_TIMESTAMP");
        $this->dbforge->add_field("`bra_created_on` timestamp NULL");

        $this->dbforge->create_table("brand", TRUE);
    }

    public function down()
    {
        $this->dbforge->drop_table("brand");
    }
}
