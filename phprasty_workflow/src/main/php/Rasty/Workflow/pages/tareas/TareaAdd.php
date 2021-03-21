<?php
namespace Rasty\Workflow\pages\tareas;

use Rasty\Workflow\conf\RastyWkfConfig;

use Rasty\Crud\pages\entities\add\EntityAdd;

use Rasty\utils\XTemplate;
use Rasty\utils\RastyUtils;

use Cose\Workflow\model\Tarea;

use Rasty\utils\LinkBuilder;

class TareaAdd extends EntityAdd{

	/**
	 * Tarea a agregar.
	 * @var Tarea
	 */
	private $tarea;

	protected function getLegend(){
		return $this->localize("tarea.agregar.legend");
	}
	
	protected function getFormAction(){
		
		return LinkBuilder::getActionUrl( "AgregarTarea") ;
	}
	
	protected function getBackTo(){
		return "Tareas";
	}
	
	protected function setEntityForm( $form, $entity ){
		

		$form->setTarea( $entity );
	}
	
	protected function getFormType(){
		return "TareaForm";
	}	
		
	public function getLayoutType(){
		
		return RastyWkfConfig::getInstance()->getLayoutType();
	}
	
	public function __construct(){

		parent::__construct();
		
		$tarea = new Tarea();

		
		$this->setEntity($tarea);
		
		
	}
	
	public function getTitle(){
		return $this->localize( "tarea.agregar.title" );
	}

	protected function getBackToParams(){

		$params = parent::getBackToParams();
		
		return $params;
	}
	
}
?>