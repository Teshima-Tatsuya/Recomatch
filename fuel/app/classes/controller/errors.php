<?php

class Controller_Errors extends MyController {

	// HttpNotFoundExceptionの場合
	public function action_404() {
		Response::redirect("/", 'location', 301);
	}

	// HttpServerErrorExceptionの場合
	public function action_500() {
		// EMailパッケージを呼び出し
		Package::load('email');
		
		$from = 'recomatch@flinks.xsrv.jp';
		$to     = 'recomatch@flinks.xsrv.jp';
		$subject = 'システムエラー自動送信';
		$body = "システムエラーが発生しました。ログを確認して下さい";
				
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
	}	
}
