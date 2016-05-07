<?php
class UserTest extends PHPUnit_Framework_TestCase {

	function __construct() {
		$this->fake = Faker\Factory::create();
		$this->staff = new Staff;
	}

	private function getJSONStaff() {
		$url = OBIB_LOCAL_URL . "/admin/adminSrvr.php";
		$opts = array('http' => array('method' => 'POST', 'content' => 'cat=staff&mode=getAll_staff'));
		$context  = stream_context_create($opts);
		return file_get_contents($url, false, $context);
	}

	private function getRandomStaffId() {
		// Clearly not random yet
		return '1';
	}

	public function testStaffListIsValidJson() {
		$this->assertInternalType('array', json_decode($this->getJSONStaff(), 1));
	}

	public function testStaffAdd() {
		$userName = $this->fake->userName;
		$lastName = $this->fake->lastName;
		$firstName = $this->fake->firstName;
		$_SESSION['userid'] = $this->getRandomStaffId();

		$this->staff->insert_el(array(
			'username' => $userName,
			'pwd' => $this->fake->password,
			'last_name' => $lastName,
			'first_name' => $firstName,
                        'suspended_flg'=>boolean_flag_text(),
                        'admin_flg'=>boolean_flag_text(),
                        'tools_flg'=>boolean_flag_text(),
                        'circ_flg'=>boolean_flag_text(),
                        'circ_mbr_flg'=>boolean_flag_text(),
                        'catalog_flg'=>boolean_flag_text(),
                        'reports_flg'=>boolean_flag_text(),
		));

		$rows = $this->staff->getMatches(array(
			'username' => $userName,
			'last_name' => $lastName,
			'first_name' =>	$firstName,
		));

                while (($row = $rows->fetch_assoc()) !== NULL) {
                        $this->assertTrue(True);
			return 1;
                }
		throw new Exception('Could not find added staff member.');
	}

}
