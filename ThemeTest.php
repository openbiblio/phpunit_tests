<?php
class ThemeTest extends PHPUnit_Framework_TestCase {

	private function getJSONThemeDirs() {
		$url = OBIB_LOCAL_URL . "/admin/adminSrvr.php";
		$opts = array('http' => array('method' => 'POST', 'content' => 'cat=themes&mode=getThemeDirs'));
		$context  = stream_context_create($opts);
		return file_get_contents($url, false, $context);
	}

	public function testThemeDirsListIsValidJson() {
		$this->assertInternalType('object', json_decode($this->getJSONThemeDirs()));
	}


}
