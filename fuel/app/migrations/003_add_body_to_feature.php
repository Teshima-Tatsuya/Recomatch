<?php

namespace Fuel\Migrations;

class Add_body_to_feature
{
	public function up()
	{
		\DBUtil::add_fields('feature', array(
			'body' => array('type' => 'text'),
			'publish_date' => array('type' => 'timestamp'),

		));
	}

	public function down()
	{
		\DBUtil::drop_fields('feature', array(
			'body'
,			'publish_date'

		));
	}
}