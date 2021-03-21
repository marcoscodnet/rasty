<?php
namespace Rasty\Geo\pages\provincias;

use Rasty\Geo\service\UIServiceFactory;

use Cose\Geo\model\Provincia;


use Rasty\Crud\pages\entities\view\EntityView;

use Rasty\utils\XTemplate;
use Rasty\utils\RastyUtils;

use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;

use Rasty\utils\LinkBuilder;

class ProvinciaView extends EntityView{

	protected function getEntityService(){
		
		return UIServiceFactory::getUIProvinciaService();
	}
	

	protected function getLegend(){
		return $this->localize("provincia.view");
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
	
	public function getTitle(){
		return $this->localize( "provincia.consultar.title" );
	}

	protected function getBoxTitle(){
		return $this->localize( "provincia.consultar.title" );
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
}
?>