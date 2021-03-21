<?php
namespace Rasty\Security\actions\usuarios;


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
 * se asignan roles a un usuario.
 * 
 * @author Bernardo
 * @since 21/01/2015
 */
class AsignarRolesUsuario extends Action{

	
	public function execute(){

		$forward = new Forward();
		
		$page = PageFactory::build("RolAsignar");
		
		$usuarioRolesForm = $page->getComponentById("usuarioRolesForm");
			
		$oid = $usuarioRolesForm->getOid();
						
		try {

			//obtenemos el usuario.
			$usuario = UIServiceFactory::getUIUsuarioService()->get($oid );
		
			//lo editamos con los datos del formulario.
			$usuarioRolesForm->fillEntity($usuario);
			
			//guardamos los cambios.
			UIServiceFactory::getUIUsuarioService()->update( $usuario );
			
			$forward->setPageName( $usuarioRolesForm->getBackToOnSuccess() );
			$forward->addParam( "usuarioOid", $usuario->getOid() );
			
			$usuarioRolesForm->cleanSavedProperties();
			
		} catch (RastyException $e) {
		
			$forward->setPageName( "RolAsignar" );
			$forward->addError( Locale::localize($e->getMessage())  );
			$forward->addParam("oid", $oid );
			
			//guardamos lo ingresado en el form.
			$usuarioRolesForm->save();
			
		}
		return $forward;
		
	}

}
?>