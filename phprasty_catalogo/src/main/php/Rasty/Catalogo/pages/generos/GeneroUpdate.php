<?php
namespace Rasty\Catalogo\pages\generos;


use Rasty\Catalogo\conf\RastyCatalogoConfig;

use Rasty\Catalogo\service\UIServiceFactory;

use Rasty\Crud\pages\entities\update\EntityUpdate;

use Cose\Catalogo\model\Genero;

use Rasty\utils\LinkBuilder;

class GeneroUpdate extends EntityUpdate{

	protected function getEntityService(){
		
		return UIServiceFactory::getUIGeneroService();
	}
	

	protected function getLegend(){
		return $this->localize("genero.update");
	}
	
	protected function getFormAction(){
		
		return LinkBuilder::getActionUrl( "ModificarGenero") ;
	}
	
	protected function getBackTo(){
		return "Generos";
	}
	
	protected function setEntityForm( $form, $entity ){
		
		$form->setCatalogo( $entity );
		
	}
	
	protected function getFormType(){
		return "CatalogoForm";
	}	
		
	public function getLayoutType(){
		
		return RastyCatalogoConfig::getInstance()->getLayoutType();
	}
	
	public function __construct(){

		parent::__construct();
		
		$this->setEntity( new Genero());
		
		
	}
	
		
	public function getTitle(){
		return $this->localize( "genero.modificar.title" );
	}

}
?>