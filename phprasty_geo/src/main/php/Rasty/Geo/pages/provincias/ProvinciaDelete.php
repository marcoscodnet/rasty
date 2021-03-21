<?php
namespace Rasty\Geo\pages\provincias;

use Cose\Geo\model\Provincia;

use Rasty\Geo\service\UIServiceFactory;

use Rasty\Crud\pages\entities\delete\EntityDelete;

use Rasty\utils\XTemplate;
use Rasty\utils\RastyUtils;

use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;

use Rasty\utils\LinkBuilder;

class ProvinciaDelete extends EntityDelete{

	protected function getEntityService(){
		
		return UIServiceFactory::getUIProvinciaService();
	}
	
	protected function getBackToParams(){

		$params = parent::getBackToParams();
		
		//si viene el pais se lo seteo.
		$paisOid = RastyUtils::getParamGET("paisOid");
		if(!empty($paisOid)){
			$params["paisOid"] = $paisOid;
		}
		
		return $params;
	}
	
	protected function getLegend(){
		return $this->localize("provincia.delete");
	}
	
	protected function getBackTo(){
		return "Provincias";
	}
	
	protected function setEntityBox( $box, $entity ){
		
		$box->setProvincia( $entity );
		
	}
	
	protected function getBoxType(){
		return "ProvinciaBox";
	}	
		
	public function getLayoutType(){
		
		return "GeoLayout";
	}
	
	public function __construct(){

		parent::__construct();
		
		$provincia = new Provincia();
		
		$this->setEntity($provincia);
		
		
	}
	
	protected function getDeleteAction(){
		return "BorrarProvincia";
	}
	
	public function getTitle(){
		return $this->localize( "provincia.eliminar.title" );
	}

	protected function getBoxTitle(){
		return $this->localize( "provincia.eliminar.title" );
	}
	
}
?>