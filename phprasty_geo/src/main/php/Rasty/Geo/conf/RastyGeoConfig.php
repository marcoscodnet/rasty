<?php

namespace Rasty\Geo\conf;
  
use Rasty\app\LoadRasty;

/**
 * Configuración para el módulo rasty Geo
 * 
 * @author bernardo
 * @since 20/08/2015
 */
class RastyGeoConfig {

	
    /**
	 * singleton instance
	 * @var RastyConfig
	 */
	private static $instance;
	
	public static function getInstance(){
		if (  !self::$instance instanceof self ) {
			self::$instance = new self;
		}
		return self::$instance;
	}
	
	
    /**
     * inicializamos phprasty security
     */
    public function initialize(  ){
		
    	$sourcesPath = dirname(__DIR__) . "/";
    	LoadRasty::getInstance()->loadXml(dirname(__DIR__) . '/conf/rasty.xml',  $sourcesPath );

    	
    }

	public static function setInstance($instance)
	{
	    self::$instance = $instance;
	}
}