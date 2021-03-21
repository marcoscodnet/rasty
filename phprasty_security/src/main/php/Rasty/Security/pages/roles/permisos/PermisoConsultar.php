<?php
namespace Rasty\Security\pages\roles\permisos;

use Rasty\Security\pages\RastySecurityPage;

use Rasty\Security\service\UIServiceFactory;

use Rasty\utils\XTemplate;
use Cose\Security\model\UserGroup;
use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;

use Rasty\utils\RastyUtils;

/**
 * Página para Consultar permisos de un rol
 *
 * @author bernardo
 * @since 01-02-2015
 *
 * @Rasty\security\annotations\Secured( permission='CONSULTAR PERMISOS' )
 */
class PermisoConsultar extends RastySecurityPage{

	/**
	 * rol a Consultar los permisos.
	 * @var Rol
	 */
	private $rol;


	public function __construct(){

		//inicializamos el rol.
		$rol = new UserGroup();
		$this->setRol($rol);

	}

	public function getMenuGroups(){

		//TODO construirlo a partir del rol
		//y utilizando permisos

		$menuGroup = new MenuGroup();

		$menuOption = new MenuOption();
		$menuOption->setLabel( $this->localize( "form.volver") );
		$menuOption->setPageName("Roles");
		$menuGroup->addMenuOption( $menuOption );


		$menuOption = new MenuOption();
		$menuOption->setLabel( $this->localize( "menu.roles.asignarPermisos") );
		$menuOption->setPageName( "PermisoAsignar" );
		$menuOption->addParam("oid",$this->getRol()->getOid());
		$menuOption->setIconClass( "icon-editar" );
		$menuGroup->addMenuOption( $menuOption );

		return array($menuGroup);
	}

	public function setRolOid($oid){

		//a partir del id buscamos el rol a modificar.
		$rol = UIServiceFactory::getUIRolService()->get($oid);

		$this->setRol($rol);

	}

	public function getTitle(){
		return $this->localize( "rol.consultarPermisos.title" );
	}

	public function getType(){

		return "PermisoConsultar";

	}

	protected function parseXTemplate(XTemplate $xtpl){

		$legend = $this->localize("rol.consultarPermisos.legend");
		$legend = RastyUtils::formatMessage($legend, array($this->getRol()->getName()));
		$xtpl->assign("legend", $legend );

		$permisos = $this->getRol()->getPermissions();
		foreach ($permisos as $permiso) {
			$xtpl->assign("permiso_oid", $permiso->getOid() );
			$xtpl->assign("permiso_name", $permiso->__toString() );

			$xtpl->parse("main.permiso" );
		}
	}

	public function getRol(){

	    return $this->rol;
	}

	public function setRol($rol)
	{
	    $this->rol = $rol;
	}
}
?>
