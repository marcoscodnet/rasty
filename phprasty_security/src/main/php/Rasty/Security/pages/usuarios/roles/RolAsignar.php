<?php
namespace Rasty\Security\pages\usuarios\roles;

use Rasty\Security\pages\RastySecurityPage;

use Rasty\Security\service\UIServiceFactory;

use Rasty\utils\XTemplate;
use Cose\Security\model\User;
use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;

/**
 * Página para asignar roles a un usuario
 * 
 * @author bernardo
 * @since 21-01-2014
 *
 * @Rasty\security\annotations\Secured( permission='ASIGNAR ROL' )
 */
class RolAsignar extends RastySecurityPage{

	/**
	 * usuario a asignar roles.
	 * @var User
	 */
	private $usuario;

	
	public function __construct(){
		
		//inicializamos el rol.
		$usuario = new User();
		$this->setUsuario($usuario);
				
	}
	
	public function getMenuGroups(){

		//TODO construirlo a partir del rol 
		//y utilizando permisos
		
		$menuGroup = new MenuGroup();
		
		return array($menuGroup);
	}
	
	public function setUsuarioOid($oid){
		
		//a partir del id buscamos el rol a modificar.
		$usuario = UIServiceFactory::getUIUsuarioService()->get($oid);
		
		$this->setUsuario($usuario);
		
	}
	
	public function getTitle(){
		return $this->localize( "usuario.asignarRoles.title" );
	}

	public function getType(){
		
		return "RolAsignar";
		
	}	

	protected function parseXTemplate(XTemplate $xtpl){
		
	}
	

	public function getUsuario()
	{
	    return $this->usuario;
	}

	public function setUsuario($usuario)
	{
	    $this->usuario = $usuario;
	}
}
?>