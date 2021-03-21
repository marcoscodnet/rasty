<?php
namespace Rasty\Catalogo\pages\estadosCivil;

use Rasty\Catalogo\conf\RastyCatalogoConfig;

use Rasty\Catalogo\service\UIServiceFactory;

use Rasty\Crud\pages\entities\delete\EntityDelete;
use Cose\Catalogo\model\EstadoCivil;

use Rasty\utils\LinkBuilder;

class EstadoCivilDelete extends EntityDelete{

	protected function getEntityService(){
		
		return UIServiceFactory::getUIEstadoCivilService();
	}
	

	protected function getLegend(){
		return $this->localize("estadoCivil.delete");
	}
	
	protected function getBackTo(){
		return "EstadosCivil";
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
		
		$this->setEntity(new EstadoCivil());
		
		
	}
	
	protected function getDeleteAction(){
		return "BorrarEstadoCivil";
	}
	
	public function getTitle(){
		return $this->localize( "estadoCivil.eliminar.title" );
	}

	protected function getBoxTitle(){
		return $this->localize( "estadoCivil.eliminar.title" );
	}
	
}
?>