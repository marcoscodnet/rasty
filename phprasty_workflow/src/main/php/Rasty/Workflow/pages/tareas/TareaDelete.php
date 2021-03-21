<?php
namespace Rasty\Workflow\pages\tareas;

use Rasty\Workflow\conf\RastyWkfConfig;

use Cose\Workflow\model\Tarea;

use Rasty\Workflow\service\UIServiceFactory;

use Rasty\Crud\pages\entities\delete\EntityDelete;

use Rasty\utils\XTemplate;
use Rasty\utils\RastyUtils;

use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;

use Rasty\utils\LinkBuilder;

class TareaDelete extends EntityDelete{

	protected function getEntityService(){
		
		return UIServiceFactory::getUITareaService();
	}
	
	protected function getBackToParams(){

		$params = parent::getBackToParams();
		
		return $params;
	}
	
	protected function getLegend(){
		return $this->localize("tarea.eliminar.legend");
	}
	
	protected function getBackTo(){
		return "Tareas";
	}
	
	protected function setEntityBox( $box, $entity ){
		
		$box->setTarea( $entity );
		
	}
	
	protected function getBoxType(){
		return "TareaBox";
	}	
		
	public function getLayoutType(){
		
		return RastyWkfConfig::getInstance()->getLayoutType();
	}
	
	public function __construct(){

		parent::__construct();
		
		$tarea = new Tarea();
		
		$this->setEntity($tarea);
		
		
	}
	
	protected function getDeleteAction(){
		return "BorrarTarea";
	}
	
	public function getTitle(){
		return $this->localize( "tarea.eliminar.title" );
	}

	protected function getBoxTitle(){
		return $this->localize( "tarea.eliminar.title" );
	}
	
}
?>