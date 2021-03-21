<?php
namespace Rasty\Security\actions\usuarios;


use Rasty\Security\components\form\usuario\UsuarioForm;

use Rasty\Security\service\UIServiceFactory;
use Cose\Security\model\User;

use Rasty\actions\Action;
use Rasty\actions\Forward;
use Rasty\utils\RastyUtils;
use Rasty\exception\RastyException;

use Rasty\security\RastySecurityContext;

use Rasty\i18n\Locale;
use Rasty\factory\PageFactory;
use Rasty\exception\RastyDuplicatedException;


/**
 * se realiza el alta de una Usuario.
 * 
 * @author Bernardo
 * @since 05/11/2014
 */
class AgregarUsuario extends Action{

	
	public function execute(){

		$forward = new Forward();

		$page = PageFactory::build("UsuarioAgregar");
		
		$usuarioForm = $page->getComponentById("usuarioForm");
		
		try {

			//creamos un nuevo Usuario.
			$usuario = new User();
			
			//completados con los datos del formulario.
			$usuarioForm->fillEntity($usuario);

			//validamos el ingreso de la clave repetida.
			//hacerlo con js
			$password2 = $usuarioForm->getPasswordRepeat();
			if( $password2 != $usuario->getPassword() ){
				$usuarioForm->save();
				throw new RastyException("usuario.password.repeat.invalid");
			}
			
			$usuario->setLogged(false);
			
			//agregamos el Usuario.
			UIServiceFactory::getUIUsuarioService()->add( $usuario );
			
			$forward->setPageName( $usuarioForm->getBackToOnSuccess() );
			$forward->addParam( "usuarioOid", $usuario->getOid() );			
		
			$usuarioForm->cleanSavedProperties();
			
		
		} catch (RastyException $e) {
		
			$forward->setPageName( "UsuarioAgregar" );
			$forward->addError( Locale::localize($e->getMessage())  );
			
			//guardamos lo ingresado en el form.
			$usuarioForm->save();
		}
		
		return $forward;
		
	}

}
?>