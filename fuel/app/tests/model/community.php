<?php
/**
 * @group App
 * @group Model
 * @group Community
 */
class Test_Model_CommunityTest extends MyTestCase
{
	public function test_insert()
	{
		$dto = new Dto\Community();
		$dto->title("test");
		$dto->itemId(1);
		$dto->comment("comment");
		$result = Model_Community::insert($dto);
		
		$this->assertNotNull($result);
		$this->assertEquals($result->title(), "test");
		$this->assertEquals($result->comment(), "comment");
		$this->assertEquals($result->itemId(), 1);
	}
	
	public function test_validateSuccess()
	{
		$val = Model_Community::validate(__FUNCTION__);
		
		$data = [
			'title' => 'title',
			'comment' => 'comment',
			'other' => 'other'
		];
		
		$res = $val->run($data);
		
		$this->assertTrue($res);
	}
	
	public function test_validateTitleEmpty()
	{
		$val = Model_Community::validate(__FUNCTION__);
		
		$data = [
			'title' => '',
			'comment' => 'comment',
		];
		
		$res = $val->run($data);
		
		$this->assertFalse($res);
	}

	public function test_validateCommentEmpty()
	{
		$val = Model_Community::validate(__FUNCTION__);
		
		$data = [
			'title' => 'test',
			'comment' => '',
		];
		
		$res = $val->run($data);
		
		$this->assertFalse($res);
	}

	public function test_incrementLikeNum() {
		$id  = 1;
		// idが１の情報を取得
		$find = Model_Community_Page::find($id);
		
		$expected = $find->like_num + 1;
		
		// インクリメント
		$obj = Model_Community::incrementLikeNum($id);
		$actual= $obj->like_num;

		$this->assertEquals($expected, $actual);
	}

	public function test_incrementLikeNumIDIsNone() {
		$id  = 1000;

		$expected = null;
		
		// インクリメント
		$obj = Model_Community::incrementLikeNum($id);
		$actual= $obj;

		$this->assertNull($actual);
	}

}
