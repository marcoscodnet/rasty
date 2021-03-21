<?php
namespace Rasty\Catalogo\pages\generos;

use Rasty\Catalogo\conf\RastyCatalogoConfig;

use Rasty\Catalogo\service\UIServiceFactory;

use Rasty\Crud\pages\entities\delete\EntityDelete;
use Cose\Catalogo\model\Genero;

use Rasty\utils\LinkBuilder;

class GeneroDelete extends EntityDelete{

	protected function getEntityService(){
		
		return UIServiceFactory::getUIGeneroService();
	}
	

	protected function getLegend(){
		return $this->localize("genero.delete");
	}
	
	protected function getBackTo(){
		return "Generos";
	}
	
	protected function setEntityBox( $box, $entity ){
		
		$box->setCatalogo( $entity );
		
	}
	
	protected function getBoxType(){
		return "CatalogoBox";
	}	
		
	public function getLayoutType(){
		
		return RastyCatalogoConfig::getInstance()->getLayoutType();
	}
	
	public function __construct(){

		parent::__construct();
		
		$this->setEntity(new Genero());
		
		
	}
	
	protected function getDeleteAction(){
		return "BorrarGenero";
	}
	
	public function getTitle(){
		return $this->localize( "genero.eliminar.title" );
	}

	protected function getBoxTitle(){
		return $this->localize( "genero.eliminar.title" );
	}
	
}
?>