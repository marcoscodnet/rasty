<?php
namespace Rasty\Catalogo\pages\tiposDocumento;


use Rasty\Catalogo\conf\RastyCatalogoConfig;

use Rasty\Catalogo\service\UIServiceFactory;

use Rasty\Crud\pages\entities\view\EntityView;

use Cose\Catalogo\model\TipoDocumento;

class TipoDocumentoView extends EntityView{

	protected function getEntityService(){
		
		return UIServiceFactory::getUITipoDocumentoService();
	}
	

	protected function getLegend(){
		return $this->localize("tipoDocumento.view");
	}
	
	protected function getBackTo(){
		return "TiposDocumento";
	}
	
	protected function setEntityBox( $box, $entity ){
		
		$box->setCatalogo( $entity );
		
	}
	
	protected function getBoxType(){
		return "CatalogoBox";
	}	
		
	public function getLayoutType(){
		
		return RastyCatalogoConfig::getInstance()->getLayoutType();
	}
	
	public function __construct(){

		parent::__construct();
		
		$this->setEntity(new TipoDocumento());
		
		
	}
		
	public function getTitle(){
		return $this->localize( "tipoDocumento.consultar.title" );
	}

	protected function getBoxTitle(){
		return $this->localize( "tipoDocumento.consultar.title" );
	}
	
}
?>