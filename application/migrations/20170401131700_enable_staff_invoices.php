<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Enable_staff_invoices extends CI_Migration {

    public function __construct() {
        parent::__construct();

        // lod db forge
        $this->load->dbforge();
    }

    public function up() {
        // add fields
        $fields = array(
            'addon_staff_invoices' => array(
                'type' => "TINYINT",
                'constraint' => 1,
                'default' => 0,
                'null' => FALSE,
                'after' => 'addon_expenses'
            )
        );
        $this->dbforge->add_column('accounts', $fields);
    }

    public function down() {
        // remove fields
        $this->dbforge->drop_column('accounts', 'addon_staff_invoices');
    }
}