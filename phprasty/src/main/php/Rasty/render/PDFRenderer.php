<?php

namespace Rasty\render;

use Rasty\conf\RastyConfig;

use Rasty\components\AbstractComponent;
use Rasty\i18n\Locale;

$appPath = RastyConfig::getInstance()->getAppPath();
require_once( "$appPath/vendor/fpdf17/fpdf.php");

class PDFRenderer extends \FPDF implements IRenderer{

	const DESTINATION_DOWNLOAD = "D";
	const DESTINATION_VIEW = "I";
	
	const ORIENTATION_PORTRAIT = "P";
	const ORIENTATION_LANDSCAPE = "L";
	
	private $name='';
	private $destination = self::DESTINATION_DOWNLOAD;
	
	private $component;
	
	
	public function __construct($orientation=self::ORIENTATION_LANDSCAPE, $unit='mm', $size='A4'){
		
		parent::__construct($orientation, $unit, $size);
	}
	
	public function render(AbstractComponent $component){

		$this->setComponent($component);
		
		$this->AddPage("L");
		
		$this->renderContent($component);		
		
		$this->Output( $this->getName(). ".pdf", $this->getDestination() );
	}
	
	protected function renderContent(AbstractComponent $component){
		
	}
	

	public function getDestination()
	{
	    return $this->destination;
	}

	public function setDestination($destination)
	{
	    $this->destination = $destination;
	}
	

	public function getName()
	{
	    return $this->name;
	}

	public function setName($name)
	{
	    $this->name = $name;
	}
	
	public function localize($keyMessage, $encode=false){
		
		
		$msg = Locale::localize( $keyMessage );
		
		if($encode)
			$msg = $this->encodeCharactersPDF($msg);
			
		return $msg;
	}
	
	

	public function getComponent()
	{
	    return $this->component;
	}

	public function setComponent($component)
	{
	    $this->component = $component;
	}
	
	public function encodeCharactersPDF( $value ){

		return iconv("UTF-8", "ISO-8859-1", $value);
	}
}
?>