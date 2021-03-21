<?php
namespace Rasty\Geo\utils;


use Rasty\utils\RastyUtils;
use Rasty\utils\Logger;
use Rasty\exception\UserRequiredException;
use Rasty\exception\UserPermissionException;

use Rasty\i18n\Locale;
use Rasty\conf\RastyConfig;

use Rasty\security\RastySecurityContext;

use Rasty\Menu\menu\model\MenuOption;
use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuActionOption;
use Rasty\Menu\menu\model\MenuActionAjaxOption;

use Rasty\factory\PageFactory;



/**
 * Utilidades para RastyGeo
 *
 * @author Bernardo
 * @since 20-08-2015
 */
class RastyGeoUtils {

	
	public static function getWebPath(){
	
		return RastyConfig::getInstance()->getWebPath();
		
	}
	
	public static function getAppPath(){
	
		return RastyConfig::getInstance()->getAppPath();
		
	}
	
	
	public static function localize($keyMessage){
	
		return Locale::localize( $keyMessage );
	}
	
	
	public static function formatMessage($msg, $params){
		
		if(!empty($params)){
			
			$count = count ( $params );
			$i=1;
			while ( $i <= $count ) {
				$param = $params [$i-1];
				
				$msg = str_replace('$'.$i, $param, $msg);
				
				$i ++;
			}
			
		}
		return $msg;
		
	
	}
	

    /**
     * @return true si hay un usuario logueado.
     */
    public static function isUserLogged() {
    	
    	$user = RastySecurityContext::getUser();
    	
    	$logueado =  ($user != null);
		
		return $logueado;
    }
    
    public static function getUserLogged(){
    
    	$user = RastySecurityContext::getUser();
			
		//$user = WalibaUtils::getUserByUsername($user->getUsername());
		return $user;
    }
    
	public static function log($msg, $clazz=__CLASS__){
    	Logger::log($msg, $clazz);
    }

    public static function logObject($obj, $clazz=__CLASS__){
    	Logger::logObject($obj, $clazz);
    }
    
	
 	public static function is_empty($var, $allow_false = false, $allow_ws = false) {
	    if (!isset($var) || is_null($var) || ($allow_ws == false && trim($var) == "" && !is_bool($var)) || ($allow_false === false && is_bool($var) && $var === false) || (is_array($var) && empty($var))) {   
	        return true;
	    } else {
	        return false;
	    }
	}

	
	public static function addMenuOption(MenuOption $menuOption, $options){

		//si tiene permisos agrego el menú.
		if( self::tienePermisoAPagina( $menuOption->getPageName() )){
			$options[] = $menuOption ;
		}
		
		return $options;
			
	}
	
	public static function addMenuOptionToGroup(MenuOption $menuOption, $menuGroup){

		//si tiene permisos agrego el menú.
		if( self::tienePermisoAPagina( $menuOption->getPageName() )){
			$menuGroup->addMenuOption( $menuOption );
		}
			
	}
	
	/**
	 * chequea si el usuario logueado tiene acceso a una página
	 * @param string $pageName
	 */
	public static function tienePermisoAPagina($pageName){

		//si tiene permisos agrego el menú.
		$page = PageFactory::build( $pageName );
		
		try {

			RastySecurityContext::authorize($page);
			return true;				
			
		} catch (UserRequiredException $e) {
			
		} catch (UserPermissionException $e) {
			
		}
		
		return false;
			
	}
	

	public static function startsWith($haystack, $needle) {
	    // search backwards starting from haystack length characters from the end
	    return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== FALSE;
	}
	
	public static function endsWith($haystack, $needle) {
	    // search forward starting from end minus needle length characters
	    return $needle === "" || (($temp = strlen($haystack) - strlen($needle)) >= 0 && strpos($haystack, $needle, $temp) !== FALSE);
	}	

	
}