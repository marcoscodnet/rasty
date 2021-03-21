<?php
namespace Rasty\Workflow\components\filter\model;

use Rasty\utils\RastyUtils;

use Cose\Workflow\criteria\CategoriaTareaCriteria;

use Rasty\Catalogo\components\filter\model\UICatalogoCriteria;

/**
 * Representa un criterio de búsqueda
 * para Tarea.
 * 
 * @author Bernardo
 * @since 02/09/2015
 *
 */
class UICategoriaTareaCriteria extends UICatalogoCriteria{


	private $padre;
		
	private $padreIsNull;
	
	public function __construct(){

		parent::__construct();

	}
		
	protected function newCoreCriteria(){
		return new CategoriaTareaCriteria();
	}
	
	public function buildCoreCriteria(){
		
		$criteria = parent::buildCoreCriteria();
				
		$criteria->setPadre( $this->getPadre() );
		$criteria->setPadreIsNull( $this->getPadreIsNull() );
		return $criteria;
	}



	public function getPadre()
	{
	    return $this->padre;
	}

	public function setPadre($padre)
	{
	    $this->padre = $padre;
	}


	public function getPadreIsNull()
	{
	    return $this->padreIsNull;
	}

	public function setPadreIsNull($padreIsNull)
	{
	    $this->padreIsNull = $padreIsNull;
	}
}