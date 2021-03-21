<?php
namespace Rasty\Geo\service\finder;


use Rasty\Geo\components\filter\model\UILocalidadCriteria;

use Rasty\Geo\service\UIServiceFactory;

use Rasty\Forms\finder\model\IAutocompleteFinder;

use Rasty\exception\RastyException;

/**
 * 
 * Finder para Localidades.
 * 
 * @author Bernardo
 * @since 20/08/2015
 */
class LocalidadFinder implements  IAutocompleteFinder {

	public function __construct() {}
	
	private function getUIService(){
		return UIServiceFactory::getUILocalidadService();
	}
	
	/**
	 * (non-PHPdoc)
	 * @see service/finder/Rasty\Forms\finder\model.IAutocompleteFinder::findEntitiesByText()
	 */
	public function findEntitiesByText( $text, $parent=null ){
		
		$uiCriteria = new UILocalidadCriteria();
		$uiCriteria->setNombre( $text );
		$uiCriteria->setProvincia( $this->getParentByCode($parent) );
		$uiCriteria->setRowPerPage( 10 );
		return $this->getUIService()->getList($uiCriteria);	
	}
	
	
	private function getParentByCode($code){
		$provincia = null;
		
		if($code){
			$finder = new ProvinciaFinder();
			$provincia = $finder->findEntityByCode($code);
		}
	
		return $provincia;		
	}
	
	/**
	 * (non-PHPdoc)
	 * @see service/finder/Rasty\Forms\finder\model.IAutocompleteFinder::findEntityByCode()
	 */
	function findEntityByCode( $code, $parent=null ){
		
		$uiCriteria = new UILocalidadCriteria();
		$uiCriteria->setCodigoPostal( $code );
		$uiCriteria->setProvincia( $this->getParentByCode($parent) );		
		
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
		return array("codigoPostal", "provincia.nombre", "provincia.pais.nombre");
	}

	/**
	 * (non-PHPdoc)
	 * @see service/finder/Rasty\Forms\finder\model.IAutocompleteFinder::getAttributesCallback()
	 */
	public function getAttributesCallback(){
		return array("oid", "nombre", "codigoPostal");		
	}
	
	/**
	 * (non-PHPdoc)
	 * @see service/finder/Rasty\Forms\finder\model.IAutocompleteFinder::getEntityCode()
	 */
	function getEntityCode( $entity ){
		if( !empty( $entity)  )
		
		return $entity->getCodigoPostal();
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
		return "codigoPostal";
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