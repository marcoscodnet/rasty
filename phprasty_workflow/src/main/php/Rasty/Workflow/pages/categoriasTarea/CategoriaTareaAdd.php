<?php
namespace Rasty\Workflow\pages\categoriasTarea;

use Rasty\Workflow\conf\RastyWkfConfig;

use Cose\Workflow\model\CategoriaTarea;

use Rasty\Crud\pages\entities\add\EntityAdd;

use Rasty\utils\LinkBuilder;

use Rasty\Catalogo\conf\RastyCatalogoConfig;

class CategoriaTareaAdd extends EntityAdd{

	/**
	 * CategoriaTarea a agregar.
	 * @var CategoriaTarea
	 */
	private $categoriaTarea;

	protected function getLegend(){
		return $this->localize("categoriaTarea.agregar.legend");
	}
	
	protected function getFormAction(){
		
		return LinkBuilder::getActionUrl( "AgregarCategoriaTarea") ;
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
		
		$this->setEntity(new CategoriaTarea());
		
		
	}
	
	public function getTitle(){
		return $this->localize( "categoriaTarea.agregar.title" );
	}

}
?>