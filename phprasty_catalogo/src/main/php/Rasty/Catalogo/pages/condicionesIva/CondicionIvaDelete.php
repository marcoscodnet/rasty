<?php
namespace Rasty\Catalogo\pages\condicionesIva;

use Rasty\Catalogo\conf\RastyCatalogoConfig;

use Rasty\Catalogo\service\UIServiceFactory;

use Rasty\Crud\pages\entities\delete\EntityDelete;
use Cose\Catalogo\model\CondicionIva;

use Rasty\utils\LinkBuilder;

class CondicionIvaDelete extends EntityDelete{

	protected function getEntityService(){
		
		return UIServiceFactory::getUICondicionIvaService();
	}
	

	protected function getLegend(){
		return $this->localize("condicionIva.delete");
	}
	
	protected function getBackTo(){
		return "CondicionesIva";
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
		
		$this->setEntity(new CondicionIva());
		
		
	}
	
	protected function getDeleteAction(){
		return "BorrarCondicionIva";
	}
	
	public function getTitle(){
		return $this->localize( "condicionIva.eliminar.title" );
	}

	protected function getBoxTitle(){
		return $this->localize( "condicionIva.eliminar.title" );
	}
	
}
?>