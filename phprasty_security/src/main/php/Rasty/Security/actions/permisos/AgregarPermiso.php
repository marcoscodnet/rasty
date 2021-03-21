<?php
namespace Rasty\Security\actions\permisos;


use Rasty\Security\components\form\permiso\PermisoForm;

use Rasty\Security\service\UIServiceFactory;
use Cose\Security\model\Permission;

use Rasty\actions\Action;
use Rasty\actions\Forward;
use Rasty\exception\RastyException;

use Rasty\security\RastySecurityContext;

use Rasty\i18n\Locale;
use Rasty\factory\PageFactory;
use Rasty\exception\RastyDuplicatedException;


/**
 * se realiza el alta de un Permiso.
 * 
 * @author Bernardo
 * @since 27/12/2014
 */
class AgregarPermiso extends Action{

	
	public function execute(){

		$forward = new Forward();

		$page = PageFactory::build("PermisoAgregar");
		
		$permisoForm = $page->getComponentById("permisoForm");
		
		try {

			//creamos un nuevo Permiso.
			$permiso = new Permission();
			
			//completados con los datos del formulario.
			$permisoForm->fillEntity($permiso);

			//agregamos el Permiso.
			UIServiceFactory::getUIPermisoService()->add( $permiso );
			
			$forward->setPageName( $permisoForm->getBackToOnSuccess() );
			$forward->addParam( "permisoOid", $permiso->getOid() );			
		
			$permisoForm->cleanSavedProperties();
			
		
		} catch (RastyException $e) {
		
			$forward->setPageName( "PermisoAgregar" );
			$forward->addError( Locale::localize($e->getMessage())  );
			
			//guardamos lo ingresado en el form.
			$permisoForm->save();
		}
		
		return $forward;
		
	}

}
?>