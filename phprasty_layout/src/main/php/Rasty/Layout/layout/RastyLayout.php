<?php

namespace Rasty\Layout\layout;

use Rasty\components\AbstractComponent;
use Rasty\conf\RastyConfig;

use Rasty\utils\Logger;

class RastyLayout extends AbstractComponent{

	protected $scripts = array();
	protected $styles = array();
	protected $links = array();
	
	protected $oPage;

	public function __construct(){
		
		$this->initLinks();
		$this->initScripts();
		$this->initStyles();
		
	}
	
	public function getContent(){
		
		//contenido del componente..
		
		$xtpl = $this->getXTemplate( dirname(__DIR__) .  "/layout/RastyLayout.htm" );
		
		$xtpl->assign('WEB_PATH', RastyConfig::getInstance()->getWebPath() );
		
		$xtpl->assign('title',   $this->oPage->getTitle() );
		
		$xtpl->assign('page',   $this->oPage->render() );
		
		$xtpl->parse("main");
		$content = $xtpl->text("main");
		
		return $content;
	}
		
	public function setPage($oPage){ $this->oPage = $oPage; }
	public function getPage(){ return $this->oPage; }

	public function getType(){
		
		return "Rasty\Layout";
		
	}	

	public function getScripts()
	{
	    return $this->scripts;
	}

	public function setScripts($scripts)
	{
	    $this->scripts = $scripts;
	}

	public function getStyles()
	{
	    return $this->styles;
	}

	public function setStyles($styles)
	{
	    $this->styles = $styles;
	}

	public function getLinks()
	{
	    return $this->links;
	}

	public function setLinks($links)
	{
	    $this->links = $links;
	}

	public function getOPage()
	{
	    return $this->oPage;
	}

	public function setOPage($oPage)
	{
	    $this->oPage = $oPage;
	}
	
	protected function initLinks(){
        
    	$links = array();
    	
    	$this->setLinks($links);
    }
    
    public function addLink($rel, $href, $type){

    	$link = array( "rel" => $rel, "href" => $href, "type" => $type);
    	$this->links[] = $link;
    	
    }
    
	/**
     * la idea es tener una colección de scripts
     * y que el layout los incluye en la renderización.
     * @return array
     */
    protected function initScripts(){
        
    	$scripts = array();
    	
    	$this->setScripts($scripts);
    }
    
    public function addScript( $source ){
    	$this->scripts[] = $source;
    }
    
    /**
     * la idea es tener una colección de styles
     * y que el layout los incluye en la renderización.
     * @return array
     */
    protected function initStyles(){
        
    	$styles = array();
            	
    	$this->setStyles($styles);
    }
    
    public function addStyle( $source ){
    	$this->styles[] = $source;
    }
    
}
?>