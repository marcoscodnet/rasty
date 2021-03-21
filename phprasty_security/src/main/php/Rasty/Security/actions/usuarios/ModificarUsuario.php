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
 * se realiza la actualización de un Usuario.
 * 
 * @author Bernardo
 * @since 05/11/2014
 */
class ModificarUsuario extends Action{

	
	public function execute(){

		$forward = new Forward();
		
		$page = PageFactory::build("UsuarioModificar");
		
		$usuarioForm = $page->getComponentById("usuarioForm");
			
		$oid = $usuarioForm->getOid();
						
		try {

			//obtenemos el usuario.
			$usuario = UIServiceFactory::getUIUsuarioService()->get($oid );
			$usuario->decrypt();
		
			//lo editamos con los datos del formulario.
			$usuarioForm->fillEntity($usuario);
			$usuario->encrypt();
			
			//guardamos los cambios.
			UIServiceFactory::getUIUsuarioService()->update( $usuario );
			
			$forward->setPageName( $usuarioForm->getBackToOnSuccess() );
			$forward->addParam( "usuarioOid", $usuario->getOid() );
			
			$usuarioForm->cleanSavedProperties();
			
		} catch (RastyException $e) {
		
			$forward->setPageName( "UsuarioModificar" );
			$forward->addError( Locale::localize($e->getMessage())  );
			$forward->addParam("oid", $oid );
			
			//guardamos lo ingresado en el form.
			$usuarioForm->save();
			
		}
		return $forward;
		
	}

}
?>