<?php
namespace Rasty\Forms\finderpopup;

use Rasty\Forms\finder\model\IAutocompleteFinder;

use Rasty\utils\RastyUtils;
use Rasty\utils\XTemplate;
use Rasty\utils\ReflectionUtils;
use Rasty\exception\RastyException;

use Rasty\components\RastyComponent;

use Rasty\factory\ComponentConfig;
use Rasty\factory\ComponentFactory;
/**
 * se consultan entities para seleccionar una de ellas
 * 
 * @author bernardo
 * @since 08/08/2013
 */
class FinderPopup extends RastyComponent{


	private $onSelectCallback;
	
	protected $filterType;
	
	protected $filter;


		
	/**
	 * para determinar si incluye la opción de agregar una nueva entity.
	 * @var boolean
	 */
	private $hasAddEntity;

	/**
	 * javascript a llamar para agregar una entity.
	 * (para cuando no se encuentran resultados en la búsqueda)
	 * @var string
	 */
	protected $onClickAddCallback;
	
	/**
	 * label para agregar una entity.
	 * (para cuando no se encuentran resultados en la búsqueda)
	 * @var string
	 */
	protected $msgAdd;
	
	/**
	 * mensaje para cuando no se encuentran resultados en la búsqueda.
	 * @var string
	 */
	protected $msgEmptyResult;	
	/**
	 * texto inicial para la búsqueda.
	 * @var string
	 */
	protected $initialText;
	
	/**
	 * id del div donde se renderiza el popup
	 * @var string
	 */
	protected $popupDivId;
	
	
	public function getType(){
		
		return "FinderPopup";
	}
	
	protected function parseXTemplate(XTemplate $xtpl){
		$xtpl->assign("legend_resultados", $this->localize("filter.resultados") );
		$xtpl->assign("searchDivId", $this->filterType . "_searchDiv" );
		$xtpl->assign("filterDivId", $this->filterType . "_filterDiv" );
		$xtpl->assign("popupDivId", $this->popupDivId );
		
		if( $this->hasAddEntity ){
			$xtpl->assign("label_add", $this->getMsgAdd() );
			$xtpl->assign("onClickAdd", $this->getOnClickAddCallback() );
			$xtpl->parse("main.opciones.add");
		}

		
		$xtpl->assign("label_close", $this->localize("filter.close.label")  );
		
		$xtpl->assign("legend_opciones", $this->localize("filter.opciones") );
		$xtpl->parse("main.opciones");
		
	}
	

	public function getFilterType()
	{
	    return $this->filterType;
	}

	public function setFilterType($filterType)
	{
	    $this->filterType = $filterType;
	    
	    //generamos el filter a partir del type.
	    $componentConfig = new ComponentConfig();
	    $componentConfig->setId( "filter" );
		$componentConfig->setType( $filterType );
		
		//TODO esto setearlo en el .rasty
	    $this->filter = ComponentFactory::buildByType($componentConfig, $this);
	    $this->filter->setLegend( $this->localize("filter.buscar") );
	    $this->filter->setLegendAgain( $this->localize("filter.buscar.again") );
	    $this->filter->setResultDiv( $filterType . "_searchDiv" . $this->getId() );
	    $this->filter->setSelectRowCallback( $this->getOnSelectCallback() );
	    
	    $this->filter->setInitialText( $this->getInitialText() );
	    
	    
	    $this->filter->setHasAddEntity( $this->getHasAddEntity() );
	    $this->filter->setOnClickAddCallback( $this->getOnClickAddCallback() );
	    $this->filter->setMsgAdd( $this->getMsgAdd() );
	    $this->filter->setMsgEmptyResult( $this->getMsgEmptyResult() );
	}

	public function getFilter()
	{
	    return $this->filter;
	}

	public function setFilter($filter)
	{
	    $this->filter = $filter;
	}

	public function getOnSelectCallback()
	{
	    return $this->onSelectCallback;
	}

	public function setOnSelectCallback($onSelectCallback)
	{
	    $this->onSelectCallback = $onSelectCallback;
	}

	public function getInitialText()
	{
	    return $this->initialText;
	}

	public function setInitialText($initialText)
	{
	    $this->initialText = $initialText;
	}

	public function getPopupDivId()
	{
	    return $this->popupDivId;
	}

	public function setPopupDivId($popupDivId)
	{
	    $this->popupDivId = $popupDivId;
	}

	public function getOnClickAddCallback()
	{
	    return $this->onClickAddCallback;
	}

	public function setOnClickAddCallback($onClickAddCallback)
	{
	    $this->onClickAddCallback = $onClickAddCallback;
	}

	public function getMsgAdd()
	{
	    return $this->msgAdd;
	}

	public function setMsgAdd($msgAdd)
	{
	    $this->msgAdd = $msgAdd;
	}

	public function getMsgEmptyResult()
	{
	    return $this->msgEmptyResult;
	}

	public function setMsgEmptyResult($msgEmptyResult)
	{
	    $this->msgEmptyResult = $msgEmptyResult;
	}

	public function getHasAddEntity()
	{
	    return $this->hasAddEntity;
	}

	public function setHasAddEntity($hasAddEntity)
	{
	    $this->hasAddEntity = $hasAddEntity;
	}
}
?>