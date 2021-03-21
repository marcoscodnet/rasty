<?php
namespace Rasty\Workflow\service\finder;


use Rasty\Workflow\components\filter\model\UITareaCriteria;

use Rasty\Workflow\service\UIServiceFactory;

use Rasty\Forms\finder\model\IAutocompleteFinder;

use Rasty\exception\RastyException;

/**
 * 
 * Finder para Tareas.
 * 
 * @author Bernardo
 * @since 02/09/2015
 */
class TareaFinder implements  IAutocompleteFinder {

	public function __construct() {}
	
	private function getUIService(){
		return UIServiceFactory::getUITareaService();
	}
	
	/**
	 * (non-PHPdoc)
	 * @see service/finder/Rasty\Forms\finder\model.IAutocompleteFinder::findEntitiesByText()
	 */
	public function findEntitiesByText( $text, $parent=null ){
		
		$uiCriteria = new UITareaCriteria();
		$uiCriteria->setTexto( $text );
		$uiCriteria->setRowPerPage( 10 );
		return $this->getUIService()->getList($uiCriteria);	
	}
	
	
	/**
	 * (non-PHPdoc)
	 * @see service/finder/Rasty\Forms\finder\model.IAutocompleteFinder::findEntityByCode()
	 */
	function findEntityByCode( $code, $parent=null ){
		
		try {
			
			return $this->getUIService()->get( $code );
			
		} catch (RastyException $e) {
			
			return null;
			
		}
	}
	
	/**
	 * (non-PHPdoc)
	 * @see service/finder/Rasty\Forms\finder\model.IAutocompleteFinder::getAttributes()
	 */
	public function getAttributes(){
		return array("oid", "nombre", "fechaFormateada", "responsable", "rol");
	}

	/**
	 * (non-PHPdoc)
	 * @see service/finder/Rasty\Forms\finder\model.IAutocompleteFinder::getAttributesCallback()
	 */
	public function getAttributesCallback(){
		return array("oid", "nombre", "fechaFormateada", "responsable", "rol");		
	}
	
	/**
	 * (non-PHPdoc)
	 * @see service/finder/Rasty\Forms\finder\model.IAutocompleteFinder::getEntityCode()
	 */
	function getEntityCode( $entity ){
		if( !empty( $entity)  )
		
		return $entity->getOid();
	}
	
	/**
	 * (non-PHPdoc)
	 * @see service/finder/Rasty\Forms\finder\model.IAutocompleteFinder::getEntityLabel()
	 */
	function getEntityLabel( $entity ){
		if( !empty( $entity)  )
		return $entity->__toString();
	}

	/**
	 * (non-PHPdoc)
	 * @see service/finder/Rasty\Forms\finder\model.IAutocompleteFinder::getEntityFieldCode()
	 */
	function getEntityFieldCode( $entity ){
		return "oid";
	}
	
	/**
	 * mensaje para cuando no hay resultados.
	 * @var string
	 */
	function getEmptyResultLabel(){
		return null;
	}
	
	/**
	 * label para agregar una nueva entity
	 * @var string
	 */
	function getAddEntityLabel(){
		return null;
	}
	
	/**
	 * función javascript a ejecutar para agregar una nueva entity.
	 * si esta property es definida se muestra el link cuando
	 * no hay resultados
	 * @var string
	 */
	function getOnclickAdd(){
		return "";
	}

}
?>