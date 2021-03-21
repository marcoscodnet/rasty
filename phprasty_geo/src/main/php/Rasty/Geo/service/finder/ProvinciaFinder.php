<?php
namespace Rasty\Geo\service\finder;


use Rasty\Geo\components\filter\model\UIProvinciaCriteria;

use Rasty\Geo\service\UIServiceFactory;

use Rasty\Forms\finder\model\IAutocompleteFinder;

use Rasty\exception\RastyException;

/**
 * 
 * Finder para Provincias.
 * 
 * @author Bernardo
 * @since 20/08/2015
 */
class ProvinciaFinder implements  IAutocompleteFinder {

	public function __construct() {}
	
	private function getUIService(){
		return UIServiceFactory::getUIProvinciaService();
	}
	
	/**
	 * (non-PHPdoc)
	 * @see service/finder/Rasty\Forms\finder\model.IAutocompleteFinder::findEntitiesByText()
	 */
	public function findEntitiesByText( $text, $parent=null ){
		
		$uiCriteria = new UIProvinciaCriteria();
		$uiCriteria->setNombre( $text );
		//$uiCriteria->setPais( $parent );
		$uiCriteria->setRowPerPage( 10 );
		return $this->getUIService()->getList($uiCriteria);	
	}
	
	/**
	 * (non-PHPdoc)
	 * @see service/finder/Rasty\Forms\finder\model.IAutocompleteFinder::findEntityByCode()
	 */
	function findEntityByCode( $code, $parent=null ){
		
		$uiCriteria = new UIProvinciaCriteria();
		$uiCriteria->setCodigo( $code );
		//$uiCriteria->setPais( $parent );
		//$uiCriteria->setRowPerPage( 1 );
		
		try {

			return $this->getUIService()->getSingleResult( $uiCriteria );
			
		} catch (RastyException $e) {
			
			return null;
			
		}
		
	}
	
	/**
	 * (non-PHPdoc)
	 * @see service/finder/Rasty\Forms\finder\model.IAutocompleteFinder::getAttributes()
	 */
	public function getAttributes(){
		return array("nombre", "codigo");
	}

	/**
	 * (non-PHPdoc)
	 * @see service/finder/Rasty\Forms\finder\model.IAutocompleteFinder::getAttributesCallback()
	 */
	public function getAttributesCallback(){
		return array("oid", "nombre", "codigo");		
	}
	
	/**
	 * (non-PHPdoc)
	 * @see service/finder/Rasty\Forms\finder\model.IAutocompleteFinder::getEntityCode()
	 */
	function getEntityCode( $entity ){
		if( !empty( $entity)  )
		
		return $entity->getCodigo();
	}
	
	/**
	 * (non-PHPdoc)
	 * @see service/finder/Rasty\Forms\finder\model.IAutocompleteFinder::getEntityLabel()
	 */
	function getEntityLabel( $entity ){
		if( !empty( $entity)  )
		return $entity->getNombre();
	}

	/**
	 * (non-PHPdoc)
	 * @see service/finder/Rasty\Forms\finder\model.IAutocompleteFinder::getEntityFieldCode()
	 */
	function getEntityFieldCode( $entity ){
		return "codigo";
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