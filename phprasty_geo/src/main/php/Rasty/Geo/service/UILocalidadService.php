<?php
namespace Rasty\Geo\service;

use Rasty\Geo\components\filter\model\UILocalidadCriteria;

use Cose\Geo\service\ServiceFactory;

use Rasty\exception\RastyException;

use Rasty\Grid\entitygrid\model\IEntityGridService;

use Cose\Geo\model\Localidad;

/**
 * 
 * UI service para Localidad.
 * 
 * @author Bernardo
 * @since 20-08-2015
 */
class UILocalidadService  implements IEntityGridService{
	
	private static $instance;
	
	private function __construct() {}
	
	public static function getInstance() {
		
		if( self::$instance == null ) {
			
			self::$instance = new UILocalidadService();
			
		}
		return self::$instance; 
	}

	
	
	public function getList( UILocalidadCriteria $uiCriteria){

		try{

			$criteria = $uiCriteria->buildCoreCriteria() ;
			
			$service = ServiceFactory::getLocalidadService();
			
			$localidades = $service->getList( $criteria );
	
			return $localidades;

		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}			
	}
	
	
	public function getSingleResult( UILocalidadCriteria $uiCriteria){

		try{

			$criteria = $uiCriteria->buildCoreCriteria() ;
			
			$service = ServiceFactory::getLocalidadService();
			
			$localidad = $service->getSingleResult( $criteria );
	
			return $localidad;

		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}			
	}
	
	public function get( $oid ){

		try {
			
			$service = ServiceFactory::getLocalidadService();
			
			return $service->get( $oid );

		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}
	}
	
	
	function getEntitiesCount($uiCriteria){

		try{
			
			$criteria = $uiCriteria->buildCoreCriteria() ;
			
			$service = ServiceFactory::getLocalidadService();
			$localidades = $service->getCount( $criteria );
			
			return $localidades;
			
		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}
	}
	
	function getEntities($uiCriteria){
		
		return $this->getList($uiCriteria);
	}	
	
	public function add( Localidad $localidad ){

		try{

			$service = ServiceFactory::getLocalidadService();
		
			return $service->add( $localidad );

		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}			

	}

	public function update( Localidad $localidad ){

		try{

			$service = ServiceFactory::getLocalidadService();
		
			return $service->update( $localidad );

		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}			

	}
	
	
	public function delete( $oid ){

		try {
			
			$service = ServiceFactory::getLocalidadService();
			
			return $service->delete( $oid );

		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}
	}
	
}
?>