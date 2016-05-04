<?php
class StateTest extends PHPUnit_Framework_TestCase {

	private function getJSONStates() {
		$url = OBIB_LOCAL_URL . "/admin/adminSrvr.php";
		$opts = array('http' => array('method' => 'POST', 'content' => 'cat=states&mode=getAll_states'));
		$context  = stream_context_create($opts);
		return file_get_contents($url, false, $context);
	}

	public function testStatesListIsValidJson() {
		$this->assertInternalType('array', json_decode($this->getJSONStates(), 1));
	}

}
