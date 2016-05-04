<?php
class MemberTest extends PHPUnit_Framework_TestCase {

	private function getJSONMembersBySearchQuery() {
		$url = OBIB_LOCAL_URL . "/circ/memberServer.php";
		$opts = array('http' => array('method' => 'POST', 'content' => 'mode=doNameFragSearch&nameFrag='));
		$context  = stream_context_create($opts);
		return file_get_contents($url, false, $context);
	}

	public function testMemberSearchIsValidJson() {
		$this->assertInternalType('array', json_decode($this->getJSONMembersBySearchQuery(), 1));
	}

}
