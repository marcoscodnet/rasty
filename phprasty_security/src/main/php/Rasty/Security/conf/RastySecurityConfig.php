<?php

namespace Rasty\Security\conf;

use Rasty\app\LoadRasty;

/**
 * Configuración para el módulo rasty security
 * 
 * @author bernardo
 * @since 23/12/2013
 */
class RastySecurityConfig {

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
    public function initialize( $layout=null, $publicLayout=null ){
		
    	$sourcesPath = dirname(__DIR__) . "/";
    	LoadRasty::getInstance()->loadXml(dirname(__DIR__) . '/conf/rasty.xml',  $sourcesPath );

    	$this->setLayout($layout);
    	
    	$this->setPublicLayout($publicLayout);
    	
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