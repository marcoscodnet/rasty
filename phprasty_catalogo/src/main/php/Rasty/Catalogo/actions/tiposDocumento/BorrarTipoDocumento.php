<?php
namespace Rasty\Catalogo\actions\tiposDocumento;

use Rasty\Catalogo\service\UIServiceFactory;

use Rasty\Crud\actions\DeleteEntity;

/**
 * se realiza la eliminación de un TipoDocumento.
 * 
 * @author bernardo
 * @since 26/08/2015
 */
class BorrarTipoDocumento extends DeleteEntity{

	
	protected function getFromPageName(){
		
		return "TipoDocumentoUpdate";
		
	}
	
	protected function getToPageName(){
		
		return "TiposDocumento";
		
	}
	
	
	protected function getEntityService(){
		
		return UIServiceFactory::getUITipoDocumentoService();
			
	}
	
}
?>