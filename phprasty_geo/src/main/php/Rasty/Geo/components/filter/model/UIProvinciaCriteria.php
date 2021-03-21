<?php
namespace Rasty\Geo\components\filter\model;

use Rasty\utils\RastyUtils;
use Rasty\Grid\filter\model\UICriteria;
use Cose\Geo\criteria\ProvinciaCriteria;

/**
 * Representa un criterio de búsqueda
 * para Provincia.
 * 
 * @author Bernardo
 * @since 20/08/2015
 *
 */
class UIProvinciaCriteria extends UICriteria{


	private $nombre;
	private $codigo;
	private $pais;
	
		
	public function __construct(){

		parent::__construct();

	}
		
	protected function newCoreCriteria(){
		return new ProvinciaCriteria();
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
		$criteria->setPais( $this->getPais() );
		
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

	public function getPais()
	{
	    return $this->pais;
	}

	public function setPais($pais)
	{
	    $this->pais = $pais;
	}
}