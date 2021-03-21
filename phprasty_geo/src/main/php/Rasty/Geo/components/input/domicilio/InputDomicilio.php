<?php	
namespace Rasty\Geo\components\input\domicilio;

use Rasty\Geo\service\finder\PaisFinder;

use Rasty\Geo\components\filter\model\UIPaisCriteria;

use Rasty\Geo\components\filter\model\UILocalidadCriteria;

use Rasty\Geo\service\finder\LocalidadFinder;

use Rasty\Geo\service\finder\ProvinciaFinder;

use Rasty\Geo\components\filter\model\UIProvinciaCriteria;

use Rasty\Geo\service\UIServiceFactory;

use Cose\Geo\model\Pais;
use Cose\Geo\model\Provincia;


use Rasty\components\RastyComponent;
use Rasty\utils\XTemplate;
use Rasty\utils\RastyUtils;
use Rasty\utils\ReflectionUtils;
use Rasty\Forms\input\InputText;


use Cose\Geo\model\Domicilio;

/**
 * Input para un domicilio.
 * 
 * @author bernardo
 * @since 21/08/2015
 */
class InputDomicilio extends InputText{

	private $domicilio;
	
	public function __construct(){

		parent::__construct();
		
	}
	
	private function setValueInterno( $componentId, $value ){
		
		$input = $this->getComponentById( $componentId );
		if(!empty($input))
			$input->setValue($value);
		
	}
	
	private function getPopulatedValueInterno( $componentId, $method="POST" ){
		
		$input = $this->getComponentById( $componentId );
		if(!empty($input))
			$value = $input->getPopulatedValue($method);
		else
			$value = null;

		return $value;	
	}
	
	public function setValue($value)
	{
		parent::setValue($value);

		if($value!=null)
			$this->domicilio = $value;
		else 
			$this->domicilio = new Domicilio();	
		
		$this->setValueInterno( "calle", $this->domicilio->getCalle() );
		$this->setValueInterno( "numero", $this->domicilio->getNumero() );
		$this->setValueInterno( "piso", $this->domicilio->getPiso() );
		$this->setValueInterno( "depto", $this->domicilio->getDepto() );
		$localidad = $this->domicilio->getLocalidad();
		$this->setValueInterno( "localidad", $localidad );
		
		
		
	}
	
	protected function parseXTemplate(XTemplate $xtpl){

		
		parent::parseXTemplate($xtpl);

		$xtpl->assign("lbl_calle", $this->localize("domicilio.calle") );
		$xtpl->assign("lbl_numero", $this->localize("domicilio.numero") );
		$xtpl->assign("lbl_piso", $this->localize("domicilio.piso") );
		$xtpl->assign("lbl_depto", $this->localize("domicilio.depto") );
		$xtpl->assign("lbl_localidad", $this->localize("domicilio.localidad") );
		$xtpl->assign("lbl_codigoPostal", $this->localize("domicilio.codigoPostal") );
		
	}
	
	/**
	 * retorna el valor populado en el input.
	 * @param string $method
	 */
	public function getPopulatedValue($method="POST"){
		
		
		$calle = strtoupper( $this->getPopulatedValueInterno( "calle", $method ) ); 
		$numero = $this->getPopulatedValueInterno( "numero", $method );
		$piso = $this->getPopulatedValueInterno( "piso", $method );
		$depto = $this->getPopulatedValueInterno( "depto", $method );
		$localidad = $this->getPopulatedValueInterno( "localidad", $method );
		
		$value = $this->domicilio;
		$value->setCalle( $calle );
		$value->setNumero( $numero );
		$value->setPiso( $piso );
		$value->setDepto( $depto );
		$value->setLocalidad( $localidad );
		
		return  $this->formatValue( $value );
	}
	
	//
//	/**
//	 * (non-PHPdoc)
//	 * @see input/Rasty\Forms\input.InputText::unformatValue()
//	 */
//	public function unformatValue($value){
//		$finder = ReflectionUtils::newInstance( $this->getFinder() );
//		return  $finder->getEntityCode( $value );
//	}
	
	/**
	 * (non-PHPdoc)
	 * @see input/Rasty\Forms\input.InputText::formatValue()
	 */
	public function formatValue($value){

		//redefinimos ya que se popula el id de la entity.
		//entonces a partir del id buscamos la entity
		return $value;
		//$finder = ReflectionUtils::newInstance( $this->getFinder() );
		
		//return  $finder->findEntityByCode( $value );
	}
	
	
	public function initDefaults(){

		parent::initDefaults();
		
	}
	
	public function getType(){
		
		return "InputDomicilio";
	}


	public function getDomicilio()
	{
	    return $this->domicilio;
	}

	public function setDomicilio($domicilio)
	{
	    $this->domicilio = $domicilio;
	}
	
	
	public function getLocalidadFinderClazz(){
		
		return get_class( new LocalidadFinder() ) ;
		
	}	

}
?>