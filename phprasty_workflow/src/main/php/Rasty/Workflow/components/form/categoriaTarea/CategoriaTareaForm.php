<?php

namespace Rasty\Workflow\components\form\categoriaTarea;

use Rasty\Workflow\service\UIServiceFactory;

use Rasty\Workflow\service\finder\CategoriaTareaFinder;

use Rasty\Catalogo\components\form\catalogo\CatalogoForm;

use Rasty\components\RastyComponent;
use Rasty\utils\XTemplate;
use Rasty\utils\RastyUtils;
use Rasty\utils\LinkBuilder;

/**
 * Formulario para CategoriaTarea

 * @author bernardo
 * @since 04/09/2015
 */
class CategoriaTareaForm extends CatalogoForm{

	private $padre;
	
	public function __construct(){

		parent::__construct();

		$this->addProperty("padre");
		
	}
	
	
	public function getType(){
		
		return "CategoriaTareaForm";
		
	}

	protected function parseXTemplate(XTemplate $xtpl){

		
		parent::parseXTemplate($xtpl);
		
		$xtpl->assign("lbl_padre", $this->localize("categoriaTarea.padre") );
				
		
		
	}

	public function getPadreFinderClazz(){
		
		return  get_class( new CategoriaTareaFinder() );
		
	}

	public function setPadreOid( $padreOid ){
		
		if(!empty($padreOid)){
			
			$padre = UIServiceFactory::getUICategoriaTareaService()->get($padreOid);
			$this->setPadre($padre);
		}
	}

	public function getPadre()
	{
	    return $this->padre;
	}

	public function setPadre($padre)
	{
	    $this->padre = $padre;
	}
}
?>