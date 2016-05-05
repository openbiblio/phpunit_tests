<?php
define('OBIB_LOCAL_URL', 'http://localhost/obib');
define('OBIB_FILESYSTEM_PATH', '/var/www/html/obib');
define('FAKER_LIB_PATH', '/home/jane/vendor/fzaninotto/faker/src/autoload.php');
define('FAKER_LOCALE', 'ru_RU');

require_once(OBIB_FILESYSTEM_PATH.'/shared/common.php');
require_once(OBIB_FILESYSTEM_PATH.'/model/Calendars.php');
require_once(OBIB_FILESYSTEM_PATH.'/model/Staff.php');

//Use the faker library to generate test data

require_once(FAKER_LIB_PATH);

function boolean_flag_text() {
	if (rand()%2) {
		return 'Y';
	} else {
		return 'N';
	}
}
