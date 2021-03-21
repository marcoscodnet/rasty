<?php

namespace Rasty\Security\components\boxes\usuario;


use Rasty\Security\service\UIServiceFactory;

use Rasty\components\RastyComponent;
use Rasty\utils\RastyUtils;

use Rasty\utils\XTemplate;

use Cose\Security\model\User;

use Rasty\utils\LinkBuilder;

/**
 * Usuario.
 * 
 * @author Bernardo
 * @since 06-11-2014
 */
class UsuarioBox extends RastyComponent{
		
	private $usuario;
	
	public function getType(){
		
		return "UsuarioBox";
		
	}

	public function __construct(){
		
		
	}

	protected function parseLabels(XTemplate $xtpl){
		
		$xtpl->assign("lbl_username",  $this->localize( "usuario.username" ) );
		$xtpl->assign("lbl_name",  $this->localize( "usuario.name" ) );
		$xtpl->assign("lbl_email",  $this->localize( "usuario.email" ) );
		$xtpl->assign("lbl_usergroup",  $this->localize( "usuario.usergroup" ) );
		$xtpl->assign("lbl_loginFrom",  $this->localize( "usuario.loginFrom" ) );
		$xtpl->assign("lbl_lastLogin",  $this->localize( "usuario.lastLogin" ) );
		$xtpl->assign("lbl_logged",  $this->localize( "usuario.logged" ) );
		
	}
	
	protected function parseXTemplate(XTemplate $xtpl){
		
		/*labels*/
		$this->parseLabels($xtpl);
		
		$usuario = $this->getUsuario();
		
		if( !empty($usuario )){
			
			$xtpl->assign("username",  $usuario->getUsername() );
			$xtpl->assign("name",  $usuario->getName() );
			$xtpl->assign("email",  $usuario->getEmail() );
			//$xtpl->assign("lastLogin",  WalibaUIUtils::formatDateTimeToView( $usuario->getLastLogin() ));
			$xtpl->assign("loginFrom",  $usuario->getLoginFrom() );
			$xtpl->assign("logged",  $usuario->getLogged() );
			$groups = array();
			foreach ($usuario->getGroups() as $userGroup) {
				$groups[] = $userGroup->getName();
			}
			$xtpl->assign("userGroup",  implode(", ", $groups) );
		}
						
	}
	
	
	protected function initObserverEventType(){
		$this->addEventType( "Usuario" );
	}
	
	public function setUsuarioOid($oid){
		if( !empty($oid) ){
			$usuario = UIServiceFactory::getUIUsuarioService()->get($oid);
			$this->setUsuario($usuario);
		}
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