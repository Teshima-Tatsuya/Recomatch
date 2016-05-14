<?php

class Model_Question_Favorite_Question extends Model_Question_Favorite_Base {

	protected static $_table_name = 'favorite_question';
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
		$favorite = self::find('first', array(
				'where' => array(
					array('user_id', $user_id),
					array('question_id', $question_id),
				),
		));
		
		if(is_null($favorite)) {
			$favorite = new self();
			$favorite->user_id = $user_id;
			$favorite->question_id = $question_id;
			$favorite->question->favorite_num++;
			$favorite->save();
		}
		
		return $favorite;
	}
	
	public static function remove($question_id, $user_id) {
		$favorite = self::find('first', array(
				'where' => array(
					array('user_id', $user_id),
					array('question_id', $question_id),
				),
		));
		
		if(!is_null($favorite)) {
			$favorite->delete();

			$question = Model_Question_Question::find($question_id);
			$question->favorite_num--;
			$question->save();
		}
	}
}