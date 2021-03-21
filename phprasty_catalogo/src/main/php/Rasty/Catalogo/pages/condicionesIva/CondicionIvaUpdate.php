<?php
namespace Rasty\Catalogo\pages\condicionesIva;


use Rasty\Catalogo\conf\RastyCatalogoConfig;

use Rasty\Catalogo\service\UIServiceFactory;

use Rasty\Crud\pages\entities\update\EntityUpdate;

use Cose\Catalogo\model\CondicionIva;

use Rasty\utils\LinkBuilder;

class CondicionIvaUpdate extends EntityUpdate{

	protected function getEntityService(){
		
		return UIServiceFactory::getUICondicionIvaService();
	}
	

	protected function getLegend(){
		return $this->localize("condicionIva.update");
	}
	
	protected function getFormAction(){
		
		return LinkBuilder::getActionUrl( "ModificarCondicionIva") ;
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
		
		$this->setEntity( new CondicionIva());
		
		
	}
	
		
	public function getTitle(){
		return $this->localize( "condicionIva.modificar.title" );
	}

}
?>