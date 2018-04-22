<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_Model extends CI_Migration {

    public function up()
    {
        $this->dbforge->add_field("`mod_id` int(11) NOT NULL AUTO_INCREMENT");
        $this->dbforge->add_key("mod_id`", TRUE);

        $this->dbforge->add_field("`mod_name` varchar(255) NOT NULL");
        $this->dbforge->add_field("`mod_brand` int(11) NOT NULL");
        $this->dbforge->add_field("`mod_updated_on` timestamp NULL ON UPDATE CURRENT_TIMESTAMP");
        $this->dbforge->add_field("`mod_created_on` timestamp NULL");

        $this->dbforge->create_table("model", TRUE);

        $this->db->query("ALTER TABLE model ADD FOREIGN KEY (mod_brand) REFERENCES brand(bra_id)");
    }

    public function down()
    {
        $this->dbforge->drop_table("model");
    }
}
