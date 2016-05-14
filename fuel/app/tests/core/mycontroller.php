<?php
/**
 * @group App
 * @group AppCore
 * @group Controller
 */
class Test_Auth_MyController extends TestCase
{
	
	public function test_getLayout()
	{
		$expected = "layout/myreco";
		$layout = MyController::getLayout("myreco.index");
		
		$this->assertEquals($expected, $layout);
	}
}
