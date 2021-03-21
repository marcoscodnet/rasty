<?php
namespace Rasty\Catalogo\pages\estadosCivil;


use Rasty\Catalogo\conf\RastyCatalogoConfig;

use Rasty\Catalogo\service\UIServiceFactory;

use Rasty\Crud\pages\entities\update\EntityUpdate;

use Cose\Catalogo\model\EstadoCivil;

use Rasty\utils\LinkBuilder;

class EstadoCivilUpdate extends EntityUpdate{

	protected function getEntityService(){
		
		return UIServiceFactory::getUIEstadoCivilService();
	}
	

	protected function getLegend(){
		return $this->localize("estadoCivil.update");
	}
	
	protected function getFormAction(){
		
		return LinkBuilder::getActionUrl( "ModificarEstadoCivil") ;
	}
	
	protected function getBackTo(){
		return "EstadosCivil";
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
		
		$this->setEntity( new EstadoCivil());
		
		
	}
	
		
	public function getTitle(){
		return $this->localize( "estadoCivil.modificar.title" );
	}

}
?>