<?php
namespace Rasty\Security\components\filter\model;

use Rasty\Grid\filter\model\UICriteria;
use Rasty\utils\RastyUtils;
use Rasty\utils\ReflectionUtils;

/**
 * Representa un criterio de búsqueda.
 * 
 * @author bernardo
 *
 */
abstract class UIRastySecurityCriteria extends UICriteria{

	private $filtroPredefinido;
	
	/**
	 * @var Criteria
	 */
	protected abstract function newCoreCriteria();
	
	public function buildCoreCriteria(){
		
		$criteria = $this->newCoreCriteria();

		$this->initPredefinido();
						
		$criteria->setOrders( $this->getOrders() );
		
		//paginación.
		if($this->getRowPerPage()){
			$criteria->setMaxResult( $this->getRowPerPage() );
			$offset = (($this->getPage()-1) * $this->getRowPerPage() ) ;
			$criteria->setOffset( $offset );
		}
		
		return $criteria;
	}

	public function initPredefinido(){
		
					
		if( !empty($this->filtroPredefinido) ){
			
			//$this->initPredefinido( $this->filtroPredefinido );
			ReflectionUtils::invoke( $this, $this->filtroPredefinido );
		}
	}
	

	public function getFiltroPredefinido()
	{
	    return $this->filtroPredefinido;
	}

	public function setFiltroPredefinido($filtroPredefinido)
	{
	    $this->filtroPredefinido = $filtroPredefinido;
	}
}