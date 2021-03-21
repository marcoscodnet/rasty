<?php
namespace Rasty\Catalogo\pages\estadosCivil;


use Rasty\Catalogo\conf\RastyCatalogoConfig;

use Rasty\Catalogo\service\UIServiceFactory;

use Rasty\Crud\pages\entities\view\EntityView;

use Cose\Catalogo\model\EstadoCivil;

class EstadoCivilView extends EntityView{

	protected function getEntityService(){
		
		return UIServiceFactory::getUIEstadoCivilService();
	}
	

	protected function getLegend(){
		return $this->localize("estadoCivil.view");
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
		
	public function getTitle(){
		return $this->localize( "estadoCivil.consultar.title" );
	}

	protected function getBoxTitle(){
		return $this->localize( "estadoCivil.consultar.title" );
	}
	
}
?>