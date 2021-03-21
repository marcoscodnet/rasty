<?php
namespace Rasty\Catalogo\actions\tiposDocumento;


use Rasty\Catalogo\service\UIServiceFactory;

use Rasty\Crud\actions\UpdateEntity;

/**
 * se realiza la actualización de un TipoDocumento.
 * 
 * @author bernardo
 * @since 26/08/2015
 */
class ModificarTipoDocumento extends UpdateEntity{

	protected function getFromPageName(){
		
		return "TipoDocumentoUpdate";
		
	}
	
	protected function getEntityService(){
		
		return UIServiceFactory::getUITipoDocumentoService();
			
	}
	
}
?>