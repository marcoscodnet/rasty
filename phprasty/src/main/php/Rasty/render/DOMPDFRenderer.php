<?php

namespace Rasty\render;

use Rasty\conf\RastyConfig;

use Rasty\components\AbstractComponent;
use Rasty\i18n\Locale;

use Dompdf\Dompdf;

$appPath = RastyConfig::getInstance()->getAppPath();

	
class DOMPDFRenderer implements IRenderer{

	private $component;

	private $name;
	
	public function __construct($name="documento"){
		
		$this->setName($name);
	}
	
	public function render(AbstractComponent $component){

		$this->setComponent($component);
		
		$html = $this->renderContent($component);
		
		//generate some PDFs!
		$dompdf = new Dompdf();
		$dompdf->load_html($html);
		$dompdf->render();
		$dompdf->stream( $this->getName(). ".pdf" , array("Attachment"=>0));

		//echo $html;		
	}
	
	protected function renderContent(AbstractComponent $component){
		return $component->render();
	}
	


	public function getName()
	{
	    return $this->name;
	}

	public function setName($name)
	{
	    $this->name = $name;
	}
	
	public function getComponent()
	{
	    return $this->component;
	}

	public function setComponent($component)
	{
	    $this->component = $component;
	}
	
}
?>