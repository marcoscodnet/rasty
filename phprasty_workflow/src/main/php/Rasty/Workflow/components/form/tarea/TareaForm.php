<?php

namespace Rasty\Workflow\components\form\tarea;

use Rasty\Workflow\components\input\model\CategoriaTareaInputTreeModel;

use Rasty\Workflow\service\finder\TareaFinder;

use Rasty\Workflow\utils\RastyWkfUtils;

use Rasty\Workflow\service\finder\CategoriaTareaFinder;

use Rasty\Workflow\service\UIServiceFactory;

use Rasty\Workflow\components\filter\model\UICategoriaTareaCriteria;

use Rasty\Workflow\components\filter\catalogo\CategoriaTareaFilter;

use Rasty\Workflow\service\finder\TipoTareaFinder;

use Rasty\Forms\form\Form;

use Rasty\components\RastyComponent;
use Rasty\utils\XTemplate;
use Rasty\utils\RastyUtils;
use Rasty\utils\LinkBuilder;

use Cose\Workflow\model\TipoTarea;
use Cose\Workflow\model\EstadoTarea;
use Cose\Workflow\model\PrioridadTarea;

/**
 * Formulario para Tarea

 * @author bernardo
 * @since 02/09/2015
 */
class TareaForm extends Form{
		
	
	/**
	 * label para el cancel
	 * @var string
	 */
	private $labelCancel;
	

	/**
	 * 
	 * @var Tarea
	 */
	private $tarea;
	
	public function __construct(){

		parent::__construct();
		$this->setLabelCancel("form.cancelar");

		//agregamos las propiedades a popular en el submit.
		$this->addProperty("fecha");
		$this->addProperty("fechaVencimiento");
		$this->addProperty("responsable");
		$this->addProperty("supervisor");
		$this->addProperty("rol");
		$this->addProperty("categoria");
		$this->addProperty("estado");
		$this->addProperty("prioridad");
		$this->addProperty("porcentajeRealizada");
		$this->addProperty("nombre");
		
		$this->setBackToOnSuccess("Tareas");
		$this->setBackToOnCancel("Tareas");

		
	}
	
	public function getOid(){
		
		return $this->getComponentById("oid")->getPopulatedValue( $this->getMethod() );
	}
	
	public function fillEntity($entity){
		
		parent::fillEntity($entity);

		$input = $this->getComponentById("backSuccess");
		$value = $input->getPopulatedValue( $this->getMethod() );
		$this->setBackToOnSuccess($value);

		//uppercase para el nombre.
		$entity->setNombre( strtoupper( $entity->getNombre() ) );
		//$entity->setCodigo( strtoupper( $entity->getCodigo() ) );
		
	}
	
	public function getType(){
		
		return "TareaForm";
		
	}

	protected function parseXTemplate(XTemplate $xtpl){

		$this->fillFromSaved( $this->getTarea() );
		
		parent::parseXTemplate($xtpl);
		
		$xtpl->assign("cancel", $this->getLinkCancel() );
		$xtpl->assign("lbl_cancel", $this->localize( $this->getLabelCancel() ) );
		
		$xtpl->assign("lbl_nombre", $this->localize("tarea.nombre") );
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
		$xtpl->assign("lbl_porcentajeRealizada", $this->localize("tarea.porcentajeRealizada") );
		
		
	}

	public function getLabelCancel()
	{
	    return $this->labelCancel;
	}

	public function setLabelCancel($labelCancel)
	{
	    $this->labelCancel = $labelCancel;
	}


	public function getLinkCancel(){
		$params = array();
		
		return LinkBuilder::getPageUrl( $this->getBackToOnCancel() , $params) ;
	}
	


	public function getTarea()
	{
	    return $this->tarea;
	}

	public function setTarea($tarea)
	{
	    $this->tarea = $tarea;
	}
	
	public function getUsuarioFinderClazz(){
		
		return  get_class( new \Rasty\Security\service\finder\UsuarioFinder() );
		
	}
	
	public function getUsuarios(){
		$criteria = new \Rasty\Security\components\filter\model\UIUsuarioCriteria();
		$usuarios = \Rasty\Security\service\UIServiceFactory::getUIUsuarioService()->getList($criteria);
		return $usuarios;
	}
	
	public function getRolFinderClazz(){
		
		return  get_class( new \Rasty\Security\service\finder\RolFinder() );
		
	}
	
	public function getRoles(){
		$criteria = new \Rasty\Security\components\filter\model\UIRolCriteria();
		$roles = \Rasty\Security\service\UIServiceFactory::getUIRolService()->getList($criteria);
		return $roles;
	}
	
	public function getTiposTarea(){
		
		return array( new TipoTarea() );
	}
	
	public function getTipoTareaFinderClazz(){
		
		return  get_class( new TipoTareaFinder() );
		
	}
	
	public function getCategoriaFinderClazz(){
		
		return  get_class( new CategoriaTareaFinder() );
		
	}
	
	public function getCategoriasModel(){
		
		$model = new CategoriaTareaInputTreeModel();
		
		$criteria = new UICategoriaTareaCriteria();
		$criteria->setPadreIsNull(true);
		$categorias = UIServiceFactory::getUICategoriaTareaService()->getList($criteria);
		
		$model->setEntities($categorias);
		
		return $model;
	}
	
	public function getZCategorias(){
		$criteria = new UICategoriaTareaCriteria();
		$categorias = UIServiceFactory::getUICategoriaTareaService()->getList($criteria);
		return $categorias;
	}
	
	public function getCategorias(){
		
//		$criteria = new UICategoriaTareaCriteria();
//		$criteria->setPadreIsNull(true);
//		$categorias = UIServiceFactory::getUICategoriaTareaService()->getList($criteria);
		
			$options = array(
						array(
							"isgroup"=>1,
							"label" => "Military Status",
							"id" => "Military Status",
							"suboptions" => 
									array(
											array("id"=>"Active-Military","label" => "Active Military"),
											array("id"=>"Military-Dependent","label" => "Military Dependent"),
											array("id"=>"Military-Spouse","label" => "Military Spouse"),
											array("id"=>"National-Guard","label" => "National Guard"),
											array("id"=>"Reservist","label" => "Reservist")
									)
								), 
						
						array(
							"isgroup"=>1,
							"label" => "Service Branch", 
							"id" => "Service Branch", 
							"suboptions" => 
									array(
											array("id"=>"Air-Force","label" => "Air Force"), 
											array("id"=>"Army","label" => "Army"),
											array("id"=>"Coast-Guard","label" => "Coast Guard"),
											array("id"=>"Marine-Corps","label" => "Marine Corps"),
											array("id"=>"Navy","label" => "Navy")
										)	
							), 
						
						array("id"=>"No-Current", "label" => "No Current or Previous Military Affiliation"),
						array("id"=>"veteran", "label" => "Veteran"),
						array("id"=>"Law-Enforcement", "label" => "Law Enforcement"),
						array("id"=>"Government", "label" => "Federal, State, Local Government"),
						array("id"=>"Corporate", "label" => "Corporate"),
						array("id"=>"Student", "label" => "Student"),
						array("id"=>"Other", "label" => "Other")
						);
						
						
		return $options;
	}
	
	public function getEstados(){
		
		return RastyWkfUtils::localizeEntities(EstadoTarea::getItems());
	}
	
	public function getPrioridades(){
		
		return RastyWkfUtils::localizeEntities(PrioridadTarea::getItems());
	}
	
	public function getTareaFinderClazz(){
		
		return get_class( new TareaFinder() );
	}
}
?>