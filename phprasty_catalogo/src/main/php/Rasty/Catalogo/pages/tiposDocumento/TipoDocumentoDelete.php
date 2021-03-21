<?php
namespace Rasty\Catalogo\pages\tiposDocumento;

use Rasty\Catalogo\conf\RastyCatalogoConfig;

use Rasty\Catalogo\service\UIServiceFactory;

use Rasty\Crud\pages\entities\delete\EntityDelete;
use Cose\Catalogo\model\TipoDocumento;

use Rasty\utils\LinkBuilder;

class TipoDocumentoDelete extends EntityDelete{

	protected function getEntityService(){
		
		return UIServiceFactory::getUITipoDocumentoService();
	}
	

	protected function getLegend(){
		return $this->localize("tipoDocumento.delete");
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
	
	protected function getDeleteAction(){
		return "BorrarTipoDocumento";
	}
	
	public function getTitle(){
		return $this->localize( "tipoDocumento.eliminar.title" );
	}

	protected function getBoxTitle(){
		return $this->localize( "tipoDocumento.eliminar.title" );
	}
	
}
?>