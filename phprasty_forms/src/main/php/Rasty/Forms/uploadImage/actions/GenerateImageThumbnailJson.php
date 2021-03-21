<?php
namespace Rasty\Forms\uploadImage\actions;

use Rasty\actions\JsonAction;
use Rasty\utils\RastyUtils;
use Rasty\utils\ReflectionUtils;
use Rasty\exception\RastyException;

use Rasty\i18n\Locale;

/**
 * se genera el thumbnail de la una imagen
 * 
 * 
 * @author Bernardo
 * @since 29/05/2014
 */
class GenerateImageThumbnailJson extends JsonAction{

	
	public function execute(){

		$result = array();
		
		try {

			$uploadPath = RastyUtils::getParamGET("uploadPath");
			$imageName = RastyUtils::getParamGET("imageName");
			
			$t_width = RastyUtils::getParamGET("maxWidth", 200);	// Maximum thumbnail width
			$t_height = RastyUtils::getParamGET("maxHeight", 200);;	// Maximum thumbnail height
			
			$width = RastyUtils::getParamGET("width");
			$height = RastyUtils::getParamGET("height");
			
			$x = RastyUtils::getParamGET("x");
			$y = RastyUtils::getParamGET("y");
			
			
			$thumbnailName = "thumbnail_$imageName"; // Thumbnail image name
						
			$ratio = ($t_width/$width); 
			$nw = ceil($width * $ratio);
			$nh = ceil($height * $ratio);
			$nimg = imagecreatetruecolor($nw,$nh);
			
			list($txt, $ext) = explode(".", $imageName);
			$ext = strtolower($ext);
				
			//$im_src = imagecreatefromjpeg($uploadPath.$imageName);
			$im_src = $this->createimg($uploadPath.$imageName, $ext);
			
			imagecopyresampled($nimg,$im_src,0,0,$x,$y,$nw,$nh,$width,$height);
			
			$this->createthumb($nimg, $uploadPath.$thumbnailName, $ext);
			
			$result["thumbnailName"] = $thumbnailName;
			$result["info"] = Locale::localize("image.thumbnail.success");
			
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
	
	function createthumb( $nombre, $filename, $ext ){
		
		if( in_array($ext, array("jpg", "jpeg"))  )
			imagejpeg($nombre,$filename,90);
			
		elseif( $ext == "png"  )
			imagepng($nombre,$filename,90);

		elseif( $ext == "gif"  )
			imagegif($nombre,$filename,90);
			
		elseif( $ext == "bmp"  )
			imagewbmp($nombre,$filename,90);

	}
}
?>