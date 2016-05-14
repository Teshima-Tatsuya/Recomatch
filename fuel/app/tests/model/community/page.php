<?php

/**
 * @group App
 * @group Community
 */
class Test_Model_Community_PageTest extends MyTestCase
{

	public function test_insert()
	{
		$dto = new Dto\Community\Page();
		$dto->title("test");
		$dto->communityId(1);
		$dto->itemId(1);
		$dto->comment("comment");
		$result = Model_Community_Page::insert($dto);

		$this->assertNotNull($result);
		$this->assertEquals($result->title(), "test");
		$this->assertEquals($result->comment(), "comment");
		$this->assertEquals($result->itemId(), 1);
		$this->assertEquals($result->communityId(), 1);
	}

	public function test_validate()
	{
		$val = Model_Community_Page::validate(__FUNCTION__);

		$data = [
			'community_id' => 1,
			'title' => "title",
			'comment' => "comment",
		];
		$res = $val->run($data);
		$this->assertTrue($res);

		$data = [
			'community_id' => "notNum",
			'title' => "title",
			'comment' => "comment",
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
		$obj = Model_Community_Page::incrementLikeNum($id);
		$actual= $obj->like_num;

		$this->assertEquals($expected, $actual);
	}

	public function test_incrementLikeNumIDIsNone() {
		$id  = 1000;

		$expected = null;
		
		// インクリメント
		$obj = Model_Community_Page::incrementLikeNum($id);
		$actual= $obj;

		$this->assertNull($actual);
	}

}
