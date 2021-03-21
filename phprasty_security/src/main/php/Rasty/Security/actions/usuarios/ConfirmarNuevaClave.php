<?php
namespace Rasty\Security\actions\usuarios;


use Rasty\Security\utils\Securimage;


use Rasty\Security\service\UIServiceFactory;

use Rasty\actions\Action;
use Rasty\actions\Forward;
use Rasty\utils\RastyUtils;
use Rasty\exception\RastyException;

use Rasty\security\RastySecurityContext;

use Rasty\i18n\Locale;
use Rasty\factory\PageFactory;
use Rasty\exception\RastyDuplicatedException;

use Cose\Security\model\NewPasswordRequest;

/**
 * se realiza la confirmación de un cambio
 * de clave.
 * 
 * @author Bernardo
 * @since 20/01/2015
 */
class ConfirmarNuevaClave extends Action{

	
	public function execute(){

		$forward = new Forward();

		$page = PageFactory::build("NuevaClaveConfirmar");
		
		$nuevaClaveConfirmarForm = $page->getComponentById("nuevaClaveConfirmarForm");
		
		try {

			
			//creamos una solicitud.
			$npr = new NewPasswordRequest();
			
			//completados con los datos del formulario.
			$nuevaClaveConfirmarForm->fillEntity($npr);

			//validamos el ingreso de la clave repetida.
			//hacerlo con js
			$clave1 = $nuevaClaveConfirmarForm->getNewPassword();
			$clave2 = $nuevaClaveConfirmarForm->getRepetirNewPassword();
			if( $clave2 != $clave1 ){
				$nuevaClaveConfirmarForm->save();
				throw new RastyException("nuevaClave.newPassword.repetir.invalid");
			}
			
			
			//validamos el captcha.
			$img = new Securimage();
			$valid = $img->check( $nuevaClaveConfirmarForm->getCaptcha() );
			if(!$valid)
				throw new RastyException("nuevaClave.captcha.invalido");
			
			
			//confirmamos la solicitud.
			UIServiceFactory::getUIUsuarioService()->confirmarCambioClave( $npr->getValidationCode(), $clave1 );
			
			$forward->setPageName( $nuevaClaveConfirmarForm->getBackToOnSuccess() );
			$forward->addParam( "code", $npr->getValidationCode() );			
		
			$nuevaClaveConfirmarForm->cleanSavedProperties();
			
		
		} catch (RastyException $e) {
		
			$forward->setPageName( "NuevaClaveConfirmar" );
			if( $npr )
				$forward->addParam( "code", $npr->getValidationCode() );			
			$forward->addError( Locale::localize($e->getMessage())  );
			
			//guardamos lo ingresado en el form.
			$nuevaClaveConfirmarForm->save();
		}
		
		return $forward;
		
	}

}
?>