<?php
namespace Mytest;

use Fuel\Core\DB;
use Fuel\Core\TestCase;
use Fuel\Core\Format;

/**
 * Description of mytestcase
 *
 * @author Teshima
 */
class MyTestCase extends TestCase
{
	public function setUp()
	{
		DB::start_transaction();
		self::initializeData(APPPATH."tests/db_data.yml");
	}
	
	public function tearDown()
	{
		DB::rollback_transaction();
	}
	
	public static function initializeData($yaml_filepath) {
		$data = file_get_contents($yaml_filepath);
		$tables = Format::forge($data, 'yaml')->to_array();
		
		foreach (array_keys($tables) as $table_name) {
			$rows = $tables[$table_name];
			
			foreach ($rows as $row) {
				try {
					DB::insert($table_name)->set($row)->execute();
				} catch (Exception $e) {
					DB::rollback_transaction();
					throw $e;
				}
			}
		}
	}
}