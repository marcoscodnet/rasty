<?php

namespace Rasty\Security\service;


/**
 * Factory de servicios de UI
 *  
 * @author Bernardo
 * @since 05/11/2014
 *
 */

class UIServiceFactory {

		
	/**
	 * @return UIPermisoService
	 */
	public static function getUIPermisoService(){
	
		return UIPermisoService::getInstance();	
	}

	/**
	 * @return UIRolService
	 */
	public static function getUIRolService(){
	
		return UIRolService::getInstance();	
	}
	
	/**
	 * @return UIUsuarioService
	 */
	public static function getUIUsuarioService(){
	
		return UIUsuarioService::getInstance();	
	}
	

}