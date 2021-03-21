<?php
namespace Rasty\Security\actions\permisos;

use Rasty\Security\components\form\permiso\PermisoForm;

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
 * se realiza la actualización de un Permiso.
 * 
 * @author Bernardo
 * @since 05/11/2014
 */
class ModificarPermiso extends Action{

	
	public function execute(){

		$forward = new Forward();
		
		$page = PageFactory::build("PermisoModificar");
		
		$permisoForm = $page->getComponentById("permisoForm");
			
		$oid = $permisoForm->getOid();
						
		try {

			//obtenemos el permiso.
			$permiso = UIServiceFactory::getUIPermisoService()->get($oid );
		
			//lo editamos con los datos del formulario.
			$permisoForm->fillEntity($permiso);
			
			//guardamos los cambios.
			UIServiceFactory::getUIPermisoService()->update( $permiso );
			
			$forward->setPageName( $permisoForm->getBackToOnSuccess() );
			$forward->addParam( "permisoOid", $permiso->getOid() );
			
			$permisoForm->cleanSavedProperties();
			
		} catch (RastyException $e) {
		
			$forward->setPageName( "PermisoModificar" );
			$forward->addError( Locale::localize($e->getMessage())  );
			$forward->addParam("oid", $oid );
			
			//guardamos lo ingresado en el form.
			$permisoForm->save();
			
		}
		return $forward;
		
	}

}
?>