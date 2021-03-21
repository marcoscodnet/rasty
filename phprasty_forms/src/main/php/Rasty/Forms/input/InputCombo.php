<?php
namespace Rasty\Forms\input;

use Rasty\components\RastyComponent;
use Rasty\utils\XTemplate;
use Rasty\utils\RastyUtils;
use Rasty\utils\ReflectionUtils;

/**
 * Input para opciones (select)
 * 
 * @author bernardo
 * @since 07/08/2013
 */
class InputCombo extends InputText{

	/**
	 * valores posibles para el select (options).
	 * @var array
	 */
	private $options;

	/**
	 * label para el valor vacío.
	 * @var unknown_type
	 */
	private $emptyOptionLabel;
	
	/**
	 * función js definida por el usuario del componente
	 * que se ejecuta cuando se selecciona un objeto del combo.
	 * @var string
	 */
	private $onChangeCallback;
	
	/**
	 * para cuando mostramos entities en el combo.
	 * @var unknown_type
	 */
	private $finder;
	
	/**
	 * por si queremos customizar el render una option.
	 * @var unknown_type
	 */
	private $optionRenderer;
	
	public function __construct(){
		
		
	}
	
	public function getStyleCss(){
		
		$css = parent::getStyleCss();
		$css = str_replace("input-text", "input-combo", $css);
	    return $css;
	}
	
	protected function parseXTemplate(XTemplate $xtpl){

		parent::parseXTemplate($xtpl);
		
	    //renderizamos las opciones del select.
    		
    	$emptyLabel = $this->getEmptyOptionLabel();
    	if( !empty( $emptyLabel ) ){
    		$xtpl->assign( "empty_label", $emptyLabel );
    		$xtpl->parse( "main.option_empty" );
    	}
    	
    	$selected = $this->unformatValue( $this->getValue() );
    	
    	//si no hay render definido, seteamos el default
    	if( empty($this->optionRenderer))
    		$this->optionRenderer = new DefaultInputComboOptionRenderer();	
    	else 
    		$this->optionRenderer = ReflectionUtils::newInstance( $this->getOptionRenderer() );
    	
    	//si hay un finder definido son entities, sino tomamos como un array key=>value
    	if( empty($this->finder)){
	    	foreach ($this->getOptions() as $value => $label) {
	    		
	    		$this->optionRenderer->renderOption($xtpl, $label, $value, $selected);
//	    		$xtpl->assign( "label", $label );
//	    		$xtpl->assign( "value", RastyUtils::selected( $value, $selected) );
//	    		$xtpl->parse( "main.option" );
	    	}
	    		
    	}else{
    		
    		$finder = ReflectionUtils::newInstance( $this->getFinder() );
    		
    		foreach ($this->getOptions() as $entity) {
    			
    			$this->optionRenderer->renderEntityOption($xtpl, $finder, $entity, $selected );
    			
    			
//    			$label = $finder->getEntityLabel($entity);
//	    		$value = $finder->getEntityCode($entity);
//	    		$xtpl->assign( "label", $label );
//	    		$xtpl->assign( "value", RastyUtils::selected( $value, $selected) );
//	    		$xtpl->parse( "main.option" );
	    	}
    	}
    	
    	
    	$onchange = $this->getOnChangeCallback();
    	if(!empty($onchange)){
    		$this->parseProperty($xtpl, "onchange",  $onchange);
    	}
    	
	}
	
	
	public function initDefaults(){

		parent::initDefaults();
		
		if(empty($this->options))
			$this->setOptions( array() );
			
	}
	
	public function getType(){
		
		return "InputCombo";
	}
	

	public function getOptions()
	{
	    return $this->options;
	}

	public function setOptions($options)
	{
	    $this->options = $options;
	}



	public function getEmptyOptionLabel()
	{
	    return $this->emptyOptionLabel;
	}

	public function setEmptyOptionLabel($emptyOptionLabel)
	{
	    $this->emptyOptionLabel = $emptyOptionLabel;
	}

	public function getOnChangeCallback()
	{
	    return $this->onChangeCallback;
	}

	public function setOnChangeCallback($onChangeCallback)
	{
	    $this->onChangeCallback = $onChangeCallback;
	}

	public function getFinder()
	{
	    return $this->finder;
	}

	public function setFinder($finder)
	{
	    $this->finder = $finder;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see input/Rasty\Forms\input.InputText::unformatValue()
	 */
	public function unformatValue($value){
		
		if( !empty($this->finder) ){
			$finder = ReflectionUtils::newInstance( $this->getFinder() );
			return  $finder->getEntityCode( $value );
		}else{
			return parent::unformatValue($value);
		}
	}
	
	/**
	 * (non-PHPdoc)
	 * @see input/Rasty\Forms\input.InputText::formatValue()
	 */
	public function formatValue($value){

		if( !empty($this->finder) ){
			//redefinimos ya que se popula el id de la entity.
			//entonces a partir del id buscamos la entity
			$finder = ReflectionUtils::newInstance( $this->getFinder() );
			return  $finder->findEntityByCode( $value );
		}else{
			return parent::formatValue($value);
		}
		
		
	}
	
	public function getEntityId(){
		
		$finder = ReflectionUtils::newInstance( $this->getFinder() );
		return  $finder->getEntityCode( $this->getValue() );
	}
	

	public function getOptionRenderer()
	{
	    return $this->optionRenderer;
	}

	public function setOptionRenderer($optionRenderer)
	{
	    $this->optionRenderer = $optionRenderer;
	}
}
?>