<?php

namespace Rasty\Catalogo\utils;
  

/**
 * Configuración para el módulo rasty Catalogo
 * 
 * @author bernardo
 * @since 14 /08/2015
 */

use Rasty\Menu\menu\model\MenuOption;
use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuActionOption;
use Rasty\Menu\menu\model\MenuActionAjaxOption;


use Rasty\factory\PageFactory;
use Rasty\security\RastySecurityContext;

use Rasty\exception\UserPermissionException;
use Rasty\exception\UserRequiredException;


class RastyCatalogoUtils {

	
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
	
	public static function addMenuOption(MenuOption $menuOption, $options){

		//si tiene permisos agrego el menú.
		if( self::tienePermisoAPagina( $menuOption->getPageName() )){
			$options[] = $menuOption ;
		}
		
		return $options;
			
	}
	
}