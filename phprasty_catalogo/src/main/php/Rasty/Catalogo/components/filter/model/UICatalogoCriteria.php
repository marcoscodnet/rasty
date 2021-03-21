<?php
namespace Rasty\Catalogo\components\filter\model;

use Rasty\utils\RastyUtils;
use Rasty\Grid\filter\model\UICriteria;
use Cose\Catalogo\criteria\CatalogoCriteria;

/**
 * Representa un criterio de búsqueda
 * para Catalogo.
 * 
 * @author Bernardo
 * @since 14/08/2015
 *
 */
class UICatalogoCriteria extends UICriteria{


	private $nombre;
	private $codigo;
	
		
	public function __construct(){

		parent::__construct();

	}
		
	protected function newCoreCriteria(){
		return new CatalogoCriteria();
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