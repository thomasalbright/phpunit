--TEST--
#783: Tests getting executed twice when using multiple groups
--FILE--
<?php
$_SERVER['argv'][1] = '--no-configuration';
$_SERVER['argv'][2] = '--group';
$_SERVER['argv'][3] = 'foo,bar';
$_SERVER['argv'][4] = 'ParentSuite';
$_SERVER['argv'][5] = 'Regression/783/ParentSuite.php';

require_once dirname(dirname(dirname(__FILE__))) . '/TextUI/Command.php';
PHPUnit_TextUI_Command::main();
?>
--EXPECTF--
PHPUnit %s by Sebastian Bergmann.

..

Time: %i %s, Memory: %sMb

OK (2 tests, 0 assertions)
