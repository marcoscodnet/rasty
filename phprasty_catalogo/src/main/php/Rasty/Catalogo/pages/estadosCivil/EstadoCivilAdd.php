<?php
namespace Rasty\Catalogo\pages\estadosCivil;

use Rasty\Catalogo\conf\RastyCatalogoConfig;

use Rasty\Crud\pages\entities\add\EntityAdd;

use Cose\Catalogo\model\EstadoCivil;

use Rasty\utils\LinkBuilder;

class EstadoCivilAdd extends EntityAdd{

	/**
	 * EstadoCivil a agregar.
	 * @var EstadoCivil
	 */
	private $estadoCivil;

	protected function getLegend(){
		return $this->localize("estadoCivil.add");
	}
	
	protected function getFormAction(){
		
		return LinkBuilder::getActionUrl( "AgregarEstadoCivil") ;
	}
	
	protected function getBackTo(){
		return "EstadosCivil";
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
		
		$this->setEntity(new EstadoCivil());
		
		
	}
	
	public function getTitle(){
		return $this->localize( "estadoCivil.agregar.title" );
	}

}
?>