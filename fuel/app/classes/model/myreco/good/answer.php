<?php

class Model_Question_Good_Answer extends Model_Question_Good_Base {

	protected static $_table_name = 'good_answer';
	protected static $_primary_key = array('id');
	protected static $_properties = array(
		'user_id', /* お気に入りしたユーザID */
		'answer_id', /* お気に入りした回答ID */
		'created_at', /* 作成日時 */
		'updated_at', /* 更新日時 */
		'id', /* 回答自体のID */
	);

	protected static $_belongs_to = array(
		'answer' => array(
			'model_to' => 'Model_Question_Answer',
			'key_from' => 'answer_id',
			'key_to' => 'id',
			'cascade_save' => true,
			'cascade_delete' => false,
		)
	);

	public static function add($answer_id, $user_id) {
		$good = self::find('first', array(
				'where' => array(
					array('user_id', $user_id),
					array('answer_id', $answer_id),
				),
		));
		
		if(is_null($good)) {
			$good = new self();
			$good->user_id = $user_id;
			$good->answer_id = $answer_id;
			$good->answer->good_num++;
			$good->save();
		}
		
		return $good;
	}

	public static function remove($answer_id, $user_id) {
		$good = self::find('first', array(
				'where' => array(
					array('user_id', $user_id),
					array('answer_id', $answer_id),
				),
		));
		
		if(!is_null($good)) {
			$good->delete();

			$answer = Model_Question_Answer::find($answer_id);
			$answer->good_num--;
			$answer->save();
		}
	}
}