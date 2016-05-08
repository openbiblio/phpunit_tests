# phpunit_tests

These tests verify specific functionalities for OpenBiblio 1.0.

Please do not attempt to run these tests on a production system, or any
other system with data you'd like to keep. This repo includes tests 
of database CRUD actions, so you will likely end up with data that have
been clobbered and modified in undesirable ways.

1. Download PHPUnit from here: https://phpunit.de/
2. Install faker (https://github.com/fzaninotto/Faker)
3. Download this repo. 
4. Make sure all the paths are correct in the BOOTSTRAP.php file.
5. Run the tests from the test directory using `phpunit --bootstrap=BOOTSTRAP.php .`
