<?php
namespace Rasty\Geo\pages\paises;

use Rasty\Geo\service\UIServiceFactory;

use Cose\Geo\model\Pais;


use Rasty\Crud\pages\entities\view\EntityView;

use Rasty\utils\XTemplate;
use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;

use Rasty\utils\LinkBuilder;

class PaisView extends EntityView{

	protected function getEntityService(){
		
		return UIServiceFactory::getUIPaisService();
	}
	

	protected function getLegend(){
		return $this->localize("pais.view");
	}
	
	protected function getBackTo(){
		return "Paises";
	}
	
	protected function setEntityBox( $box, $entity ){
		
		$box->setPais( $entity );
		
	}
	
	protected function getBoxType(){
		return "PaisBox";
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
		return $this->localize( "pais.consultar.title" );
	}

	protected function getBoxTitle(){
		return $this->localize( "pais.consultar.title" );
	}
	
}
?>