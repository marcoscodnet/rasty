<?php
namespace Rasty\Security\actions\roles;

use Rasty\Security\components\form\rol\RolForm;

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
 * se realiza la actualización de un Rol.
 * 
 * @author Bernardo
 * @since 05/11/2014
 */
class ModificarRol extends Action{

	
	public function execute(){

		$forward = new Forward();
		
		$page = PageFactory::build("RolModificar");
		
		$rolForm = $page->getComponentById("rolForm");
			
		$oid = $rolForm->getOid();
						
		try {

			//obtenemos el rol.
			$rol = UIServiceFactory::getUIRolService()->get($oid );
		
			//lo editamos con los datos del formulario.
			$rolForm->fillEntity($rol);
			
			//guardamos los cambios.
			UIServiceFactory::getUIRolService()->update( $rol );
			
			$forward->setPageName( $rolForm->getBackToOnSuccess() );
			$forward->addParam( "rolOid", $rol->getOid() );
			
			$rolForm->cleanSavedProperties();
			
		} catch (RastyException $e) {
		
			$forward->setPageName( "RolModificar" );
			$forward->addError( Locale::localize($e->getMessage())  );
			$forward->addParam("oid", $oid );
			
			//guardamos lo ingresado en el form.
			$rolForm->save();
			
		}
		return $forward;
		
	}

}
?>