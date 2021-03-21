<?php
namespace Rasty\app;

use Rasty\conf\RastyConfig;

use Rasty\factory\ComponentDescriptor;

use Rasty\utils\RastyCache;
use Rasty\utils\Logger;

/**
 *  
 * @author bernardo
 * @since 03-03-2010
 */
use Rasty\factory\ComponentFactory;

use Rasty\utils\ReflectionUtils;

use Rasty\utils\RastyUtils;

use Rasty\exception\UserRequiredException;
use Rasty\exception\UserPermissionException;
use Rasty\security\RastySecurityContext;

use Rasty\actions\Forward;


class ApplicationComponent extends Application{

	
	public function ApplicationComponent(){
	}
	

	public function execute(Forward $forward=null){
			
		//tomamos el name ingresado
		$name = RastyUtils::getParamGET( 'name' ) ;

		//tomamos el id del component
		$id = RastyUtils::getParamGET( 'componentId' ) ;
		
		
		//este helper nos ayuda a recuperar el component específico.
		$map = new RastyMapHelper();
		$component = $map->getComponent($name);
		
		
		if( !empty($component)){
			
			//obtenemos el descriptor xml
// 			$xml = $this->getXml($component, $name);
	
			//si tiene extend buscamos la ubicación del parent
			$extend =  $component["extend"];
			$clazz = null;
			Logger::log("Component Extend $extend");
			if($extend!=null){
				
				$parentComponent = $map->getComponent($extend);		
				Logger::logObject($parentComponent);
				$component_file = $parentComponent["app_path"] ."/" . $parentComponent["location"] . "/$extend.rasty" ;
				$clazz = $component["app_path"] ."/" . $component["location"] . "/$name" ;		
			}else{
				
				$component_file = $component["app_path"] ."/" . $component["location"] . "/$name.rasty" ;			
			}
			
			//construimos el component dado su descriptor.
// 			$oComponent = ComponentFactory::build( $xml, null, null);
			$descriptor = ComponentDescriptor::buildFromFile($component_file, $clazz);
			$oComponent = ComponentFactory::buildByDescriptor($descriptor);
			$oComponent->setId($id);
			
			//avisamos a los subscritores de cambios
			$listeners = RastyConfig::getInstance()->getAppListeners();
			foreach ($listeners as $listener) {
				$listener->componentExecuted( $oComponent );
			}
			
			//lo renderizamos.
			$render = $this->getRenderer( $oComponent );
			$render->render( $oComponent );			
			
		}else{
			echo "<h1>manejar error not found $id / $name </h1>";
		}
		
	}
	
	private function getXml($component, $name){

// 		//chequeamos si está en caché
// 		$cache = RastyCache::getInstance();
// 		if($cache->contains("RastyComponentXML_$name") )
// 			$xml = $cache->fetch("RastyComponentXML_$name");
// 		else{
		
// 			//obtenemos la ubicación del descriptor del component.
// 			$component_file = $component["app_path"] ."/" . $component["location"] . "/$name.rasty" ;
				
// 			//cargamos el descriptor
// 			$xml = simplexml_load_file( $component_file  );
			
// 			$cache->save("RastyComponentXML_$name", $xml);
// 		}
		
		
		//obtenemos la ubicación del descriptor del component.
		$component_file = $component["app_path"] ."/" . $component["location"] . "/$name.rasty" ;
		
		//cargamos el descriptor
		$xml = simplexml_load_file( $component_file  );
		
		return $xml;
	}
	
}