<?php

namespace Rasty\Crud\conf;

use Rasty\app\LoadRasty;

/**
 * Configuración para el módulo rasty crud
 * 
 * @author bernardo
 * @since 11/08/2014
 */
class RastyCrudConfig {

	private $layout;
	
	private $publicLayout;
	
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

	public function getLayout()
	{
	    return $this->layout;
	}

	public function setLayout($layout)
	{
	    $this->layout = $layout;
	}

	public function getPublicLayout()
	{
	    return $this->publicLayout;
	}

	public function setPublicLayout($publicLayout)
	{
	    $this->publicLayout = $publicLayout;
	}

	public static function setInstance($instance)
	{
	    self::$instance = $instance;
	}
}