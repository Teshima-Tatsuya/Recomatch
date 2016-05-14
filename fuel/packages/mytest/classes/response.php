<?php
namespace Mytest;

class Response extends \Fuel\Core\Response
{
    /**
     * Override Fuel\Core\Response redirect method
     *
     * @param   string  $url     The url
     * @param   string  $method  The redirect method
     * @param   int     $code    The redirect status code
     *
     * @return  void
     */
    public static function redirect($url = '', $method = 'location', $code = 302)
    {
        $response = new static;
        $response->set_status($code);

        if (strpos($url, '://') === false)
        {
            $url = $url !== '' ? \Uri::create($url) : \Uri::base();
        }

        strpos($url, '*') !== false and $url = \Uri::segment_replace($url);

        if ($method == 'location')
        {
            $response->set_header('Location', $url);
        }
        elseif ($method == 'refresh')
        {
            $response->set_header('Refresh', '0;url='.$url);
        }
        else
        {
            return;
        }

        //テストではない場合はexitを実行
        if (\Fuel\Core\Fuel::$env != 'test')
        {
            $response->send(true);
            exit;
        }

    Response::$redirect_status = $code; //←ローカル変数の$codeをスタティックメンバに代入
    Response::$redirect_url = $url; //←ローカル変数の$urlをスタティックメンバに代入
        $response->send(true);
    }

    private static $redirect_status = null;// ← リダイレクト時のステータスコードを参照するためのメンバを追加
    private static $redirect_url =""; //← リダイレクト時のURLを参照するためのメンバを追加

    public static function get_redirect_status(){ //← リダイレクト時のステータスコードを参照するためのゲッター
      return Response::$redirect_status;
    }

    public static function get_redirect_url(){ //← リダイレクト時のURLを参照するためのゲッター
      return Response::$redirect_url;
    }
}