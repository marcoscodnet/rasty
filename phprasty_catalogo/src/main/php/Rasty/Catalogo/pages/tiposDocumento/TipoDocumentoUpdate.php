<?php
namespace Rasty\Catalogo\pages\tiposDocumento;


use Rasty\Catalogo\conf\RastyCatalogoConfig;

use Rasty\Catalogo\service\UIServiceFactory;

use Rasty\Crud\pages\entities\update\EntityUpdate;

use Cose\Catalogo\model\TipoDocumento;

use Rasty\utils\LinkBuilder;

class TipoDocumentoUpdate extends EntityUpdate{

	protected function getEntityService(){
		
		return UIServiceFactory::getUITipoDocumentoService();
	}
	

	protected function getLegend(){
		return $this->localize("tipoDocumento.update");
	}
	
	protected function getFormAction(){
		
		return LinkBuilder::getActionUrl( "ModificarTipoDocumento") ;
	}
	
	protected function getBackTo(){
		return "TiposDocumento";
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
		
		$this->setEntity( new TipoDocumento());
		
		
	}
	
		
	public function getTitle(){
		return $this->localize( "tipoDocumento.modificar.title" );
	}

}
?>