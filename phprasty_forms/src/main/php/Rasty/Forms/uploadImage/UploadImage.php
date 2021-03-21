<?php

namespace Rasty\Forms\uploadImage;

use Rasty\components\RastyComponent;
use Rasty\utils\RastyUtils;
use Rasty\utils\XTemplate;
use Rasty\utils\LinkBuilder;

/**
 * Componente para realizar el upload de una imagen.
 * Además permite definir el thumbnail de la imagen.
 * 
 * @author Bernardo
 * @since 29/05/2014
 * 
 */
class UploadImage extends RastyComponent{

	/**
	 * ancho con la cual se muestra la imagen
	 * @var unknown_type
	 */
	private $imageWidth;
	
	/**
	 * alto con la cual se muestra la imagen
	 * @var unknown_type
	 */
	private $imageHeight;
	
	/**
	 * ancho del thumbnail
	 * @var integer
	 */
	private $thumbnailWidth=100;
	
	/**
	 * alto del thumbnail
	 * @var integer
	 */
	private $thumbnailHeight=100;
	
	/**
	 * path donde se realizará el upload.
	 * @var string
	 */
	private $uploadPath;

	/**
	 * web path donde se realizará el upload para mostrar la imagen.
	 * @var string
	 */
	private $uploadWebPath;
	
	/**
	 * nombre de la imagen subida.
	 * @var string
	 */
	private $imageName;
	
	/**
	 * nombre del thumbnail generado.
	 * @var string
	 */
	private $thumbnailName;
	
	/**
	 * js callback al crear el thumbnail
	 * @var string
	 */
	private $thumbnailSuccessCallback;
	
	/**
	 * js callback al hacer el upload de la imagen
	 * @var string
	 */
	private $uploadSuccessCallback;
	
	private $legend;
	
	private $label;
	
		
	public function __construct(){
	
	}
	
	public function getType(){
		
		return "UploadImage";
		
	}
	
	protected function parseXTemplate(XTemplate $xtpl){

		$label = $this->getLabel();
		if(empty($label))
			$label = $this->localize("uploadImage.file");
			
		$legend = $this->getLegend();
		if(empty($legend))
			$legend = $this->localize("uploadImage.legend");
		
		$xtpl->assign( "id", $this->getId() );
		
		$xtpl->assign( "imageHeight", $this->getImageHeight() );
		$xtpl->assign( "imageWidth", $this->getImageWidth() );
		$xtpl->assign( "thumbHeight", $this->getThumbnailHeight() );
		$xtpl->assign( "thumbWidth", $this->getThumbnailWidth() );
		
		$xtpl->assign( "loading", $this->localize("uploadImage.loading"));
		$xtpl->assign( "legend", $legend );
		$xtpl->assign( "lbl_file", $label );
		$xtpl->assign( "lbl_upload", $this->localize("uploadImage.upload") );
		$xtpl->assign( "thumbnail_msg", $this->localize("uploadImage.thumbnail_msg")); //Recorte la imagen para generar el thumbnail
		$xtpl->assign( "lbl_thumbnail", $this->localize("uploadImage.thumbnail"));
		
		$xtpl->assign( "uploadWebPath", $this->getUploadWebPath());
		$xtpl->assign( "uploadPath", $this->getUploadPath());
		$xtpl->assign( "uploadSuccessCallback", $this->getUploadSuccessCallback());
		$xtpl->assign( "thumbnailSuccessCallback", $this->getThumbnailSuccessCallback());
		
		$params = array("uploadPath" => $this->getUploadPath());

		$xtpl->assign( "linkUploadImage", LinkBuilder::getActionAjaxUrl( "UploadImage", $params) );

		$xtpl->assign( "linkGenerateImageThumbnail", LinkBuilder::getActionAjaxUrl( "GenerateImageThumbnail") );
		
		if( $this->getThumbnailWidth() > 0 ){
			$xtpl->parse( "main.generateThumbnail");
			$xtpl->parse( "main.thumbnail_title");
			$xtpl->parse( "main.thumbnail");
		}
	}
	

	public function getThumbnailWidth()
	{
	    return $this->thumbnailWidth;
	}

	public function setThumbnailWidth($thumbnailWidth)
	{
	    $this->thumbnailWidth = $thumbnailWidth;
	}

	public function getThumbnailHeight()
	{
	    return $this->thumbnailHeight;
	}

	public function setThumbnailHeight($thumbnailHeight)
	{
	    $this->thumbnailHeight = $thumbnailHeight;
	}

	public function getUploadPath()
	{
	    return $this->uploadPath;
	}

	public function setUploadPath($uploadPath)
	{
	    $this->uploadPath = $uploadPath;
	}

	public function getImageName()
	{
	    return $this->imageName;
	}

	public function setImageName($imageName)
	{
	    $this->imageName = $imageName;
	}

	public function getThumbnailName()
	{
	    return $this->thumbnailName;
	}

	public function setThumbnailName($thumbnailName)
	{
	    $this->thumbnailName = $thumbnailName;
	}

	public function getUploadWebPath()
	{
	    return $this->uploadWebPath;
	}

	public function setUploadWebPath($uploadWebPath)
	{
	    $this->uploadWebPath = $uploadWebPath;
	}

	public function getThumbnailSuccessCallback()
	{
	    return $this->thumbnailSuccessCallback;
	}

	public function setThumbnailSuccessCallback($thumbnailSuccessCallback)
	{
	    $this->thumbnailSuccessCallback = $thumbnailSuccessCallback;
	}

	public function getUploadSuccessCallback()
	{
	    return $this->uploadSuccessCallback;
	}

	public function setUploadSuccessCallback($uploadSuccessCallback)
	{
	    $this->uploadSuccessCallback = $uploadSuccessCallback;
	}

	public function getImageWidth()
	{
	    return $this->imageWidth;
	}

	public function setImageWidth($imageWidth)
	{
	    $this->imageWidth = $imageWidth;
	}

	public function getImageHeight()
	{
	    return $this->imageHeight;
	}

	public function setImageHeight($imageHeight)
	{
	    $this->imageHeight = $imageHeight;
	}

	public function getLegend()
	{
	    return $this->legend;
	}

	public function setLegend($legend)
	{
	    $this->legend = $legend;
	}


	public function getLabel()
	{
	    return $this->label;
	}

	public function setLabel($label)
	{
	    $this->label = $label;
	}
}
?>