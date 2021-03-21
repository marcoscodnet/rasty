<?php

namespace Rasty\security;

use Rasty\components\RastyComponent;
use Rasty\actions\Action;

use Rasty\exception\UserRequiredException;
use Rasty\exception\UserPermissionException;

use Rasty\components\RastyPage;
use Rasty\exception\RastyException;
use Rasty\i18n\Locale;
use Rasty\utils\Logger;

use Cose\Security\exception\InvalidPasswordException;
use Cose\Security\exception\UserNotFoundException;
use Cose\Security\service\SecurityContext;

use Cose\exception\ServiceException;

use Addendum\ReflectionAnnotatedClass;
use Addendum\ReflectionAnnotatedMethod;

/**
 * Contexto de seguridad para la app.
 * 
 * @author bernardo
 * @since 06/08/2013
 * 
 */


class RastySecurityContext {
	
	static function getUser() {
		$securityContext =  SecurityContext::getInstance();
		return $securityContext->getUser();
	}
	
	/**
	 * determina si se puede consultar la página dada.
	 * @param RastyPage $page página a consultar.
	 * @return boolean
	 */
	static function authorize( RastyPage $page ) {

		//Logger::log("autorizando page " . $page->getType(), __CLASS__);
		
		if( !$page->isSecure() )
			return true;
		
		$securityContext =  SecurityContext::getInstance();
		$user = $securityContext->getUser();
		
		if( $user == null )
			throw new UserRequiredException();

			
		//Logger::logObject($user, __CLASS__);
			
		//chequeamos los permisos sobre la página.
		$permission = self::getPermission($page);
		//Logger::log("permiso $permission", __CLASS__);
		//chequeando permiso
		if(!empty($permission)){
			$authorize = $securityContext->checkPermissionByName($permission);
			//Logger::logObject($authorize, __CLASS__);
			if(!$authorize)
				throw new UserPermissionException();
		}else{
			
			//Logger::log("no hay restricciones ", __CLASS__ );
		}
		
	}

	/**
	 * determina si se puede consultar el component dado.
	 * @param RastyComponent $component componente a consultar.
	 * @return boolean
	 */
	static function authorizeComponent( RastyComponent $component ) {

		if( !$component->isSecure() )
			return true;
		
		$securityContext =  SecurityContext::getInstance();
		$user = $securityContext->getUser();
					
		if( $user == null )
			throw new UserRequiredException();

		//chequeamos los permisos sobre el componente.
		$permission = self::getPermission($component);
		
		//chequeando permiso
		if(!empty($permission)){
			$authorize = $securityContext->checkPermissionByName($permission);
			if(!$authorize)
				throw new UserPermissionException();
		}
		
			
	}
	
	/* 
	 *  se obtiene el permiso para ejecutar un abstract component
	 *  null si no tiene permiso asociado.
	 */
	private static function getPermission($component){

		$permission = null;
		
		$reflectionClass = new ReflectionAnnotatedClass(get_class($component));
		
		//Logger::logObject($reflectionClass, __CLASS__);
		
		if( $reflectionClass->hasAnnotation("Rasty\security\annotations\Secured") ){
				
			//obtenemos el annotation y vemos si se requiere un permiso.
			$secured = $reflectionClass->getAnnotation("Secured");
			$permission = $secured->permission;

			//Logger::logObject($permission, __CLASS__);
		}
		
		return $permission;
	}
	
	/**
	 * se loguea el usuario en el contexto de seguridad
	 * @param $username nombre de usuario
	 * @param $password clave
	 * @throws RastyException
	 */
	static function login( $username, $password ){
		
		try {

			$securityContext =  SecurityContext::getInstance();
			
			$securityContext->login( $username, $password );
			
			
		} catch (UserNotFoundException $e) {
		
			throw new RastyException(Locale::localize("login.user_not_found"));
			
		} catch (InvalidPasswordException $e) {
		
			throw new RastyException(Locale::localize("login.invalid_password"));
			
		} catch (ServiceException $e) {
			
			throw new RastyException($e->getMessage());
		}		
		
	}

	/**
	 * se desloguea el usuario en el contexto de seguridad
	 * @throws RastyException
	 */
	static function logout(){
		
		try {

			$securityContext =  SecurityContext::getInstance();
			$securityContext->logout();
			session_destroy();
			
		} catch (ServiceException $e) {
			
			throw new RastyException($e->getMessage());
		}		
		
	}
	

	/**
	 * determina si se puede ejecutar el action dado.
	 * @param Action $action acción a ejecutar.
	 * @return boolean
	 */
	static function authorizeAction( Action $action ) {

		//Logger::log("autorizando action " . get_class($action), __CLASS__);
		
		if( !$action->isSecure() ){
			return true;
		}
		
		$securityContext =  SecurityContext::getInstance();
		$user = $securityContext->getUser();
		
		if( $user == null )
			throw new UserRequiredException();

			
		//Logger::logObject($user, __CLASS__);
			
		//chequeamos los permisos sobre el action.
		$permission = self::getPermission($action);
		
		//chequeando permiso
		if(!empty($permission)){
			$authorize = $securityContext->checkPermissionByName($permission);
			
			if(!$authorize){
				throw new UserPermissionException();
			}
		}else{
			
			//Logger::log("no hay restricciones ", __CLASS__ );
		}
		
	}
	
}

?>