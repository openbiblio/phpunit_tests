<?php
class LocalizeTest extends PHPUnit_Framework_TestCase {

	private function getJSONLocaleList() {
		$url = OBIB_LOCAL_URL . "/shared/listSrvr.php";
		$opts = array('http' => array('method' => 'POST', 'content' => 'mode=getLocaleList'));
		$context  = stream_context_create($opts);
		return file_get_contents($url, false, $context);
	}

	public function testLocaleListIsValidJson() {
		$this->assertInternalType('object', json_decode($this->getJSONLocaleList()));
	}


	public function testCanGetRussianLocale() {
		$ru = new Localize;
		$ru->init('ru');
		$this->assertEquals('Russian', $ru->meta->locale_description);

	}
}
