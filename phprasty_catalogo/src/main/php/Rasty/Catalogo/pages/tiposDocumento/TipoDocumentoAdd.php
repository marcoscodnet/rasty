<?php
namespace Rasty\Catalogo\pages\tiposDocumento;

use Rasty\Catalogo\conf\RastyCatalogoConfig;

use Rasty\Crud\pages\entities\add\EntityAdd;

use Cose\Catalogo\model\TipoDocumento;

use Rasty\utils\LinkBuilder;

class TipoDocumentoAdd extends EntityAdd{

	/**
	 * TipoDocumento a agregar.
	 * @var TipoDocumento
	 */
	private $tipoDocumento;

	protected function getLegend(){
		return $this->localize("tipoDocumento.add");
	}
	
	protected function getFormAction(){
		
		return LinkBuilder::getActionUrl( "AgregarTipoDocumento") ;
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
		
		$this->setEntity(new TipoDocumento());
		
		
	}
	
	public function getTitle(){
		return $this->localize( "tipoDocumento.agregar.title" );
	}

}
?>