<?php

namespace Rasty\Menu\conf;

use Rasty\app\LoadRasty;

/**
 * Configuración para el módulo rasty forms
 * 
 * @author bernardo
 * @since 06/09/2013
 */
class RastyMenuConfig {
	
    
    /**
     * inicializamos phprasty menu
     */
    static public function initialize( ){
		
    	$sourcesPath = dirname(__DIR__) . "/";
    	LoadRasty::getInstance()->loadXml(dirname(__DIR__) . '/conf/rasty.xml',  $sourcesPath );
    	    	    	
    }
}