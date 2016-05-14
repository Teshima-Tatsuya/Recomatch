<?php

Autoloader::add_core_namespace('Mytest');

Autoloader::add_classes(array(
	'Mytest\\Response' => __DIR__ . '/classes/response.php',
	'Mytest\\MytestException' => __DIR__ . '/classes/mytest.php',
	'Mytest\\MyTestCase' => __DIR__ . '/mytestcase.php',
));
