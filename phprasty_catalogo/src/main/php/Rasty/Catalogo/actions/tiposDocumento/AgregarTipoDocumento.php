<?php
namespace Rasty\Catalogo\actions\tiposDocumento;

use Rasty\Catalogo\service\UIServiceFactory;

use Rasty\Crud\actions\AddEntity;

use Cose\Catalogo\model\TipoDocumento;

/**
 * se realiza el alta de un TipoDocumento.
 * 
 * @author bernardo
 * @since 26/08/2015
 */
class AgregarTipoDocumento extends AddEntity {

	protected function getFromPageName(){
		return "TipoDocumentoAdd";
	}
	
	protected function getEntityInstance(){

		return new TipoDocumento();
	}
	
	protected function getEntityService(){
		
		return UIServiceFactory::getUITipoDocumentoService();
	}
	
}
?>