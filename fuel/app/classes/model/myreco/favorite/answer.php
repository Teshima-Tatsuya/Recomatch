<?php

class Model_Question_Favorite_Answer extends Model_Question_Favorite_Base {
	protected static $_table_name = 'favorite_answer';
	protected static $_primary_key = array('id');
	protected static $_properties = array(
		'user_id', /* お気に入りしたユーザID */
		'answer_id', /* お気に入りした質問ID */
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
		$favorite = self::find('first', array(
				'where' => array(
					array('user_id', $user_id),
					array('answer_id', $answer_id),
				),
		));
		
		if(is_null($favorite)) {
			$favorite = new self();
			$favorite->user_id = $user_id;
			$favorite->answer_id = $answer_id;
			$favorite->answer->favorite_num++;
			$favorite->save();

		}
		
		return $favorite;
	}

	public static function remove($answer_id, $user_id) {
		$favorite = self::find('first', array(
				'where' => array(
					array('user_id', $user_id),
					array('answer_id', $answer_id),
				),
		));
		
		if(!is_null($favorite)) {
			$favorite->delete();

			$question = Model_Question_Answer::find($answer_id);
			$question->favorite_num--;
			$question->save();
		}
	}	
}