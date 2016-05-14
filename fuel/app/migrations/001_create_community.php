<?php

namespace Fuel\Migrations;

class Create_community
{
	public function up()
	{
		\DBUtil::create_table('community', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'title' => array('constraint' => 200, 'type' => 'varchar'),
			'comment' => array('type' => 'text'),
			'comment_num' => array('constraint' => 11, 'type' => 'int', 'default' => '0'),
			'like_num' => array('constraint' => 11, 'type' => 'int', 'default' => '0'),
			'item_id' => array('constraint' => 11, 'type' => 'int', 'default' => '-1'),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('community');
	}
}