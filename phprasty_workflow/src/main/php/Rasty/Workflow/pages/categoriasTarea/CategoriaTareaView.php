<?php
namespace Rasty\Workflow\pages\categoriasTarea;


use Rasty\Workflow\conf\RastyWkfConfig;

use Rasty\Workflow\service\UIServiceFactory;

use Rasty\Crud\pages\entities\view\EntityView;

use Cose\Workflow\model\CategoriaTarea;

class CategoriaTareaView extends EntityView{

	protected function getEntityService(){
		
		return UIServiceFactory::getUICategoriaTareaService();
	}
	

	protected function getLegend(){
		return $this->localize("categoriaTarea.consultar.legend");
	}
	
	protected function getBackTo(){
		return "CategoriasTareaTree";
	}
	
	protected function setEntityBox( $box, $entity ){
		
		$box->setCatalogo( $entity );
		
	}
	
	protected function getBoxType(){
		return "CategoriaTareaBox";
	}	
		
	public function getLayoutType(){
		
		return RastyWkfConfig::getInstance()->getLayoutType();
	}
	
	public function __construct(){

		parent::__construct();
		
		$this->setEntity(new CategoriaTarea());
		
		
	}
		
	public function getTitle(){
		return $this->localize( "categoriaTarea.consultar.title" );
	}

	protected function getBoxTitle(){
		return $this->localize( "categoriaTarea.consultar.title" );
	}
	
}
?>