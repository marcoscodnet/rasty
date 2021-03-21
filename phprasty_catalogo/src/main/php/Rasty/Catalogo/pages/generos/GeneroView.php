<?php
namespace Rasty\Catalogo\pages\generos;


use Rasty\Catalogo\conf\RastyCatalogoConfig;

use Rasty\Catalogo\service\UIServiceFactory;

use Rasty\Crud\pages\entities\view\EntityView;

use Cose\Catalogo\model\Genero;

class GeneroView extends EntityView{

	protected function getEntityService(){
		
		return UIServiceFactory::getUIGeneroService();
	}
	

	protected function getLegend(){
		return $this->localize("genero.view");
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
		
	public function getTitle(){
		return $this->localize( "genero.consultar.title" );
	}

	protected function getBoxTitle(){
		return $this->localize( "genero.consultar.title" );
	}
	
}
?>