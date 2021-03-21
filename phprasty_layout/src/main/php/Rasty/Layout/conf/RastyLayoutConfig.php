<?php

namespace Rasty\Layout\conf;
use Rasty\app\LoadRasty;

/**
 * Configuración para el módulo rasty layout
 * 
 * @author bernardo
 * @since 06/09/2013
 */
class RastyLayoutConfig {
	
    
    /**
     * inicializamos phprasty layout
     */
    static public function initialize(){
		
    	$sourcesPath = dirname(__DIR__) . "/";
    	
    	LoadRasty::getInstance()->loadXml(dirname(__DIR__) . '/conf/rasty.xml',  $sourcesPath  );
    	    	
    }
}