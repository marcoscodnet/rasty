<?php
namespace Rasty\Security\actions\roles;


use Rasty\Security\components\form\rol\RolForm;

use Rasty\Security\service\UIServiceFactory;
use Cose\Security\model\UserGroup;

use Rasty\actions\Action;
use Rasty\actions\Forward;
use Rasty\utils\RastyUtils;
use Rasty\exception\RastyException;

use Rasty\security\RastySecurityContext;

use Rasty\i18n\Locale;
use Rasty\factory\PageFactory;
use Rasty\exception\RastyDuplicatedException;


/**
 * se realiza el alta de un Rol.
 * 
 * @author Bernardo
 * @since 27/12/2014
 */
class AgregarRol extends Action{

	
	public function execute(){

		$forward = new Forward();

		$page = PageFactory::build("RolAgregar");
		
		$rolForm = $page->getComponentById("rolForm");
		
		try {

			//creamos un nuevo Rol.
			$rol = new UserGroup();
			
			//completados con los datos del formulario.
			$rolForm->fillEntity($rol);

			$rol->setLevel(1);
			
			//agregamos el Rol.
			UIServiceFactory::getUIRolService()->add( $rol );
			
			$forward->setPageName( $rolForm->getBackToOnSuccess() );
			$forward->addParam( "rolOid", $rol->getOid() );			
		
			$rolForm->cleanSavedProperties();
			
		
		} catch (RastyException $e) {
		
			$forward->setPageName( "RolAgregar" );
			$forward->addError( Locale::localize($e->getMessage())  );
			
			//guardamos lo ingresado en el form.
			$rolForm->save();
		}
		
		return $forward;
		
	}

}
?>