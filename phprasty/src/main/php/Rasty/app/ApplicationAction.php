<?php
namespace Rasty\app;

use Rasty\conf\RastyConfig;

use Rasty\utils\ReflectionUtils;
use Rasty\actions\Forward;

/**
 *  
 * @author bernardo
 * @since 03-08-2012
 */
class ApplicationAction{

	
	public function __construct(){
	}
	
	public function execute(Forward $forward=null){
			
		$path = $_GET['path'] ;
		
		$map = new RastyMapHelper();
		
		$action_description =  $map->getAction($path);
		
		$action = ReflectionUtils::newInstance( $action_description["class"] );
		
					
		//avisamos a los subscritores de cambios
		$listeners = RastyConfig::getInstance()->getAppListeners();
		foreach ($listeners as $listener) {
			$listener->actionExecuted( $action );
		}
		
		
		
		$forward = $action->execute();
				
		header ( 'Location: '.  $forward->buildForwardUrl() );
		/*
		$app = new Application();
		$app->execute( $forward );
		*/
	}		
	
}