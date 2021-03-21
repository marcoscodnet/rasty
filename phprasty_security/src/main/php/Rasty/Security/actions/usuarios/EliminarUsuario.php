<?php
namespace Rasty\Security\actions\usuarios;

use Rasty\Security\components\form\usuario\UsuarioForm;

use Rasty\Security\service\UIServiceFactory;

use Rasty\actions\Action;
use Rasty\actions\Forward;
use Rasty\utils\RastyUtils;
use Rasty\exception\RastyException;

use Rasty\security\RastySecurityContext;

use Rasty\factory\ComponentConfig;
use Rasty\factory\ComponentFactory;

use Rasty\i18n\Locale;

use Rasty\factory\PageFactory;

/**
 * se elimina un Usuario.
 * 
 * @author Bernardo
 * @since 22/01/2015
 */
class EliminarUsuario extends Action{

	
	public function execute(){

		$forward = new Forward();
		
		$oid = RastyUtils::getParamPOST("oid");			
						
		try {

			//eliminamos el usuario
			UIServiceFactory::getUIUsuarioService()->delete( $oid );
			
			$forward->setPageName( "Usuarios" );
			
			
		} catch (RastyException $e) {
		
			$forward->setPageName( "UsuarioEliminar" );
			$forward->addError( Locale::localize($e->getMessage())  );
			$forward->addParam("oid", $oid );
			
		}
		
		return $forward;
		
	}

}
?>