<?php
namespace Rasty\Workflow\components\filter\model;

use Rasty\Workflow\utils\RastyWkfUtils;

use Rasty\utils\RastyUtils;
use Rasty\utils\ReflectionUtils;
use Rasty\Grid\filter\model\UICriteria;

use Cose\Workflow\criteria\TareaCriteria;
use Cose\Workflow\model\EstadoTarea;


/**
 * Representa un criterio de búsqueda
 * para Tarea.
 * 
 * @author Bernardo
 * @since 02/09/2015
 *
 */
class UITareaCriteria extends UICriteria{

	/* constantes para los filtros predefinidos */
	const MISPENDIENTES = "misPendientes";
	const PENDIENTES = "pendientes";
	const SEMANA_ACTUAL = "semanaActual";
	
	private $texto;

	private $fechaDesde;
	
	private $fechaHasta;

	private $responsable;
	
	private $supervisor;
	
	private $padre;
	
	private $padreIsNull;
	
	private $rol;
	
	private $tipoTarea;
	
	private $categoria;
	
	private $estadosIn;

	private $estadosNotIn;

	private $filtroPredefinido;
	
	public function __construct(){

		parent::__construct();

	}
		
	protected function newCoreCriteria(){
		return new TareaCriteria();
	}
	
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
		
		$criteria->setTexto( $this->getTexto() );
		$criteria->setFechaDesde( $this->getFechaDesde() );
		$criteria->setFechaHasta( $this->getFechaHasta() );
		$criteria->setResponsable( $this->getResponsable() );
		$criteria->setRol( $this->getRol() );
		$criteria->setSupervisor( $this->getSupervisor() );
		$criteria->setCategoria( $this->getCategoria() );
		$criteria->setEstadosIn( $this->getEstadosIn() );
		$criteria->setEstadosNotIn( $this->getEstadosNotIn() );
		$criteria->setPadre( $this->getPadre() );
		$criteria->setPadreIsNull( $this->getPadreIsNull() );
		$criteria->setTipoTarea( $this->getTipoTarea() );
		
		return $criteria;
	}



	public function getTexto()
	{
	    return $this->texto;
	}

	public function setTexto($texto)
	{
	    $this->texto = $texto;
	}

	public function getFechaDesde()
	{
	    return $this->fechaDesde;
	}

	public function setFechaDesde($fechaDesde)
	{
	    $this->fechaDesde = $fechaDesde;
	}

	public function getFechaHasta()
	{
	    return $this->fechaHasta;
	}

	public function setFechaHasta($fechaHasta)
	{
	    $this->fechaHasta = $fechaHasta;
	}

	public function getResponsable()
	{
	    return $this->responsable;
	}

	public function setResponsable($responsable)
	{
	    $this->responsable = $responsable;
	}

	public function getSupervisor()
	{
	    return $this->supervisor;
	}

	public function setSupervisor($supervisor)
	{
	    $this->supervisor = $supervisor;
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

	public function getRol()
	{
	    return $this->rol;
	}

	public function setRol($rol)
	{
	    $this->rol = $rol;
	}

	public function getTipoTarea()
	{
	    return $this->tipoTarea;
	}

	public function setTipoTarea($tipoTarea)
	{
	    $this->tipoTarea = $tipoTarea;
	}

	public function getCategoria()
	{
	    return $this->categoria;
	}

	public function setCategoria($categoria)
	{
	    $this->categoria = $categoria;
	}

	public function getEstadosIn()
	{
	    return $this->estadosIn;
	}

	public function setEstadosIn($estadosIn)
	{
	    $this->estadosIn = $estadosIn;
	}

	public function getEstadosNotIn()
	{
	    return $this->estadosNotIn;
	}

	public function setEstadosNotIn($estadosNotIn)
	{
	    $this->estadosNotIn = $estadosNotIn;
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
	
	public function semanaActual(){

		$fechaDesde = RastyWkfUtils::getFirstDayOfWeek( new \Datetime() );
		$fechaHasta = RastyWkfUtils::getLastDayOfWeek( new \Datetime() );
	
		$this->setFechaDesde( $fechaDesde );
		$this->setFechaHasta( $fechaHasta );
	}
			
	public function misPendientes(){

		$responsable = RastyWkfUtils::getUserLogged();
		
		$this->setResponsable($responsable);
		$this->setEstadosIn( array(EstadoTarea::Pendiente) );
		
	}
	
	public function pendientes(){

		$this->setEstadosIn( array(EstadoTarea::Pendiente) );
		
	}
	
}