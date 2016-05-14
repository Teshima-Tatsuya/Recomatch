<?php

// Load in the Autoloader
require COREPATH.'classes'.DIRECTORY_SEPARATOR.'autoloader.php';
class_alias('Fuel\\Core\\Autoloader', 'Autoloader');

// Bootstrap the framework DO NOT edit this
require COREPATH.'bootstrap.php';

Autoloader::add_classes(array(
	// Add classes you want to override here
	'Agent' => APPPATH.'classes/core/agent.php',
	'Fuel\\Core\\Controller_SmartyTemplate' => APPPATH.'classes/core/controller/smartytemplate.php',
	'Controller' => APPPATH.'classes/core/controller.php',
	'MyController' => APPPATH.'classes/core/mycontroller.php',
	'Log' => APPPATH.'classes/core/log.php',
	'Validation' => APPPATH.'classes/core/validation.php',
	'Pagination' => APPPATH.'classes/core/pagination.php',
	'View' => APPPATH.'classes/core/view.php',
	'MyOrm' => APPPATH.'classes/core/myorm.php',
));

// Register the autoloader
Autoloader::register();

/**
 * Your environment.  Can be set to any of the following:
 *
 * Fuel::DEVELOPMENT
 * Fuel::TEST
 * Fuel::STAGING
 * Fuel::PRODUCTION
 */
Fuel::$env = (isset($_SERVER['FUEL_ENV']) ? $_SERVER['FUEL_ENV'] : Fuel::DEVELOPMENT);

// Initialize the framework with the config file.
Fuel::init('config.php');
