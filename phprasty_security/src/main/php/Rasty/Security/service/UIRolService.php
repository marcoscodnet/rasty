<?php
namespace Rasty\Security\service;

use Rasty\Security\components\filter\model\UIRolCriteria;

use Rasty\components\RastyPage;
use Rasty\utils\XTemplate;
use Rasty\i18n\Locale;
use Rasty\exception\RastyException;
use Cose\criteria\impl\Criteria;

use Cose\Security\model\UserGroup;

use Rasty\Grid\entitygrid\model\IEntityGridService;
use Rasty\Grid\filter\model\UICriteria;

/**
 * 
 * UI service para Rol.
 * 
 * @author Bernardo
 * @since 27/12/2014
 */
class UIRolService   implements IEntityGridService{
	
	private static $instance;
	
	private function __construct() {}
	
	public static function getInstance() {
		
		if( self::$instance == null ) {
			
			self::$instance = new UIRolService();
			
		}
		return self::$instance; 
	}

	
	
	public function getList( UIRolCriteria $uiCriteria){

		try{
			
			$criteria = $uiCriteria->buildCoreCriteria() ;
			
			$criteria->addOrder("name", "ASC");
			
			$service = \Cose\Security\service\ServiceFactory::getUserGroupService();
			
			$roles = $service->getList( $criteria );
	
			return $roles;
			
		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}
	}
	
	
	public function get( $oid ){

		try{
			
			$service = \Cose\Security\service\ServiceFactory::getUserGroupService();
		
			return $service->get( $oid );
			
		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}
	}
	

	public function add( UserGroup $rol ){

		try{
			$service = \Cose\Security\service\ServiceFactory::getUserGroupService();
		
			return $service->add( $rol );

		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}			

	}
	
	public function update( UserGroup $rol ){

		try{

			$service = \Cose\Security\service\ServiceFactory::getUserGroupService();
		
			return $service->update( $rol );

		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}			

	}
	
	function getEntitiesCount($uiCriteria){

		try{
			
			$criteria = $uiCriteria->buildCoreCriteria() ;
			
			$service = \Cose\Security\service\ServiceFactory::getUserGroupService();
			$roles = $service->getCount( $criteria );
			
			return $roles;
			
		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}
	}
	
	function getEntities($uiCriteria){
		
		return $this->getList($uiCriteria);
	}
	
}
?>