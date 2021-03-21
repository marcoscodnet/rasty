<?php

namespace Rasty\Workflow\service;


/**
 * Factory de servicios de UI
 *  
 * @author Bernardo
 * @since 02/09/2015
 *
 */
class UIServiceFactory {

	/**
	 * @return UICategoriaTareaService
	 */
	public static function getUICategoriaTareaService(){
	
		return UICategoriaTareaService::getInstance();	
	}
		
	/**
	 * @return UITareaService
	 */
	public static function getUITareaService(){
	
		return UITareaService::getInstance();	
	}
		
	
}