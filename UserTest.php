<?php
class UserTest extends PHPUnit_Framework_TestCase {

	function __construct() {
		$this->fake = Faker\Factory::create();
	}

	private function getJSONStaff() {
		$url = OBIB_LOCAL_URL . "/admin/adminSrvr.php";
		$opts = array('http' => array('method' => 'POST', 'content' => 'cat=staff&mode=getAll_staff'));
		$context  = stream_context_create($opts);
		return file_get_contents($url, false, $context);
	}

	public function testStaffListIsValidJson() {
		$this->assertInternalType('array', json_decode($this->getJSONStaff(), 1));
	}

	public function testStaffAdd() {
		$staff = new Staff;
		$staff->insert_el(array(
			'username' => $this->fake->userName,
			'pwd' => $this->fake->password,
			'last_name' => $this->fake->lastName,
			'first_name' => $this->fake->firstName,
                        'suspended_flg'=>boolean_flag_text(),
                        'admin_flg'=>boolean_flag_text(),
                        'tools_flg'=>boolean_flag_text(),
                        'circ_flg'=>boolean_flag_text(),
                        'circ_mbr_flg'=>boolean_flag_text(),
                        'catalog_flg'=>boolean_flag_text(),
                        'reports_flg'=>boolean_flag_text(),
		));

	}


}
