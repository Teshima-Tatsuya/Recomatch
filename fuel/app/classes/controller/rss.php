<?php

class Controller_Rss extends MyController {

	public function action_index() {

		// rss_list サイトごと取得 20150308 start
		// RSSサイト一覧取得
		Config::load("rsslist", true);
		$rss_list = [];
		$rss_index = 0;
		$rss_list_config = Config::get('rsslist');
		/* サイトごとにRSS取得 */
		foreach ($rss_list_config as $i => $rss_config) {
			$rss = [];
			try {
				$rss = Cache::get('rss.' . $rss_config['template']);
			} catch (\CacheNotFoundException $e) {
				// キャッシュの有効期限切れならばキャッシュを削除
				if ($e instanceof \CacheExpiredException) {
					Cache::delete('rss.' . $rss_config['template']);
				}

				Profiler::mark("rsslistの取得処理開始");
				$rss = self::getRssSite($rss_config);
				Profiler::mark("rsslistの取得処理終了");

				// キャッシュに保存
				Cache::set('rss.' . $rss_config['template'], $rss, $rss_config['expire']);
			}
			// 複数のサイトのrssを一つの配列に纏める作業
			foreach($rss as $rss_unit) {
				$rss_list[$rss_index++] = $rss_unit;
			}
		}

		/* 最終的なRSSリストを最後に降順ソートし終了 20150308 end */
		Profiler::mark("unixtimestampの列取得");
		// unix_timestampの列取得
		foreach ($rss_list as $key => $row) {
			$timestamp[$key] = $row['unix_timestamp'];
		}

		Profiler::mark("UNIXタイムスタンプを用いたソート 降順");
		// UNIXタイムスタンプを用いたソート 降順
		array_multisort($timestamp, SORT_DESC, $rss_list);
		$this->template->rss_list = $rss_list;
	}

	public function action_edit() {
		
	}

	public function action_regist() {
		
	}

	public function action_category($category) {
		// RSSサイト一覧取得
		Config::load("rsslist", true);
		$rss_list = [];
		$rss_index = 0;
		$rss_list_config = Config::get('rsslist');
		/* サイトごとにRSS取得 */
		foreach ($rss_list_config as $i => $rss_config) {
			// カテゴリと一致する物以外はスルー
			if($rss_config['category'] != $category) continue;
			
			$rss = [];
			try {
				$rss = Cache::get('rss.' . $rss_config['template']);
			} catch (\CacheNotFoundException $e) {
				// キャッシュの有効期限切れならばキャッシュを削除
				if ($e instanceof \CacheExpiredException) {
					Cache::delete('rss.' . $rss_config['template']);
				}

				Profiler::mark("rsslistの取得処理開始");
				$rss = self::getRssSite($rss_config);
				Profiler::mark("rsslistの取得処理終了");

				// キャッシュに保存
				Cache::set('rss.' . $rss_config['template'], $rss, $rss_config['expire']);
			}
			// 複数のサイトのrssを一つの配列に纏める作業
			foreach($rss as $rss_unit) {
				$rss_list[$rss_index++] = $rss_unit;
			}
		}

		/* 最終的なRSSリストを最後に降順ソートし終了 20150308 end */
		Profiler::mark("unixtimestampの列取得");
		// unix_timestampの列取得
		$timestamp = [];
		foreach ($rss_list as $key => $row) {
			$timestamp[$key] = $row['unix_timestamp'];
		}

		Profiler::mark("UNIXタイムスタンプを用いたソート 降順");
		// UNIXタイムスタンプを用いたソート 降順
		array_multisort($timestamp, SORT_DESC, $rss_list);
		$this->template->rss_list = $rss_list;
	}

	/* siteごとにRSSを取得する用 20150308 濱田 */

	private static function getRssSite($site) {

		$rss_url = $site['url'];

		$rss = Util_Rss::parse($rss_url);

		Profiler::mark($site['template'] + "のforeach開始");

		// Profiler::mark("rsslistのforeach内部処理：".($i+1)."回目開始");
		// RSSのタイプによって、取得する属性を変更
		$items = array();
		if ($site['type'] == Util_Rss::RSS_2) {
			$items = $rss['channel']['item'];
		} else if ($site['type'] == Util_Rss::RSS_1) {
			$items = $rss['item'];
		} else if ($site['type'] == Util_Rss::RSS_ATOM) {
			$items = $rss['entry'];
		}

		// Profiler::mark("rsslistのforeach内部処理２：".($i+1)."回目開始");
		//　取得した情報から値を設定
		foreach ($items as $j => $item) {
			$item += ['template' => $site['template']];
			$item += ['date_format' => $site['date_format']];
			$item += ['unix_timestamp' => DateTime::createFromFormat($site['date_format'], $item[$site['date_attribute']])->getTimeStamp()];
			$rss_list[] = $item;
				if ($j == 5) break;
		}

		return $rss_list;
	}

