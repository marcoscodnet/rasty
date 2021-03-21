<?php
namespace Rasty\Security\pages\permisos\modificar;

use Rasty\Security\pages\RastySecurityPage;

use Rasty\Security\service\UIServiceFactory;

use Rasty\utils\XTemplate;
use Cose\Security\model\User;
use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;

/**
 * Página para modificar permisos
 * 
 * @author Bernardo
 * @since 27/12/2014
 *
 * @Rasty\security\annotations\Secured( permission='MODIFICAR PERMISO' )
 */
class PermisoModificar extends RastySecurityPage{

	/**
	 * permiso a modificar.
	 * @var Permiso
	 */
	private $permiso;

	
	public function __construct(){
		
		//inicializamos el permiso.
		$permiso = new User();
		$this->setPermiso($permiso);
				
	}
	
	public function getMenuGroups(){

		//TODO construirlo a partir del permiso 
		//y utilizando permisos
		
		$menuGroup = new MenuGroup();
		
		return array($menuGroup);
	}
	
	public function setPermisoOid($oid){
		
		//a partir del id buscamos el permiso a modificar.
		$permiso = UIServiceFactory::getUIPermisoService()->get($oid);
		
		$this->setPermiso($permiso);
		
	}
	
	public function getTitle(){
		return $this->localize( "permiso.modificar.title" );
	}

	public function getType(){
		
		return "PermisoModificar";
		
	}	

	protected function parseXTemplate(XTemplate $xtpl){
		
	}

	public function getPermiso(){
		
	    return $this->permiso;
	}

	public function setPermiso($permiso)
	{
	    $this->permiso = $permiso;
	}
}
?>