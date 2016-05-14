<?php

class Model_Question_Good_Question extends Model_Question_Good_Base {

	protected static $_table_name = 'good_question';
	protected static $_primary_key = array('id');
	protected static $_properties = array(
		'user_id', /* お気に入りしたユーザID */
		'question_id', /* お気に入りした回答ID */
		'created_at', /* 作成日時 */
		'updated_at', /* 更新日時 */
		'id', /* 回答自体のID */
	);

	protected static $_belongs_to = array(
		'question' => array(
			'model_to' => 'Model_Question_Question',
			'key_from' => 'question_id',
			'key_to' => 'id',
			'cascade_save' => true,
			'cascade_delete' => false,
		)
	);

	public static function add($question_id, $user_id) {
		$good = self::find('first', array(
				'where' => array(
					array('user_id', $user_id),
					array('question_id', $question_id),
				),
		));
		
		if(is_null($good)) {
			$good = new self();
			$good->user_id = $user_id;
			$good->question_id = $question_id;
			$good->question->good_num++;
			$good->save();
		}
		
		return $good;
	}
	
	public static function remove($question_id, $user_id) {
		$good = self::find('first', array(
				'where' => array(
					array('user_id', $user_id),
					array('question_id', $question_id),
				),
		));
		
		if(!is_null($good)) {
			$good->delete();

			$question = Model_Question_Question::find($question_id);
			$question->good_num--;
			$question->save();
		}
	}
}