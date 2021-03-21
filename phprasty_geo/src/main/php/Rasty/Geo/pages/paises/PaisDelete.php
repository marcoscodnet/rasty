<?php
namespace Rasty\Geo\pages\paises;

use Cose\Geo\model\Pais;

use Rasty\Geo\service\UIServiceFactory;

use Rasty\Crud\pages\entities\delete\EntityDelete;

use Rasty\utils\XTemplate;
use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;

use Rasty\utils\LinkBuilder;

class PaisDelete extends EntityDelete{

	protected function getEntityService(){
		
		return UIServiceFactory::getUIPaisService();
	}
	

	protected function getLegend(){
		return $this->localize("pais.delete");
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
	
	protected function getDeleteAction(){
		return "BorrarPais";
	}
	
	public function getTitle(){
		return $this->localize( "pais.eliminar.title" );
	}

	protected function getBoxTitle(){
		return $this->localize( "pais.eliminar.title" );
	}
	
}
?>