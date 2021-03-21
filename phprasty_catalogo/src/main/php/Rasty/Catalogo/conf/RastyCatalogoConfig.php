<?php

namespace Rasty\Catalogo\conf;
  
use Rasty\app\LoadRasty;

/**
 * Configuración para el módulo rasty Catalogo
 * 
 * @author bernardo
 * @since 14 /08/2015
 */
class RastyCatalogoConfig {

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
     * inicializamos phprasty catalogos
     */
    public function initialize( $layoutType ){

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