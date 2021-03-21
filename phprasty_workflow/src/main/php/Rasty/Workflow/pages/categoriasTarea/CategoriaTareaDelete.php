<?php
namespace Rasty\Workflow\pages\categoriasTarea;

use Rasty\Workflow\conf\RastyWkfConfig;

use Rasty\Workflow\service\UIServiceFactory;

use Cose\Workflow\model\CategoriaTarea;

use Rasty\Crud\pages\entities\delete\EntityDelete;

use Rasty\utils\LinkBuilder;

use Rasty\Catalogo\conf\RastyCatalogoConfig;

class CategoriaTareaDelete extends EntityDelete{

	protected function getEntityService(){
		
		return UIServiceFactory::getUICategoriaTareaService();
	}
	

	protected function getLegend(){
		return $this->localize("categoriaTarea.eliminar.legend");
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
	
	protected function getDeleteAction(){
		return "BorrarCategoriaTarea";
	}
	
	public function getTitle(){
		return $this->localize( "categoriaTarea.eliminar.title" );
	}

	protected function getBoxTitle(){
		return $this->localize( "categoriaTarea.eliminar.title" );
	}
	
}
?>