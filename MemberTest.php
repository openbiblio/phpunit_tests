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

	public function testAddMemberReturnsErrorWhenRequiredFieldsMissing() {
                $url = OBIB_LOCAL_URL . "/circ/memberServer.php";
                $opts = array('http' => array('method' => 'POST', 'content' => 'mode=addNewMember&lastName=BEAST&barcode_nmber=29191919'));
                $context  = stream_context_create($opts);
                $this->assertGreaterThan(0, strlen(file_get_contents($url, false, $context)));

	}

}
