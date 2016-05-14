<?php

class DTO_Item{
    		private $dir;  /*!< データのパス */
		private $name;  /*!< Itemデータの名前 */
		private $extension;  /*!< データの拡張子 */
		private $height;  /*!< 画像の高さ */
		private $width;  /*!< 画像の横幅 */
		private $created_at;  /*!< 作成日時 */
		private $updated_at;  /*!< 更新日時 */
		private $reproduced_by;  /*!< 転記元URL */
		private $price;  /*!< 価格（あれば） */
		private $service;  /*!< 転記元サービス */
		private $id;
                
                /**
                 * dirのsetter
                 * 
                 * @param type $dir
                 */
                public function setDir($dir) {
                    $this->dir = $dir;
                }

                /**
                 * nameのsetter
                 * 
                 * @param type $name
                 */
                public function setName($name) {
                    $this->name = $name;
                }

                /**
                 * 
                 * extensionのsetter
                 * 
                 * @param type $extension
                 */
                public function setExtension($extension) {
                    $this->extension = $extension;
                }

                /**
                 * 
                 * heightのsetter
                 * @param type $height
                 */
                public function setHeight($height) {
                    $this->height = $height;
                }

                /**
                 * 
                 * widthのsetter
                 * 
                 * @param type $width
                 */
                public function setWidth($width) {
                    $this->width = $width;
                }

                /**
                 * 
                 * created_atのsetter
                 * @param type $created_at
                 */
                public function setCreatedAt($created_at) {
                    $this->created_at = $created_at;
                }

                /**
                 * 
                 * update_atのsetter
                 * @param type $updated_at
                 */
                public function setUpdatedAt($updated_at) {
                    $this->updated_at = $updated_at;
                }
                /**
                 * 
                 * reproduced_byのsetter
                 * 
                 * @param type $reproduced_by
                 */
                public function setReproducedBy($reproduced_by) {
                    $this->reproduced_by = $reproduced_by;
                }

                /**
                 * 
                 * priceのsetter
                 * 
                 * @param type $price
                 */
                public function setPrice($price) {
                    $this->price = $price;
                }

                public function setService($service) {
                    $this->service = $service;
                }

                public function setId($id) {
                    $this->id = $id;
                }

                public function getDir() {
                    return $this->dir;
                }

                public function getName() {
                    return $this->name;
                }

                public function getExtension() {
                    return $this->extension;
                }

                public function getHeight() {
                    return $this->height;
                }

                public function getWidth() {
                    return $this->width;
                }

                public function getCreatedAt() {
                    return $this->created_at;
                }

                public function getUpdatedAt() {
                    return $this->updated_at;
                }

                public function getReproducedBy() {
                    return $this->reproduced_by;
                }

                public function getPrice() {
                    return $this->price;
                }

                public function getService() {
                    return $this->service;
                }

                public function getId() {
                    return $this->id;
                }


}
