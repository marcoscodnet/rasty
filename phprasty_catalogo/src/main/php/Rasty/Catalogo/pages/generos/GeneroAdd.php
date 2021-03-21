<?php
namespace Rasty\Catalogo\pages\generos;

use Rasty\Catalogo\conf\RastyCatalogoConfig;

use Rasty\Crud\pages\entities\add\EntityAdd;

use Cose\Catalogo\model\Genero;

use Rasty\utils\LinkBuilder;

class GeneroAdd extends EntityAdd{

	/**
	 * Genero a agregar.
	 * @var Genero
	 */
	private $genero;

	protected function getLegend(){
		return $this->localize("genero.add");
	}
	
	protected function getFormAction(){
		
		return LinkBuilder::getActionUrl( "AgregarGenero") ;
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
		
		$this->setEntity(new Genero());
		
		
	}
	
	public function getTitle(){
		return $this->localize( "genero.agregar.title" );
	}

}
?>