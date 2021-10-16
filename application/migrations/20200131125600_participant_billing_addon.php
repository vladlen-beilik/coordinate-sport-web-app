<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Participant_billing_addon extends CI_Migration {

		public function __construct() {
			parent::__construct();

			// load db forge
			$this->load->dbforge();
		}

		public function up() {

			// add field to accounts
			$fields = array(
				'addon_participant_billing' => array(
					'type' => 'TINYINT',
					'constraint' => 1,
					'default' => 0,
					'null' => FALSE,
					'after' => 'addon_contracts'
				)
			);
			$this->dbforge->add_column('accounts', $fields);

		}

		public function down() {
			// remove field from accounts, if exists
			if ($this->db->field_exists('addon_participant_billing', 'accounts')) {
				$this->dbforge->drop_column('accounts', 'addon_participant_billing');
			}
		}
}
