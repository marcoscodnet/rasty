<?php
namespace Rasty\Security\service;

use Rasty\Security\components\filter\model\UIPermisoCriteria;

use Rasty\components\RastyPage;
use Rasty\utils\XTemplate;
use Rasty\i18n\Locale;
use Rasty\exception\RastyException;
use Cose\criteria\impl\Criteria;

use Cose\Security\model\Permission;

use Rasty\Grid\entitygrid\model\IEntityGridService;
use Rasty\Grid\filter\model\UICriteria;

/**
 * 
 * UI service para Permiso.
 * 
 * @author Bernardo
 * @since 27/12/2014
 */
class UIPermisoService   implements IEntityGridService{
	
	private static $instance;
	
	private function __construct() {}
	
	public static function getInstance() {
		
		if( self::$instance == null ) {
			
			self::$instance = new UIPermisoService();
			
		}
		return self::$instance; 
	}

	
	
	public function getList( UIPermisoCriteria $uiCriteria){

		try{
			
			$criteria = $uiCriteria->buildCoreCriteria() ;
			
			$criteria->addOrder("name", "ASC");
			
			$service = \Cose\Security\service\ServiceFactory::getPermissionService();
			
			$permisos = $service->getList( $criteria );
	
			return $permisos;
			
		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}
	}
	
	
	public function get( $oid ){

		try{
			
			$service = \Cose\Security\service\ServiceFactory::getPermissionService();
		
			return $service->get( $oid );
			
		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}
	}
	

	public function add( Permission $permiso ){

		try{

			$service = \Cose\Security\service\ServiceFactory::getPermissionService();
		
			return $service->add( $permiso );

		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}			

	}
	
	public function update( Permission $permiso ){

		try{

			$service = \Cose\Security\service\ServiceFactory::getPermissionService();
		
			return $service->update( $permiso );

		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}			

	}
	
	function getEntitiesCount($uiCriteria){

		try{
			
			$criteria = $uiCriteria->buildCoreCriteria() ;
			
			$service = \Cose\Security\service\ServiceFactory::getPermissionService();
			$permisos = $service->getCount( $criteria );
			
			return $permisos;
			
		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}
	}
	
	function getEntities($uiCriteria){
		
		return $this->getList($uiCriteria);
	}
	
}
?>