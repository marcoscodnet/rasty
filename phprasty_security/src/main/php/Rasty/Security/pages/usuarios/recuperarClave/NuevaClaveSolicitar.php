<?php
namespace Rasty\Security\pages\usuarios\recuperarClave;

use Rasty\Security\pages\RastySecurityPage;

use Rasty\components\RastyPage;
use Rasty\utils\XTemplate;
use Rasty\utils\LinkBuilder;
/**
 * Página para solicitar una nueva clave.
 * 
 * @author Bernardo
 * @since 20/01/2015
 */
class NuevaClaveSolicitar extends RastySecurityPage{

	private $error;
	
	public function isSecure(){
		return false;
	}
	
	public function getTitle(){
		return $this->localize("solicitarNuevaClave.title");
	}

	public function getType(){
		
		return "NuevaClaveSolicitar";
		
	}	
	
	protected function parseXTemplate(XTemplate $xtpl){

		$xtpl->assign("legend", $this->localize( "solicitarNuevaClave.legend" ) );
		
		$xtpl->assign("action", LinkBuilder::getActionUrl( "SolicitarNuevaClave") );
	
		$xtpl->assign("lbl_username", $this->localize( "login.username" ) );
		$xtpl->assign("txt_ingrese_username", $this->localize( "login.ingrese_username" ) );
		
		$xtpl->assign("lbl_password", $this->localize( "login.password" ) );
		$xtpl->assign("txt_ingrese_password", $this->localize( "login.ingrese_password" ) );
		
		$xtpl->assign("txt_campos_obligatorios", $this->localize( "common.campos_obligatorios" ) );
		
		$xtpl->assign("btn_solicitar", $this->localize( "solicitarNuevaClave.submit" ) );
		
		$xtpl->assign("link_login", LinkBuilder::getPageUrl( "Login") );
		$xtpl->assign("lbl_login", $this->localize( "solicitarNuevaClave.login" ) );
		
		$xtpl->assign("link_registrarse", LinkBuilder::getPageUrl( "RegistracionAgregar") );
		$xtpl->assign("lbl_registrarse", $this->localize( "solicitarNuevaClave.registrarse" ) );
		
		
		//chequemos los errores.
		$forward = $this->getForward();
		
		if( $forward->hasError() ){
			
			$xtpl->assign("msg", $forward->getError() );
			//$xtpl->assign("msg",  );
			$xtpl->parse("main.msg_error" );
		}			
		
	}

	public function getError()
	{
	    return $this->error;
	}

	public function setError($error)
	{
	    $this->error = $error;
	}
}
?>