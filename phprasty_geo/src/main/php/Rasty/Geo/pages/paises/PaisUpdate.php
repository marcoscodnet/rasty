<?php
namespace Rasty\Geo\pages\paises;

use Cose\Geo\model\Pais;

use Rasty\Geo\service\UIServiceFactory;

use Rasty\Crud\pages\entities\add\EntityAdd;

use Rasty\Crud\pages\entities\update\EntityUpdate;

use Rasty\utils\LinkBuilder;

class PaisUpdate extends EntityUpdate{

	protected function getEntityService(){
		
		return UIServiceFactory::getUIPaisService();
	}
	

	protected function getLegend(){
		return $this->localize("pais.update");
	}
	
	protected function getFormAction(){
		
		return LinkBuilder::getActionUrl( "ModificarPais") ;
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
		return $this->localize( "pais.modificar.title" );
	}

}
?>