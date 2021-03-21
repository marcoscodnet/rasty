<?php
namespace Rasty\Security\pages;

use Rasty\Security\conf\RastySecurityConfig;

use Rasty\components\RastyPage;
use Rasty\actions\Forward;
use Rasty\utils\LinkBuilder;


/**
 * página genérica para la app de Rasty\Security
 * 
 * @author Bernardo
 * @since 05/11/2014
 */
abstract class RastySecurityPage extends RastyPage{

	private $mensajeError;

	public function getRastySecurityLayout(){
		
		return "TurnosMetroLayout";// RastySecurityConfig::getInstance()->getLayout();
		
	}
	
	public function getRastySecurityPublicLayout(){
		
		return RastySecurityConfig::getInstance()->getPublicLayout();
		
	}
	
	public function errorNoEsperado( $mensaje="", $pageName="ErrorNoEsperado" ){
		
		$forward = new Forward();
		$forward->setPageName( $pageName );
		$forward->addError( $mensaje );
		$forward->addParam("layout", $this->getLayoutType() );
				
		header ( 'Location: '.  $forward->buildForwardUrl() );
	}
	
	public function getTitle(){
		return $this->localize( "app.title" );
	}

	public function getMenuGroups(){

		return array();
	}


	
	public function getMensajeError()
	{
	    return $this->mensajeError;
	}

	public function setMensajeError($mensajeError)
	{
	    $this->mensajeError = $mensajeError;
	}

		public function getLinkUsuarios(){
		
		return LinkBuilder::getPageUrl( "Usuarios") ;
		
	}

	public function getLinkUsuarioAgregar(){
		
		return LinkBuilder::getPageUrl( "UsuarioAgregar") ;
		
	}
	
	public function getLinkActionAgregarUsuario(){
		
		return LinkBuilder::getActionUrl( "AgregarUsuario") ;
		
	}

	public function getLinkActionModificarUsuario(){
		
		return LinkBuilder::getActionUrl( "ModificarUsuario") ;
		
	}

	
	
	public function getLinkRoles(){
		
		return LinkBuilder::getPageUrl( "Roles") ;
		
	}

	public function getLinkRolAgregar(){
		
		return LinkBuilder::getPageUrl( "RolAgregar") ;
		
	}
	
	public function getLinkActionAgregarRol(){
		
		return LinkBuilder::getActionUrl( "AgregarRol") ;
		
	}

	public function getLinkActionModificarRol(){
		
		return LinkBuilder::getActionUrl( "ModificarRol") ;
		
	}

	
	
	public function getLinkPermisos(){
		
		return LinkBuilder::getPageUrl( "Permisos") ;
		
	}

	public function getLinkPermisoAgregar(){
		
		return LinkBuilder::getPageUrl( "PermisoAgregar") ;
		
	}
	
	public function getLinkActionAgregarPermiso(){
		
		return LinkBuilder::getActionUrl( "AgregarPermiso") ;
		
	}

	public function getLinkActionModificarPermiso(){
		
		return LinkBuilder::getActionUrl( "ModificarPermiso") ;
		
	}

	
	public function getLinkModificarClave(){
		
		return LinkBuilder::getPageUrl( "ClaveModificar") ;
		
	}
	
	public function getLinkActionModificarClave(){
		
		return LinkBuilder::getActionUrl( "ModificarClave") ;
		
	}

	
	public function getLinkActionConfirmarNuevaClave(){

		return LinkBuilder::getActionUrl( "ConfirmarNuevaClave") ;
		
	}
	
	public function getLinkActionAsignarPermisosRol(){

		return LinkBuilder::getActionUrl( "AsignarPermisosRol") ;
		
	}
	
	public function getLinkActionAsignarRolesUsuario(){

		return LinkBuilder::getActionUrl( "AsignarRolesUsuario") ;
		
	}
			
	public function getLinkActionEliminarUsuario(){

		return LinkBuilder::getActionUrl( "EliminarUsuario") ;
		
	}

	
}
?>