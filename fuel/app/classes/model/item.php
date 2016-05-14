<?php

/**
 * @brief Itemデータモデル
 * 
 * 画像データのモデル。マイレコと関連付けて表示させる。
 * 
 */
class Model_Item extends MyOrm {

	protected static $_height = 540; /* !< 画像の高さ */
	protected static $_width = 540; /* !< 画像の幅 */
	protected static $_table_name = 'item';
	protected static $_primary_key = array('id');
	protected static $_properties = array(
		'dir', /* !< データのパス */
		'name', /* !< Itemデータの名前 */
		'extension', /* !< 拡張子 */
		'height', /* !< 画像の高さ */
		'width', /* !< 画像の横幅 */
		'created_at', /* !< 作成日時 */
		'updated_at', /* !< 更新日時 */
		'reproduced_by', /* !< 転記元URL */
		'price', /* !< 価格（あれば） */
		'service', /* !< 転記元サービス */
		'id'
	);

	// リレーション1対1…画像:マイレコ
	protected static $_belongs_to = array(
		'myreco' => array(
			'model_to' => 'Model_myreco',
			'key_from' => 'id',
			'key_to' => 'item_id',
			'cascade_save' => true,
			'cascade_delete' => false,
		),
	);

	/**
	 * @brief 画像のURLをサーバに保存し、ハッシュ値名で書き換える関数
	 * 
	 * 画像URLとファイル名ハッシュ化、フォルダ生成など。
	 * 
	 * @param type $itemDTO
	 * @return DTO_Item
	 */
	private static function storeImg(DTO_Item $itemDTO) {
		$updir = DOCROOT . "assets/img/" . $itemDTO->getService();

		$md5 = md5_file($itemDTO->getDir());
		// 第一ディレクトリ
		$dir1 = substr($md5, 0, 2);
		// 第二ディレクトリ
		$dir2 = substr($md5, 2, 2);
		$dir3 = $dir1 . "/" . $dir2;
		$updir = $updir . "/" . $dir3;

		// 格納先のフォルダが存在しなければ、フォルダを作成
		if (!is_dir($updir)) {
			mkdir($updir, 0755, true);
		}

		$upfile_name = $updir . "/" . $md5 . ".".$itemDTO->getExtension();
		copy($itemDTO->getDir(), $upfile_name);
		chmod($upfile_name, 0755);

		$itemDTO->setName($md5.".".$itemDTO->getExtension());
		$itemDTO->setDir($dir3);
		
		return $itemDTO;
	}

	/**
	 * 
	 * @brief Itemデータの追加
	 * 
	 * 画像などのItemデータをマイレコに関連付ける
	 * 
	 * @param type $item_data
	 */
	public static function add(DTO_Item $itemDTO) {
		$res_item = new DTO_Item();
		$sizes = Image::sizes($itemDTO->getDir());
		$itemDTO->setHeight($sizes->height);
		$itemDTO->setWidth($sizes->width);
		$info = pathinfo($itemDTO->getDir());
		$itemDTO->setExtension($info['extension']);

		$res_item = self::storeImg($itemDTO);
		
		$self = self::forge(array(
			'dir' => $res_item->getDir(),
			'name' => preg_replace("/(.+)(\.[^.]+$)/", "$1", $res_item->getName()),
			'extension' => $res_item->getExtension(),
			'height' => $res_item->getHeight(),
			'width' => $res_item->getWidth(),
			'reproduced_by' => $res_item->getReproducedBy(),
			'price' => $res_item->getPrice(),
			'service' => $res_item->getService(),
		));
		
		$self->save();
		return $self;
	}

	/**
	 * 画像のパスを取得
	 * 画像を登録していなければ空文字を返す
	 * @param $images　画像情報
	 * @return String 画像のパス
	 */
	public static function imageShow($item_id, $setting = array()) {
		$item = self::find($item_id);

		$image_str = '';
		$default = array(
			"height" => "270",
			"width" => "270",
		);

		$setting = array_merge($default, $setting);

		$image_path = DOCROOT."assets/img/amazon/" . $item->dir . '/' . $item->name.'.'.$item->extension;
		if ($item && file_exists($image_path)) {
			$image_str .= '<a href="'.$item->reproduced_by.'" target="_blank">'.Asset::img("amazon/" . $item->dir . '/' . $item->name . '.'.$item->extension, $setting)."</a>";
		} else {
			$setting += array('class' => 'img-circle');
			$image_str = Asset::img("common/no_image.png", $setting);
		}

		return $image_str;
	}
	
	public static function getImagePath($item_id) {
		$item = self::find($item_id);
		$image_path = "";

		if ($item != null) {
			$image_path = Asset::get_file($item->name.'.'.$item->extension, 'img', 'amazon/'.$item->dir.'/');
		} else {
			$image_path = Asset::get_file('no_image.png', 'img', 'common/');
		}

		return $image_path;
	}
}
