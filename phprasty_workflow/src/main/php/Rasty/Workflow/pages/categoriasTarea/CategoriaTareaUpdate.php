<?php
namespace Rasty\Workflow\pages\categoriasTarea;

use Rasty\Workflow\conf\RastyWkfConfig;

use Rasty\Workflow\service\UIServiceFactory;

use Cose\Workflow\model\CategoriaTarea;


use Rasty\Crud\pages\entities\update\EntityUpdate;

use Rasty\utils\LinkBuilder;
use Rasty\Catalogo\conf\RastyCatalogoConfig;

class CategoriaTareaUpdate extends EntityUpdate{

	protected function getEntityService(){
		
		return UIServiceFactory::getUICategoriaTareaService();
	}
	

	protected function getLegend(){
		return $this->localize("categoriaTarea.modificar.legend");
	}
	
	protected function getFormAction(){
		
		return LinkBuilder::getActionUrl( "ModificarCategoriaTarea") ;
	}
	
	protected function getBackTo(){
		return "CategoriasTareaTree";
	}
	
	protected function setEntityForm( $form, $entity ){
		
		$form->setCatalogo( $entity );
		
	}
	
	protected function getFormType(){
		return "CategoriaTareaForm";
	}	
		
	public function getLayoutType(){
		
		return RastyWkfConfig::getInstance()->getLayoutType();
	}
	
	public function __construct(){

		parent::__construct();
		
		$this->setEntity( new CategoriaTarea());
		
		
	}
	
		
	public function getTitle(){
		return $this->localize( "categoriaTarea.modificar.title" );
	}

}
?>