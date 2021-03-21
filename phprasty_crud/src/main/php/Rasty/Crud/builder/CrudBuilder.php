<?php
namespace Rasty\Crud\builder;

use Rasty\app\LoadRasty;
use Rasty\conf\RastyConfig;

use Rasty\utils\Logger;

/**
 * Builder para armar páginas de ABM y consultas sobre una
 * entidad de negocio.
 * 
 * @author Bernardo
 * @since 11/08/2015
 *
 */
abstract class CrudBuilder {

	/**
	 * el builder va a ser el encargado de crear las páginas y las acciones
	 * correspondiente a las operaciones del CRUD definidos por el builder
	 * específico.
	 * 
	 * @param LoadRasty $loader
	 */
	public function addPages( LoadRasty $loader ){
		
		$app_path = dirname(__DIR__) . "/";
    	$web_path = RastyConfig::getInstance()->getWebPath();

    	//creamos una página para el listado
    	//Logger::log("agregando crud pages.");
    	$page = $this->addPage( $loader, $this->getListMetadata() );
    	
    	
	}
	
	protected function getAppPath(){
		return dirname(__DIR__) . "/";
	}
	
	protected function addPage( LoadRasty $loader, $metadata ){
		
		//$name, $location, $url, $app_path, $web_path, $specificationClass
		
		if( $metadata ){

			//Logger::logObject($metadata);	
			
			$loader->addPage( $metadata );
			
		}
	}
	
	protected function getListPageLocation(){
		
		return "pages/entities/EntitiesList.page";
	}
	
	protected function getListMetadata(){
		
		if(!$this->getListPageName())
			return false;
		
		return array( "name"=> $this->getListPageName(),
						"url"=> $this->getListPageUrl(),
						"location"=> $this->getListPageLocation(),
						"app_path"=> $this->getAppPath(),
						"instance"=> $this->getListPageSpecification());
	}
	
	protected abstract function getListPageName();
	protected abstract function getListPageUrl();
	protected abstract function getListPageSpecification();
}
?>