<?php

namespace Fuel\Migrations;

class Create_community_page
{
	public function up()
	{
		\DBUtil::create_table('community_page', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'user_id' => array('constraint' => 11, 'type' => 'int', 'default' => '0'),
			'community_id' => array('constraint' => 11, 'type' => 'int'),
			'title' => array('constraint' => 500, 'type' => 'varchar'),
			'comment' => array('type' => 'text'),
			'like_num' => array('constraint' => 11, 'type' => 'int', 'default' => '0'),
			'item_id' => array('constraint' => 11, 'type' => 'int', 'default' => '-1'),
			'movie_id' => array('constraint' => 11, 'type' => 'int', 'default' => '-1'),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('community_page');
	}
}