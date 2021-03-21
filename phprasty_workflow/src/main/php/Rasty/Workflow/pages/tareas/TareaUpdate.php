<?php
namespace Rasty\Workflow\pages\tareas;

use Rasty\Workflow\conf\RastyWkfConfig;

use Cose\Workflow\model\Tarea;

use Rasty\Workflow\service\UIServiceFactory;

use Rasty\Crud\pages\entities\add\EntityAdd;

use Rasty\Crud\pages\entities\update\EntityUpdate;

use Rasty\utils\LinkBuilder;
use Rasty\utils\RastyUtils;

class TareaUpdate extends EntityUpdate{

	protected function getEntityService(){
		
		return UIServiceFactory::getUITareaService();
	}
	

	protected function getLegend(){
		return $this->localize("tarea.modificar.legend");
	}
	
	protected function getFormAction(){
		
		return LinkBuilder::getActionUrl( "ModificarTarea") ;
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
		return $this->localize( "tarea.modificar.title" );
	}

	protected function getBackToParams(){

		$params = parent::getBackToParams();
		
		return $params;
	}
}
?>