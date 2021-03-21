<?php
namespace Rasty\Forms\uploadImage\actions;

use Rasty\actions\JsonAction;
use Rasty\utils\RastyUtils;
use Rasty\utils\ReflectionUtils;
use Rasty\exception\RastyException;

use Rasty\i18n\Locale;

/**
 * se hace el upload de una imágen por ajax.
 * 
 * @author Bernardo
 * @since 29/05/2014
 */
class UploadImageJson extends JsonAction{

	const MAX_WIDTH = 800;
	const MAX_HEIGHT = 600;
	
	public function execute(){

		$result = array();
		
		try {

			$uploadPath =  RastyUtils::getParamGET("uploadPath");
			
			$valid_formats = array("jpg","jpeg", "png", "gif", "bmp");

			$name = $_FILES['imgFile']['name'];
			$size = $_FILES['imgFile']['size'];
					
			if(strlen($name)){
				list($txt, $ext) = explode(".", $name);
				$ext = strtolower($ext);
				if(in_array($ext,$valid_formats) ){
					
					$tmp = $_FILES['imgFile']['tmp_name'];
					
					if(!$tmp){
						$result["error"] = Locale::localize("image.upload.fail");
						return $result;						
					}	
					
					$tmpImg = $this->createimg( $tmp, $ext );

					if(!$tmpImg){
						$result["error"] = Locale::localize("image.upload.fail");
						return $result;						
					}	
					
					$width = imagesx( $tmpImg );
					$height = imagesy( $tmpImg );
					
					//si es muy grande, la achico.
					if( $width > (self::MAX_WIDTH) || ($height > self::MAX_HEIGHT) ){
						$this->resize($tmp, $tmp, self::MAX_WIDTH, self::MAX_HEIGHT, 50);
					}
					
					//chequeamos si hay que crear el directorio de las imágenes
					if(!file_exists($uploadPath))
						mkdir ($uploadPath);
					
					$currentImageName = time().substr($txt, 5).".".$ext;
					
					if(move_uploaded_file($tmp, "$uploadPath/$currentImageName")){
						
						$result["imageName"] = $currentImageName;
						
							
					}else
						$result["error"] = Locale::localize("image.upload.fail");
					}
				else
					$result["error"] = Locale::localize("image.invalid.format");					
			}else
					$result["error"] = Locale::localize("image.empty");
			
			$result["info"] = Locale::localize("image.upload.success");
			
		} catch (RastyException $e) {
		
			$result["error"] = Locale::localize($e->getMessage())  ;
			
		}
		
		return $result;
		
	}
	
	function createimg( $tmp, $ext ){
		$tmpImg = null;
		if( in_array($ext, array("jpg", "jpeg"))  )
			$tmpImg = imagecreatefromjpeg($tmp);
			
		elseif( $ext == "png"  )
			$tmpImg = imagecreatefrompng($tmp);

		elseif( $ext == "gif"  )
			$tmpImg = imagecreatefromgif($tmp);
			
		elseif( $ext == "bmp"  )
			$tmpImg = imagecreatefromwbmp($tmp);

		return $tmpImg;
	}
	
	function resize($sourcefile, $endfile, $thumbwidth, $thumbheight, $quality){
		
		// Takes the sourcefile (path/to/image.jpg) and makes a thumbnail from it
		// and places it at endfile (path/to/thumb.jpg).
		
		// Load image and get image size.
		$img = imagecreatefromjpeg($sourcefile);
		$width = imagesx( $img );
		$height = imagesy( $img );
		
		if ($width > $height) {
		    $newwidth = $thumbwidth;
		    $divisor = $width / $thumbwidth;
		    $newheight = floor( $height / $divisor);
		}
		else {
		    $newheight = $thumbheight;
		    $divisor = $height / $thumbheight;
		    $newwidth = floor( $width / $divisor );
		}
		
		// Create a new temporary image.
		$tmpimg = imagecreatetruecolor( $newwidth, $newheight );
		
		// Copy and resize old image into new image.
		imagecopyresampled( $tmpimg, $img, 0, 0, 0, 0, $newwidth, $newheight, $width, $height );
		
		// Save thumbnail into a file.
		imagejpeg( $tmpimg, $endfile, $quality);
		
		// release the memory
		imagedestroy($tmpimg);
		imagedestroy($img);

	}
	
}
?>