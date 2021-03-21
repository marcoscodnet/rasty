<?php
namespace Rasty\Workflow\service;

use Rasty\Workflow\components\filter\model\UITareaCriteria;

use Cose\Workflow\service\ServiceFactory;

use Cose\Workflow\model\Tarea;

use Rasty\exception\RastyException;

use Rasty\Grid\entitygrid\model\IEntityGridService;

/**
 * 
 * UI service para Tarea.
 * 
 * @author Bernardo
 * @since 02-09-2015
 */
class UITareaService  implements IEntityGridService{
	
	private static $instance;
	
	private function __construct() {}
	
	public static function getInstance() {
		
		if( self::$instance == null ) {
			
			self::$instance = new UITareaService();
			
		}
		return self::$instance; 
	}

	
	
	public function getList( UITareaCriteria $uiCriteria){

		try{

			$criteria = $uiCriteria->buildCoreCriteria() ;
			
			$service = ServiceFactory::getTareaService();
			
			$tareas = $service->getList( $criteria );
	
			return $tareas;

		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}			
	}
	
	public function getSingleResult( UITareaCriteria $uiCriteria){

		try{

			$criteria = $uiCriteria->buildCoreCriteria() ;
			
			$service = ServiceFactory::getTareaService();
			
			$tarea = $service->getSingleResult( $criteria );
	
			return $tarea;

		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}			
	}
	
	
	public function get( $oid ){

		try {
			
			$service = ServiceFactory::getTareaService();
			
			return $service->get( $oid );

		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}
	}
	
	
	function getEntitiesCount($uiCriteria){

		try{
			
			$criteria = $uiCriteria->buildCoreCriteria() ;
			
			$service = ServiceFactory::getTareaService();
			$tareas = $service->getCount( $criteria );
			
			return $tareas;
			
		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}
	}
	
	function getEntities($uiCriteria){
		
		return $this->getList($uiCriteria);
	}	
	
	public function add( Tarea $tarea ){

		try{

			$service = ServiceFactory::getTareaService();
		
			return $service->add( $tarea );

		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}			

	}

	public function update( Tarea $tarea ){

		try{

			$service = ServiceFactory::getTareaService();
		
			return $service->update( $tarea );

		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}			

	}
	
	
	public function delete( $oid ){

		try {
			
			$service = ServiceFactory::getTareaService();
			
			return $service->delete( $oid );

		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}
	}
	
}
?>