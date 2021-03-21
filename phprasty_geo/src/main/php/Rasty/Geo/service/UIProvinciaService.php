<?php
namespace Rasty\Geo\service;

use Rasty\Geo\components\filter\model\UIProvinciaCriteria;

use Cose\Geo\service\ServiceFactory;

use Cose\Geo\model\Provincia;

use Rasty\exception\RastyException;

use Rasty\Grid\entitygrid\model\IEntityGridService;

/**
 * 
 * UI service para Provincia.
 * 
 * @author Bernardo
 * @since 20-08-2015
 */
class UIProvinciaService  implements IEntityGridService{
	
	private static $instance;
	
	private function __construct() {}
	
	public static function getInstance() {
		
		if( self::$instance == null ) {
			
			self::$instance = new UIProvinciaService();
			
		}
		return self::$instance; 
	}

	
	
	public function getList( UIProvinciaCriteria $uiCriteria){

		try{

			$criteria = $uiCriteria->buildCoreCriteria() ;
			
			$service = ServiceFactory::getProvinciaService();
			
			$provincias = $service->getList( $criteria );
	
			return $provincias;

		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}			
	}

	
	public function getSingleResult( UIProvinciaCriteria $uiCriteria){

		try{

			$criteria = $uiCriteria->buildCoreCriteria() ;
			
			$service = ServiceFactory::getProvinciaService();
			
			$provincia = $service->getSingleResult( $criteria );
	
			return $provincia;

		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}			
	}
	
	
	public function get( $oid ){

		try {
			
			$service = ServiceFactory::getProvinciaService();
			
			return $service->get( $oid );

		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}
	}
	
	
	function getEntitiesCount($uiCriteria){

		try{
			
			$criteria = $uiCriteria->buildCoreCriteria() ;
			
			$service = ServiceFactory::getProvinciaService();
			$provincias = $service->getCount( $criteria );
			
			return $provincias;
			
		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}
	}
	
	function getEntities($uiCriteria){
		
		return $this->getList($uiCriteria);
	}	
	
	public function add( Provincia $provincia ){

		try{

			$service = ServiceFactory::getProvinciaService();
		
			return $service->add( $provincia );

		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}			

	}

	public function update( Provincia $provincia ){

		try{

			$service = ServiceFactory::getProvinciaService();
		
			return $service->update( $provincia );

		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}			

	}
	
	
	public function delete( $oid ){

		try {
			
			$service = ServiceFactory::getProvinciaService();
			
			return $service->delete( $oid );

		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}
	}
	
}
?>