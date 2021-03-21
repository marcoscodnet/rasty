<?php
namespace Rasty\Catalogo\pages\condicionesIva;

use Rasty\Catalogo\conf\RastyCatalogoConfig;

use Rasty\Crud\pages\entities\add\EntityAdd;

use Cose\Catalogo\model\CondicionIva;

use Rasty\utils\LinkBuilder;

class CondicionIvaAdd extends EntityAdd{

	/**
	 * CondicionIva a agregar.
	 * @var CondicionIva
	 */
	private $condicionIva;

	protected function getLegend(){
		return $this->localize("condicionIva.add");
	}
	
	protected function getFormAction(){
		
		return LinkBuilder::getActionUrl( "AgregarCondicionIva") ;
	}
	
	protected function getBackTo(){
		return "CondicionesIva";
	}
	
	protected function setEntityForm( $form, $entity ){
		
		$form->setCatalogo( $entity );
	}
	
	protected function getFormType(){
		return "CatalogoForm";
	}	
		
	public function getLayoutType(){
		
		return RastyCatalogoConfig::getInstance()->getLayoutType();
	}
	
	public function __construct(){

		parent::__construct();
		
		$this->setEntity(new CondicionIva());
		
		
	}
	
	public function getTitle(){
		return $this->localize( "condicionIva.agregar.title" );
	}

}
?>