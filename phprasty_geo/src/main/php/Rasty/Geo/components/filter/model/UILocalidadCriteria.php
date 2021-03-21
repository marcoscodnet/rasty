<?php
namespace Rasty\Geo\components\filter\model;

use Rasty\utils\RastyUtils;
use Rasty\Grid\filter\model\UICriteria;
use Cose\Geo\criteria\LocalidadCriteria;

/**
 * Representa un criterio de búsqueda
 * para Localidad.
 * 
 * @author Bernardo
 * @since 20/08/2015
 *
 */
class UILocalidadCriteria extends UICriteria{


	private $nombre;
	private $codigoPostal;
	private $provincia;
	
		
	public function __construct(){

		parent::__construct();

	}
		
	protected function newCoreCriteria(){
		return new LocalidadCriteria();
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
		$criteria->setCodigoPostal( $this->getCodigoPostal() );
		$criteria->setProvincia( $this->getProvincia() );
		
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


	public function getCodigoPostal()
	{
	    return $this->codigoPostal;
	}

	public function setCodigoPostal($codigoPostal)
	{
	    $this->codigoPostal = $codigoPostal;
	}

	public function getProvincia()
	{
	    return $this->provincia;
	}

	public function setProvincia($provincia)
	{
	    $this->provincia = $provincia;
	}
}