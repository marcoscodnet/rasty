<?php
namespace Rasty\Security\actions\usuarios;

use Rasty\Security\components\form\usuario\CambiarClaveForm;

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
 * se realiza la solicitud de una nueva clave.
 * 
 * @author Bernardo
 * @since 20/01/2015
 */
class SolicitarNuevaClave extends Action{

	
	public function execute(){

		$forward = new Forward();
		
			
		try {

			//obtenemos el usuario.
			$username = RastyUtils::getParamPOST('username');
			
			if(empty($username))
				throw new RastyException("solicitarNuevaClave.usuario.invalid");
			
			
			//solicitamos una nueva clave.
			UIServiceFactory::getUIUsuarioService()->solicitarNuevaClave( $username );
			
			$forward->setPageName( "NuevaClaveSolicitarSuccess" );
			$forward->addParam( "username", $username );
			
		} catch (RastyException $e) {
		
			$forward->setPageName( "NuevaClaveSolicitar" );
			$forward->addError( Locale::localize($e->getMessage())  );
			
		}
		
		return $forward;
		
	}

}
?>