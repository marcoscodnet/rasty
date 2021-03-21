<?php
namespace Rasty\Catalogo\pages\condicionesIva;


use Rasty\Catalogo\conf\RastyCatalogoConfig;

use Rasty\Catalogo\service\UIServiceFactory;

use Rasty\Crud\pages\entities\view\EntityView;

use Cose\Catalogo\model\CondicionIva;

class CondicionIvaView extends EntityView{

	protected function getEntityService(){
		
		return UIServiceFactory::getUICondicionIvaService();
	}
	

	protected function getLegend(){
		return $this->localize("condicionIva.view");
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
		
	public function getTitle(){
		return $this->localize( "condicionIva.consultar.title" );
	}

	protected function getBoxTitle(){
		return $this->localize( "condicionIva.consultar.title" );
	}
	
}
?>