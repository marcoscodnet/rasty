<?php

namespace Rasty\Geo\service;


/**
 * Factory de servicios de UI
 *  
 * @author Bernardo
 * @since 20/08/2015
 *
 */
class UIServiceFactory {

	/**
	 * @return UIPaisService
	 */
	public static function getUIPaisService(){
	
		return UIPaisService::getInstance();	
	}
	
	/**
	 * @return UIProvinciaService
	 */
	public static function getUIProvinciaService(){
	
		return UIProvinciaService::getInstance();	
	}
	
	/**
	 * @return UILocalidadService
	 */
	public static function getUILocalidadService(){
	
		return UILocalidadService::getInstance();	
	}
	
	
}