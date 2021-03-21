<?php

namespace Rasty\Workflow\conf;
  
use Rasty\app\LoadRasty;

/**
 * Configuración para el módulo rasty Workflow
 * 
 * @author bernardo
 * @since 02/09/2015
 */
class RastyWkfConfig {

	
	private $layoutType;
	
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
     * inicializamos phprasty workflow
     */
    public function initialize( $layoutType="RastyWkfLayout" ){
		
    	$sourcesPath = dirname(__DIR__) . "/";
    	LoadRasty::getInstance()->loadXml(dirname(__DIR__) . '/conf/rasty.xml',  $sourcesPath );

    	$this->setLayoutType($layoutType);
    }

	public static function setInstance($instance)
	{
	    self::$instance = $instance;
	}


	public function getLayoutType()
	{
	    return $this->layoutType;
	}

	public function setLayoutType($layoutType)
	{
	    $this->layoutType = $layoutType;
	}
}