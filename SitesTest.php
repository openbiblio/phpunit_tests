<?php
class SitesTest extends PHPUnit_Framework_TestCase {

	function __construct() {
		$this->fake = Faker\Factory::create();
	}

	private function getJSONSites() {
		$url = OBIB_LOCAL_URL . "/admin/adminSrvr.php";
		$opts = array('http' => array('method' => 'POST', 'content' => 'cat=sites&mode=getAll_sites'));
		$context  = stream_context_create($opts);
		return file_get_contents($url, false, $context);
	}

	public function testSitesListIsValidJson() {
		$this->assertInternalType('array', json_decode($this->getJSONSites(), 1));
	}

	public function testSiteAdd() {
	// Assumes that calendar #2 exists
		$site = new Sites;
		$site->insert_el(array(
			'calendar' => 2,
			'name' => $this->fake->company,
			'code' => substr(md5(rand()), 0, 6),
			'address1' => $this->fake->streetAddress,
			'city' => $this->fake->city,
			'email' => $this->fake->email,
			'delivery_note' => 'Please deliver this'));
	}


}
