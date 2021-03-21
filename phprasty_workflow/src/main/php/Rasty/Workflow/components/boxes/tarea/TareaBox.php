<?php

namespace Rasty\Workflow\components\boxes\tarea;

use Rasty\Workflow\utils\RastyWkfUtils;

use Rasty\components\RastyComponent;
use Rasty\utils\RastyUtils;

use Rasty\utils\XTemplate;
use Rasty\i18n\Locale;

use Rasty\utils\LinkBuilder;

/**
 * Box para visualizar información de una Tarea.
 * 
 * @author Bernardo
 * @since 02-09-2015
 */
class TareaBox extends RastyComponent{
		
	private $tarea;
	
	public function getType(){
		
		return "TareaBox";
		
	}

	public function __construct(){

		
	}

	protected function parseLabels(XTemplate $xtpl){
		
		$xtpl->assign("lbl_fecha", $this->localize("tarea.fecha") );
		$xtpl->assign("lbl_fechaVencimiento", $this->localize("tarea.fechaVencimiento") );
		$xtpl->assign("lbl_responsable", $this->localize("tarea.responsable") );
		$xtpl->assign("lbl_rol", $this->localize("tarea.rol") );
		$xtpl->assign("lbl_supervisor", $this->localize("tarea.supervisor") );
		$xtpl->assign("lbl_categoria", $this->localize("tarea.categoria") );
		$xtpl->assign("lbl_tipoTarea", $this->localize("tarea.tipoTarea") );
		$xtpl->assign("lbl_estado", $this->localize("tarea.estado") );
		$xtpl->assign("lbl_padre", $this->localize("tarea.padre") );
		$xtpl->assign("lbl_prioridad", $this->localize("tarea.prioridad") );
		$xtpl->assign("lbl_observaciones", $this->localize("tarea.observaciones") );
		
	}
	
	protected function parseXTemplate(XTemplate $xtpl){
		
		/*labels*/
		$this->parseLabels($xtpl);
		
		$tarea = $this->getTarea();
		
		if( !empty($tarea) ){
			
			$xtpl->assign("fecha", RastyWkfUtils::formatDateToView( $tarea->getFecha() ) );
			$xtpl->assign("fechaVencimiento", RastyWkfUtils::formatDateToView( $tarea->getFechaVencimiento() ) );
			$xtpl->assign("responsable", $tarea->getResponsable() );
			$xtpl->assign("rol", $tarea->getRol() );
			$xtpl->assign("supervisor", $tarea->getSupervisor() );
			$xtpl->assign("categoria", $tarea->getCategoria() );
			$xtpl->assign("tipoTarea", $this->localize($tarea->getTipoTarea()->getNombre()) );
			$xtpl->assign("estado", RastyWkfUtils::getEstadoTareaLabel( $tarea->getEstado() ) );
			$xtpl->assign("estadoCss", RastyWkfUtils::getEstadoTareaCss( $tarea->getEstado() ) );
			$xtpl->assign("padre", $tarea->getPadre() );
			$xtpl->assign("prioridad", RastyWkfUtils::getPrioridadTareaLabel( $tarea->getPrioridad() ) );
			$xtpl->assign("prioridadCss", RastyWkfUtils::getPrioridadTareaCss( $tarea->getPrioridad() ) );
			$xtpl->assign("observaciones", $tarea->getObservaciones() );
		}
						
	}
	


	public function getTarea()
	{
	    return $this->tarea;
	}

	public function setTarea($tarea)
	{
	    $this->tarea = $tarea;
	}
}
?>