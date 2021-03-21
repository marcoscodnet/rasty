<?php
namespace Rasty\Geo\components\filter\model;

use Rasty\utils\RastyUtils;
use Rasty\Grid\filter\model\UICriteria;
use Cose\Geo\criteria\PaisCriteria;

/**
 * Representa un criterio de búsqueda
 * para Pais.
 * 
 * @author Bernardo
 * @since 20/08/2015
 *
 */
class UIPaisCriteria extends UICriteria{


	private $nombre;
	private $codigo;
	
		
	public function __construct(){

		parent::__construct();

	}
		
	protected function newCoreCriteria(){
		return new PaisCriteria();
	}
	
	public function buildCoreCriteria(){
		
		$criteria = $this->newCoreCriteria();
				
		$criteria->setOrders( $this->getOrders() );
		
		//paginación.
		if($this->getRowPerPage()){
			$criteria->setMaxResult( $this->getRowPerPage() );
			$offset = (($this->getPage()-1) * $this->getRowPerPage() ) ;
			$criteria->setOffset( $offset );
		}
		
		$criteria->setNombre( $this->getNombre() );
		$criteria->setCodigo( $this->getCodigo() );
		
		return $criteria;
	}


    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

	public function getCodigo()
	{
	    return $this->codigo;
	}

	public function setCodigo($codigo)
	{
	    $this->codigo = $codigo;
	}
}