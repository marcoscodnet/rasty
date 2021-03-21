<?php

namespace Rasty\conf;

/**
 * Configuración para Rasty

 * @author bernardo
 * @since 05/09/2013
 */
use Rasty\cache\RastyMockCache;

use Rasty\cache\RastyApcCache;

use Rasty\app\IApplicationListener;

class RastyConfig {

	/**
	 * singleton instance
	 * @var RastyConfig
	 */
	private static $instance;
	
	/**
	 * nombre de la aplicación.
	 * @var string
	 */
	private $appName;
	
	/**
	 * home de la app en el filesystem.
	 * @var string
	 */
	private $appHome;
	
	/**
	 * web path de la app
	 * @var string
	 */
	private $webPath;
	
	/**
	 * language para los mensajes.
	 * @var string
	 */
	private $language = "es";

	//extensiones de los templates.
	private $templateExtension = 'htm' ;

	/**
	 * url para websocket
	 * @var string
	 */
	private $websocketUrl ="";
	
	/**
	 * port para websocket
	 * @var string
	 */
	private $websocketPort ="8084";

	/**
	 * id para la caché
	 * (para evitar pisar datos entre las distintas apps)
	 * @var string
	 */
	private $cacheId;

	/**
	 * clase que implementa la interface de caché
	 * @var string
	 */
	private $cacheType;
	
	/**
	 * listeners que serán avisados cuando se accede
	 * a la applicación.
	 * @var array [IApplicationListener]
	 */
	private $appListeners;

	/**
	 * para determinar si la conexión es segura o no (ssl)
	 * @var string
	 */
	private $ssl=false;
	
	
	const RASTY_REQUEST_TYPE_PAGE = 1;
	const RASTY_REQUEST_TYPE_JSON = 2;
	const RASTY_REQUEST_TYPE_PDF = 3;
	const RASTY_REQUEST_TYPE_COMPONENT = 4 ;
	const RASTY_REQUEST_TYPE_ACTION = 5;
	const RASTY_REQUEST_TYPE_RESTFUL = 6;
	
	public static function getInstance(){
		if (  !self::$instance instanceof self ) {
			self::$instance = new self;
		}
		return self::$instance;
	}
	
    
    /**
     * inicializamos phprasty
     */
    public function initialize( $appHome, $appName, $ssl=false ){
    	
    	$this->setAppListeners(array());
    	
    	$this->setAppHome( $appHome);
    	
    	$this->setAppName( $appName );
    	
		$this->setSsl($ssl);
		
    	//$this->setWebPath( 'http://' . getenv ('HTTP_HOST') . "/" . $appName. "/" );
		$this->setWebPath( $this->getHttpConn() . "://" . getenv ('HTTP_HOST') . "/" . $appName. "/" );

		$this->setLanguage("es");
		
		$this->setTemplateExtension("htm");

		$this->setCacheType( get_class( new RastyApcCache()) );
		//$this->setCacheType( get_class( new RastyMockCache()) );
		
    }

	public static function setInstance($instance)
	{
	    self::$instance = $instance;
	}

	
	public function getAppPath()
	{
	    return $this->appHome . "/" . $this->appName  . "/";
	}
	
	public function getAppName()
	{
	    return $this->appName;
	}

	public function setAppName($appName)
	{
	    $this->appName = $appName;
	}

	public function getAppHome()
	{
	    return $this->appHome;
	}

	public function setAppHome($appHome)
	{
	    $this->appHome = $appHome;
	}

	public function getWebPath()
	{
	    return $this->webPath;
	}

	public function setWebPath($webPath)
	{
	    $this->webPath = $webPath;
	}

	public function getLanguage()
	{
	    return $this->language;
	}

	public function setLanguage($language)
	{
	    $this->language = $language;
	}

	public function getTemplateExtension()
	{
	    return $this->templateExtension;
	}

	public function setTemplateExtension($templateExtension)
	{
	    $this->templateExtension = $templateExtension;
	}

	public function getWebsocketUrl()
	{
	    return $this->websocketUrl;
	}

	public function setWebsocketUrl($websocketUrl)
	{
	    $this->websocketUrl = $websocketUrl;
	}

	public function getWebsocketPort()
	{
	    return $this->websocketPort;
	}

	public function setWebsocketPort($websocketPort)
	{
	    $this->websocketPort = $websocketPort;
	}

	public function getCacheId()
	{
	    return $this->cacheId;
	}

	public function setCacheId($cacheId)
	{
	    $this->cacheId = $cacheId;
	}

	public function getAppListeners()
	{
	    return $this->appListeners;
	}

	public function setAppListeners($appListeners)
	{
	    $this->appListeners = $appListeners;
	}
	
	public function addAppListener(IApplicationListener $appListener)
	{
	    $this->appListeners[] = $appListener;
	}
	
	

	public function getSsl()
	{
	    return $this->ssl;
	}

	public function setSsl($ssl)
	{
	    $this->ssl = $ssl;
	}
	
	public function getHttpConn(){
	
		if( $this->ssl )
			return "https";
		else 
			return "http";	
	
	}

	public function getCacheType()
	{
	    return $this->cacheType;
	}

	public function setCacheType($cacheType)
	{
	    $this->cacheType = $cacheType;
	}
}