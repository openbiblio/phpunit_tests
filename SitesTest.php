<?php
class SitesTest extends PHPUnit_Framework_TestCase {

	function __construct() {
		$this->fake = Faker\Factory::create();
		$this->site = new Sites;
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

	public function getRandomSiteId() {
		// TODO: This should only return valid site ids
		return rand(1,20);
	}

	public function testSiteAdd() {
	// Assumes that calendar #2 exists
		$company = $this->fake->company;
		$code = substr(md5(rand()), 0, 6);

		$this->site->insert_el(array(
			'calendar' => 2,
			'name' => $company,
			'code' => $code,
			'address1' => $this->fake->streetAddress,
			'city' => $this->fake->city,
			'email' => $this->fake->email,
			'delivery_note' => 'Please deliver this'));

                $rows = $this->site->getMatches(array(
                        'calendar' => 2,
                        'name' => $company,
                        'code' => $code,
                ));

                while (($row = $rows->fetch_assoc()) !== NULL) {
                        $this->assertTrue(True);
                        return 1;
                }
		throw new Exception('Could not find added site.');
        }

	public function testDeleteSite() {
		$site = $this->getRandomSiteId();
		$_SESSION['current_site'] = '';
		$this->site->deleteOne($site);

                $row = $this->site->maybeGetOne($site);
		$this->assertNull($row);
	}

	public function testCannotDeleteCurrentSite() {
		$site = $this->getRandomSiteId();
		$_SESSION['current_site'] = $site;
		$this->site->deleteOne($site);

                $row = $this->site->getOne($site);
		$this->assertInternalType('array', $row);
	}

}
