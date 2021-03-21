<?php
namespace Rasty\Workflow\components\input\model;

use Rasty\Workflow\components\filter\model\UICategoriaTareaCriteria;

use Rasty\Workflow\service\UIServiceFactory;

use Rasty\Forms\input\InputComboTreeModel;

use Rasty\utils\Logger;

/**
 * Model input tree para categorías de tareas.
 * 
 * @author bernardo
 * @since 09/09/2015
 * 
 */

class CategoriaTareaInputTreeModel extends InputComboTreeModel{


	public function findEntityByCode( $code ){

		try {
			
			return $this->getService()->get( $code );
			
		} catch (RastyException $e) {
			
			return null;
			
		}
	}
	
	public function getEntityCode( $entity ){
		
		if(!empty($entity))
			return $entity->getOid();
	}
	
	public function getEntityLabel( $entity ){
		
		if(!empty($entity))
			return $entity->getNombre();
	}
	
	public function getChildren( $entity ){
		
		//Logger::log("buscando hijos de " . $entity);
		
		$criteria = new UICategoriaTareaCriteria();
		
		if($entity == null ){

			$criteria->setPadreIsNull(true);
			
		}else{
			$criteria->setPadre( $entity );
		}
		
		
		$children = $this->getService()->getEntities( $criteria );
		
		//Logger::logObject( $children );
		
		return $children;
		
	}
	

	public function getFilter(){
    	
    	$filter = new UICategoriaTareaCriteria();
		return $filter;    	
    }
	
    private function getService(){
    	
    	return UIServiceFactory::getUICategoriaTareaService();
    }
	
    
}
?>