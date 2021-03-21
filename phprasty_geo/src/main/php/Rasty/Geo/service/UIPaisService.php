<?php
namespace Rasty\Geo\service;

use Rasty\Geo\components\filter\model\UIPaisCriteria;

use Cose\Geo\service\ServiceFactory;

use Cose\Geo\model\Pais;

use Rasty\exception\RastyException;

use Rasty\Grid\entitygrid\model\IEntityGridService;

/**
 * 
 * UI service para Pais.
 * 
 * @author Bernardo
 * @since 20-08-2015
 */
class UIPaisService  implements IEntityGridService{
	
	private static $instance;
	
	private function __construct() {}
	
	public static function getInstance() {
		
		if( self::$instance == null ) {
			
			self::$instance = new UIPaisService();
			
		}
		return self::$instance; 
	}

	
	
	public function getList( UIPaisCriteria $uiCriteria){

		try{

			$criteria = $uiCriteria->buildCoreCriteria() ;
			
			$service = ServiceFactory::getPaisService();
			
			$paises = $service->getList( $criteria );
	
			return $paises;

		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}			
	}
	
	public function getSingleResult( UIPaisCriteria $uiCriteria){

		try{

			$criteria = $uiCriteria->buildCoreCriteria() ;
			
			$service = ServiceFactory::getPaisService();
			
			$pais = $service->getSingleResult( $criteria );
	
			return $pais;

		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}			
	}
	
	
	public function get( $oid ){

		try {
			
			$service = ServiceFactory::getPaisService();
			
			return $service->get( $oid );

		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}
	}
	
	
	function getEntitiesCount($uiCriteria){

		try{
			
			$criteria = $uiCriteria->buildCoreCriteria() ;
			
			$service = ServiceFactory::getPaisService();
			$paises = $service->getCount( $criteria );
			
			return $paises;
			
		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}
	}
	
	function getEntities($uiCriteria){
		
		return $this->getList($uiCriteria);
	}	
	
	public function add( Pais $pais ){

		try{

			$service = ServiceFactory::getPaisService();
		
			return $service->add( $pais );

		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}			

	}

	public function update( Pais $pais ){

		try{

			$service = ServiceFactory::getPaisService();
		
			return $service->update( $pais );

		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}			

	}
	
	
	public function delete( $oid ){

		try {
			
			$service = ServiceFactory::getPaisService();
			
			return $service->delete( $oid );

		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}
	}
	
}
?>