<?php
namespace Rasty\Geo\pages\paises;

use Rasty\Crud\pages\entities\add\EntityAdd;

use Rasty\utils\XTemplate;
use Cose\Geo\model\Pais;

use Rasty\utils\LinkBuilder;

class PaisAdd extends EntityAdd{

	/**
	 * Pais a agregar.
	 * @var Pais
	 */
	private $pais;

	protected function getLegend(){
		return $this->localize("pais.add");
	}
	
	protected function getFormAction(){
		
		return LinkBuilder::getActionUrl( "AgregarPais") ;
	}
	
	protected function getBackTo(){
		return "Paises";
	}
	
	protected function setEntityForm( $form, $entity ){
		
		$form->setPais( $entity );
		
	}
	
	protected function getFormType(){
		return "PaisForm";
	}	
		
	public function getLayoutType(){
		
		return "GeoLayout";
	}
	
	public function __construct(){

		parent::__construct();
		
		$pais = new Pais();
		$this->setEntity($pais);
		
		
	}
	
	public function getTitle(){
		return $this->localize( "pais.agregar.title" );
	}

}
?>