<?php

namespace Rasty\Catalogo\service;


/**
 * Factory de servicios de UI
 *  
 * @author Bernardo
 * @since 26/08/2015
 *
 */
class UIServiceFactory {

	/**
	 * @return UITipoDocumentoService
	 */
	public static function getUITipoDocumentoService(){
	
		return UITipoDocumentoService::getInstance();	
	}
	
	/**
	 * @return UIGeneroService
	 */
	public static function getUIGeneroService(){
	
		return UIGeneroService::getInstance();	
	}
	
	/**
	 * @return UIEstadoCivilService
	 */
	public static function getUIEstadoCivilService(){
	
		return UIEstadoCivilService::getInstance();	
	}
	
	/**
	 * @return UICondicionIvaService
	 */
	public static function getUICondicionIvaService(){
	
		return UICondicionIvaService::getInstance();	
	}
	
	
}