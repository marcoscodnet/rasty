<?php
namespace Rasty\app;

use Rasty\conf\RastyConfig;

use Rasty\actions\Forward;

use Rasty\utils\ReflectionUtils;

/**
 *  
 * @author bernardo
 * @since 03-03-2010
 */
class ApplicationJson{

	
	public function ApplicationJson(){
	}
	
	public function execute(Forward $forward=null){
			
		$path = $_GET['path'] ;
		
		$map = new RastyMapHelper();
		
		$action_description =  $map->getAction($path);
		
		$action = ReflectionUtils::newInstance( $action_description["class"] );
		
		//avisamos a los subscritores de cambios
		$listeners = RastyConfig::getInstance()->getAppListeners();
		foreach ($listeners as $listener) {
			$listener->actionJsonExecuted( $action );
		}
				
		if( isset($_GET["jsoncallback"]) ){
			$response = $_GET["jsoncallback"]."(".json_encode( $action->execute() ).")";
		}else 
			$response = json_encode( $action->execute() ); 
		
			
		//CORS 
//		header('Access-Control-Allow-Origin: *'); 
//		header('Access-Control-Allow-Headers: X-Requested-With'); 
//		header('Content-Type: application/json'); 
		echo $response;
				
	}	
}