	private static function getRssList() {



		Config::load("rsslist", true);
		$rss_list_config = Config::get('rsslist');

		$rss_urls = array();
		foreach ($rss_list_config as $rss_config) {
			$rss_urls[] = $rss_config['url'];
		}

		$rsses = Util_Rss::parseMulti($rss_urls);

		Profiler::mark("rsslistのforeach開始");
		foreach ($rss_list_config as $i => $rss_config) {
			Profiler::mark("rsslistのforeach内部処理：" . ($i + 1) . "回目開始");

			// RSSのタイプによって、取得する属性を変更
			$items = array();
			if ($rss_config['type'] == Util_Rss::RSS_2) {
				$items = $rsses[$i]['channel']['item'];
			} else if ($rss_config['type'] == Util_Rss::RSS_1) {
				$items = $rsses[$i]['item'];
			} else if ($rss_config['type'] == Util_Rss::RSS_ATOM) {
				$items = $rsses[$i]['entry'];
			}

			Profiler::mark("rsslistのforeach内部処理２：" . ($i + 1) . "回目開始");
			//　取得した情報から値を設定
			foreach ($items as $j => $item) {
				$item += ['template' => $rss_config['template']];
				$item += ['date_format' => $rss_config['date_format']];
				$item += ['unix_timestamp' => DateTime::createFromFormat($rss_config['date_format'], $item[$rss_config['date_attribute']])->getTimeStamp()];
				$rss_list[] = $item;
				if ($j == 5)
					break;
			}
		}

		Profiler::mark("unixtimestampの列取得");
		// unix_timestampの列取得
		foreach ($rss_list as $key => $row) {
			$timestamp[$key] = $row['unix_timestamp'];
		}
		Profiler::mark("UNIXタイムスタンプを用いたソート 降順");
		// UNIXタイムスタンプを用いたソート 降順
		array_multisort($timestamp, SORT_DESC, $rss_list);

		return $rss_list;
	}

	// DRYの規則に反しているので、後でリファクタリング
	private static function getRssListCategory($category) {
		Config::load("rsslist", true);
		$rss_list_config = Config::get('rsslist');

		$rss_urls = array();
		foreach ($rss_list_config as $rss_config) {
			$rss_urls[] = $rss_config['url'];
		}

		$rsses = Util_Rss::parseMulti($rss_urls);

		Profiler::mark("rsslistのforeach開始");
		foreach ($rss_list_config as $i => $rss_config) {
			Profiler::mark("rsslistのforeach内部処理：" . ($i + 1) . "回目開始");

			// RSSのタイプによって、取得する属性を変更
			$items = array();
			if ($rss_config['type'] == Util_Rss::RSS_2) {
				$items = $rsses[$i]['channel']['item'];
			} else if ($rss_config['type'] == Util_Rss::RSS_1) {
				$items = $rsses[$i]['item'];
			} else if ($rss_config['type'] == Util_Rss::RSS_ATOM) {
				$items = $rsses[$i]['entry'];
			}

			Profiler::mark("rsslistのforeach内部処理２：" . ($i + 1) . "回目開始");
			//　取得した情報から値を設定
			foreach ($items as $j => $item) {
				$item += ['template' => $rss_config['template']];
				$item += ['date_format' => $rss_config['date_format']];
				$item += ['unix_timestamp' => DateTime::createFromFormat($rss_config['date_format'], $item[$rss_config['date_attribute']])->getTimeStamp()];
				$rss_list[] = $item;
				if ($j == 5)
					break;
			}
		}

		Profiler::mark("unixtimestampの列取得");
		// unix_timestampの列取得
		foreach ($rss_list as $key => $row) {
			$timestamp[$key] = $row['unix_timestamp'];
		}
		Profiler::mark("UNIXタイムスタンプを用いたソート 降順");
		// UNIXタイムスタンプを用いたソート 降順
		array_multisort($timestamp, SORT_DESC, $rss_list);

		return $rss_list;
	}

}
