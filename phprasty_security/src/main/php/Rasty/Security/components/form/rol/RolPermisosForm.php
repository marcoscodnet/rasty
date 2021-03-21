<?php

namespace Rasty\Security\components\form\rol;

use Rasty\Security\components\filter\model\UIRolCriteria;
use Rasty\Security\components\filter\model\UIPermisoCriteria;

use Rasty\Security\service\finder\RolFinder;

use Rasty\Security\service\UIServiceFactory;

use Rasty\Forms\form\Form;

use Rasty\components\RastyComponent;
use Rasty\utils\XTemplate;
use Rasty\utils\RastyUtils;

use Rasty\Security\Core\model\Rol;

use Rasty\utils\LinkBuilder;

use Rasty\utils\Logger;

/**
 * Formulario para asignar permisos a un rol

 * @author Bernardo
 * @since 21/01/2015
 */
class RolPermisosForm extends Form{



	/**
	 * label para el cancel
	 * @var string
	 */
	private $labelCancel;


	/**
	 *
	 * @var Rol
	 */
	private $rol;


	public function __construct(){

		parent::__construct();
		$this->setLabelCancel("form.cancelar");

		//$this->addProperty("name");

		$this->setBackToOnSuccess("Roles");
		$this->setBackToOnCancel("Roles");

	}

	public function getOid(){

		return $this->getComponentById("oid")->getPopulatedValue( $this->getMethod() );
	}

	public function fillEntity($entity){

		parent::fillEntity($entity);

		//agregamos los permisos.
		$permisos_oids = RastyUtils::getParamPOST('permisos') ;
		$permisos = array();
		foreach ($permisos_oids as $permisoOid) {
			$permisos[] = UIServiceFactory::getUIPermisoService()->get($permisoOid);

		}
		$entity->setPermissions($permisos);

	}

	public function getType(){

		return "RolPermisosForm";

	}

	protected function parseXTemplate(XTemplate $xtpl){

		parent::parseXTemplate($xtpl);


		$xtpl->assign("cancel", $this->getLinkCancel() );
		$xtpl->assign("lbl_cancel", $this->localize( $this->getLabelCancel() ) );

		$xtpl->assign("lbl_name", $this->localize("rol.name") );

		$legend = $this->localize("rol.asignarPermisos.legend");
        $legend = RastyUtils::formatMessage($legend, array($this->getRol()->getName()));
		$xtpl->assign("legend",  $legend  );

		//mostrar todos los permisos marcando los permisos asignados al rol.

		$uiCriteria = new UIPermisoCriteria();
		$permisos = UIServiceFactory::getUIPermisoService()->getList( $uiCriteria );



		foreach ($permisos as $permisoPadre) {

			if( $permisoPadre->getParent() == null ){

				$xtpl->assign("permiso_padre_oid", $permisoPadre->getOid() );
				$xtpl->assign("permiso_padre_name", $permisoPadre->__toString() );

				//buscamos los permisos hijos.
				$uiCriteria = new UIPermisoCriteria();
				$uiCriteria->setParent($permisoPadre);
				$permisosHijos = UIServiceFactory::getUIPermisoService()->getList( $uiCriteria );
				//$cantidadPermisosHijos = UIServiceFactory::getUIPermisoService()->getEntitiesCount( $uiCriteria );

				if(count($permisosHijos)>0){


					foreach ($permisosHijos as $permiso) {

						$xtpl->assign("permiso_oid", $permiso->getOid() );
						$xtpl->assign("permiso_name", $permiso->__toString() );

						if( $this->getRol()->hasPermissionByName($permiso->getName()) )
							$xtpl->assign ( 'checked', "checked" );
						else
							$xtpl->assign ( 'checked', "" );

						$xtpl->parse("main.permiso_padre.permiso" );

					}

					$xtpl->parse("main.permiso_padre" );

				}else{
					if( $this->getRol()->hasPermissionByName($permisoPadre->getName()) )
							$xtpl->assign ( 'padre_checked', "checked" );
					else
						$xtpl->assign ( 'padre_checked', "" );
					$xtpl->parse("main.permiso_padre_sinhijos" );
				}


			}


		}

	}


	public function getLabelCancel()
	{
	    return $this->labelCancel;
	}

	public function setLabelCancel($labelCancel)
	{
	    $this->labelCancel = $labelCancel;
	}

	public function getRol()
	{
	    return $this->rol;
	}

	public function setRol($rol)
	{
	    $this->rol = $rol;
	}

	public function getLinkCancel(){
		$params = array();

		return LinkBuilder::getPageUrl( $this->getBackToOnCancel() , $params) ;
	}

}
?>
