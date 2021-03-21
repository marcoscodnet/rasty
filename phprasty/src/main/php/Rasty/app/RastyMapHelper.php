<?php
namespace Rasty\app;

use Rasty\cache\RastyCache;

/**
 * Colabora con el mapeo de los componentes.
 * 
 * @author bernardo
 * @since 02-03-2010
 * 
 */

class RastyMapHelper{
	
	private static $instance;
	
	//array con el mapeo de los componentes. 
	private $components_map =  array(); //( [component_name] = array( location_of_descriptor, app_path, web_path, clazz, instance, extend) )
	
	//array con el mapeo de las pages.
	private $pages_map =  array(); // ( [page] = array(location_of_descriptor, url, app_path, web_path, clazz, instance, extend) )
	
	//array con el mapeo de las actions.
	private $actions_map =  array(); // ( [action] = array(url, name, class) )
	
	//array con el mapeo de la restfulapi.
	private $restfulapi_map =  array(); // ( [action] = array(url, name, class) )
	
	
	//M�todo constructor
	
	public function __construct(){

		$composite = LoadRasty::getInstance();

		foreach ($composite->getComponents() as $component) {

			if(array_key_exists("class", $component))
				$clazz = $component['class'];
			else
				$clazz = "";
			
			if(array_key_exists("instance", $component))
				$instance = $component['instance'];
			else
				$instance = null;
			
			if(array_key_exists("extend", $component))
				$extend = $component['extend'];
			else
				$extend = null;
			
			if( !array_key_exists("location", $component))
				$component['location'] = null;
								
			$this->setComponent($component['name'], $component['location'], $component['app_path'], $component['web_path'], $clazz, $instance, $extend);
		}
		
		foreach ($composite->getPages() as $page) {
			
			if(array_key_exists("class", $page))
				$clazz = $page['class'];
			else
				$clazz = "";
			
			if(array_key_exists("instance", $page))
				$instance = $page['instance'];
			else
				$instance = null;
			
			if(array_key_exists("extend", $page))
				$extend = $page['extend'];
			else
				$extend = null;
				
			if( !array_key_exists("location", $page))
				$page['location'] = null;
				
			$this->setPage($page['name'], $page['location'], $page['url'], $page['app_path'], $page['web_path'], $clazz, $instance, $extend);
		}
		
		foreach ($composite->getActions() as $action) {
			$this->setAction($action['name'], $action['class'], $action['url']);
		}
		
		if(is_array( $composite->getRestfulapi() ))
		foreach ($composite->getRestfulapi() as $action) {
			$this->setRestfulapi($action['name'], $action['class'], $action['url']);
		}
		

		
	}

	public static function getInstance(){
		if (  !self::$instance instanceof self ) {
			
			$cache = RastyCache::getInstance();
			$cacheKey = "myRastyMapHelper";
			if($cache->contains( $cacheKey ) )
				self::$instance = $cache->fetch($cacheKey);
			else{
			
				self::$instance = new self;
			
				$cache->save($cacheKey,  self::$instance );
			}
				
		}
		
		return self::$instance;
	}
	
	function getComponent($name) {
		if( array_key_exists($name, $this->components_map) )
			return $this->components_map[$name];
		echo " no está!! ( $name )";	
	}
	
	/*
	function getPage($name) {
		return $this->pages_map[$name];
	}*/
	
	function getPage($url) {
		//var_dump($this->pages_map);
		return $this->pages_map[$url];
	}

	function getPageByName($name) {

		foreach ($this->pages_map as $value) {
			$current =  $value["name"];
			if( $current == $name )
				return $value;
		}
		
	}
	
	function getAction($url) {
		//var_dump($this->pages_map);
		return $this->actions_map[$url];
	}
	
	function getRestfulapi($url) {
		return $this->restfulapi_map[$url];
	}
	
	function setComponent($name,$location, $app_path, $web_path, $clazz=null, $instance=null, $extend=null){
		$this->components_map[$name]= array( "location"=>$location, "app_path" => $app_path, "web_path" => $web_path, "class"=>$clazz, "instance"=>$instance, "extend"=>$extend);	
	}	
	
	function setPage($name,$location,$url, $app_path, $web_path, $clazz=null, $instance=null, $extend=null){
		//$this->pages_map[$name]=array(location=>$location, url=>$url);
		$this->pages_map[$url]=array("name"=>$name, "location"=>$location, "app_path" => $app_path, "web_path" => $web_path, "class"=>$clazz, "instance"=>$instance, "extend"=>$extend);
	}
	
	function setAction($name,$class,$url){
		//$this->pages_map[$name]=array(location=>$location, url=>$url);
		$this->actions_map[$url]=array("name"=>$name, "class"=>$class );
	}
	
	function setRestfulapi($name,$class,$url){
		//$this->pages_map[$name]=array(location=>$location, url=>$url);
		$this->restfulapi_map[$url]=array("name"=>$name, "class"=>$class );
	}
	
	function getComponentDescriptor( $type ){
		
		$component = $this->getComponent( $type );
		
		$extend =  $component["extend"];
		if($extend!=null){
			$parentComponent = $this->getComponent($extend);		
			$component_descriptor = $parentComponent["app_path"] ."/" . $parentComponent["location"] . "/$extend.rasty" ;
		}else{
			$component_descriptor = $component['app_path']. $component['location'] . "/$type.rasty";
		}
		
		//$component_descriptor = APP_PATH . $component_location . "/$type.rasty";
		return $component_descriptor;
		
	}
	
	function getComponentTemplatePath( $type ){
		
		$component = $this->getComponent( $type );
		
		$extend =  $component["extend"];
		if($extend!=null){
		$parentComponent = $this->getComponent($extend);		
			$component_template = $parentComponent["app_path"] ."/" . $parentComponent["location"]  ;
		}else{
			$component_template = $component['app_path']. $component['location'] ;
		}
		
		//$component = $this->getComponent( $type );
		//$component_template = $component['app_path']. $component['location'] ;
		
		return $component_template;
	}

	function getComponentWebPath( $type ){
		$component = $this->getComponent( $type );
		$component_web_path = $component['web_path']. $component['location'] ;
		return $component_web_path;
	}
	
	function getPageAppPath( $type ){
		
		$page = $this->getPageByName( $type );
		//$component_template = APP_PATH . $component_location ;
		$page_app_path = $page['app_path'] ;
		return $page_app_path;
	}
	function getPageUrl($name) {

		foreach ($this->pages_map as $url => $value) {
			$current =  $value["name"];
			if( $current == $name )
				return $url;
		}
		
	}
	
	function getActionUrl($name) {

		foreach ($this->actions_map as $url => $value) {
			$current =  $value["name"];
			if( $current == $name )
				return $url;
		}
		
	}
	
	function getRestfulapiUrl($name) {

		foreach ($this->restfulapi_map as $url => $value) {
			$current =  $value["name"];
			if( $current == $name )
				return $url;
		}
		
	}

	function getComponentSpecificationClass( $type ){
		
		$component = $this->getComponent( $type );

		$clazz =  $component["class"];
		
		if(empty($clazz))
			$clazz=null;
		return $clazz;
		
	}
	
}