<?php

class Controller_Contact extends MyController {

	public function action_index() {
	}
	
	public function action_confirmation() {
		$val = Validation::forge();
		
		// メールアドレスのバリデーション
		$val->add('mailaddress', 'メールアドレス')
			->add_rule('required')
			->add_rule('valid_email');
		// お問い合せ内容のバリデーション
		$val->add('body', 'お問い合わせ内容')
			->add_rule('required');
		
		Session::set('mailaddress', Input::post('mailaddress'));
		Session::set('body', Input::post('body'));
		
		// バリデーション失敗
		// 前ページにエラー情報を表示
		if(!$val->run()) {
			Session::set_flash('errors', $val->error());
			Response::redirect("/contact/index");
		}
		
		$this->template->mailaddress = Input::post('mailaddress');
		$this->template->body = Input::post('body');
	}

	public function action_complete() {
	}
	
	public function action_add() {
		// EMailパッケージを呼び出し
		Package::load('email');
		
		$from = Session::get('mailaddress');
		$to     = 'recomatch@flinks.xsrv.jp';
		$subject = '問い合わせ';
		$body = Session::get('body');
		
		Session::delete("mailaddress");
		Session::delete("body");
		
		$email = Email::forge('jis');
		
		$email->from($from, $from);
		$email->to($to);
		$email->subject($subject);
		$email->body(mb_convert_encoding($body, 'jis'));
		
		try {
			$email->send();
		} catch (EmailValidationFailedException $e) {
			echo $e->toString();
		} catch (EmailSendingFailedException $e) {
			echo $e->toString();
		}
		
		Response::redirect("/contact/complete");
	}
}
