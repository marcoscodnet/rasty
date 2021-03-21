<?php
namespace Rasty\Catalogo\service;

use Rasty\Catalogo\components\filter\model\UICatalogoCriteria;

use Rasty\components\RastyPage;
use Rasty\utils\XTemplate;
use Rasty\i18n\Locale;
use Rasty\exception\RastyException;
use Rasty\exception\RastyDuplicatedException;
use Cose\exception\DuplicatedEntityException;

use Cose\catalogo\model\Catalogo;


use Rasty\Grid\entitygrid\model\IEntityGridService;

/**
 * 
 * UI service para Catalogo.
 * 
 * @author bernardo
 * @since 14/08/2015
 */
abstract class UICatalogoService implements IEntityGridService {
	
	protected static $instance;
	
	protected function __construct() {}
	
	protected abstract function getService();
	
	public function getList( UICatalogoCriteria $uiCriteria){

		try{
			
			$criteria = $uiCriteria->buildCoreCriteria() ;
		
			$service = $this->getService();
		
			$criteria->addOrder("nombre", "ASC");
		
			return $service->getList( $criteria );
			
		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}

	}
	
	public function getSingleResult( UICatalogoCriteria $uiCriteria){

		try{
			
			$criteria = $uiCriteria->buildCoreCriteria() ;
			
			$service = $this->getService();
			
			return $service->getSingleResult( $criteria );
			
		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}
	}
	
	public function get( $oid ){

		try{
			
			$service = $this->getService();
		
			return $service->get( $oid );
		
		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}
	}
	
	function getEntitiesCount($uiCriteria){

		try{
		
			$criteria = $uiCriteria->buildCoreCriteria() ;
		
			$service = $this->getService();
			$catalogos = $service->getCount( $criteria );
		
			return $catalogos;
			
		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}	
	}
	
	function getEntities($uiCriteria){

		try{
			
			$criteria = $uiCriteria->buildCoreCriteria() ;
			
			$service = $this->getService();
			$catalogos = $service->getList( $criteria );
			
			return $catalogos;
			
		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}
	}
	
	public function add( Catalogo $catalogo ){

		try{
		
			$service = $this->getService();
		
			$service->add( $catalogo );
			
		} catch(DuplicatedEntityException $ex){
		
			$re = new RastyDuplicatedException( $ex->getMessage() );
			$re->setOid($ex->getOid());
			throw $re;
						
		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}	

	}


	public function update( Catalogo $catalogo ){

		try{
			
			$service = $this->getService();
		
			$service->update( $catalogo );

		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}
	}
	
	public function delete( $oid ){

		try{
			
			$service = $this->getService();
		
			return $service->delete( $oid );
		
		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}
	}
	
}
?>