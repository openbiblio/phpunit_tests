<?php
class CalendarTest extends PHPUnit_Framework_TestCase {

	private function getRandomCalendar() {
		return 2;
	}

	public function testCanGetHTMLCalendarDisplay() {
		$url = OBIB_LOCAL_URL . "/admin/calendarSrvr.php";
		$opts = array('http' => array('method' => 'POST', 'content' => 'mode=getCalendar&calendar='.$this->getRandomCalendar()));
		$context  = stream_context_create($opts);
		$this->assertGreaterThan(0, strlen(file_get_contents($url, false, $context)));
	}
}
