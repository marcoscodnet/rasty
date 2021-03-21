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
class InputComboTree extends InputText{

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
	
	protected function parseXTemplate(XTemplate $xtpl){

		parent::parseXTemplate($xtpl);
		
	    //renderizamos las opciones del select.
    		
    	$emptyLabel = $this->getEmptyOptionLabel();
    	if( !empty( $emptyLabel ) ){
    		$xtpl->assign( "empty_label", $emptyLabel );
    		$xtpl->parse( "main.option_empty" );
    	}
    	
    	$selected = $this->unformatValue( $this->getValue() );
    	
    	//si hay un finder definido son entities, sino tomamos como un array key=>value
    	if( empty($this->finder)){
	    	foreach ($this->getOptions() as $option) {
	    		
	    		if(array_key_exists("isgroup", $option) && $option["isgroup"]){
	    			
	    			$xtpl->assign( "group_label", $option["label"] );
	    			$xtpl->assign( "group_id", $option["id"] );

	    			$suboptions = $option["suboptions"];
	    			foreach ($suboptions as $suboption) {
	    				$xtpl->assign( "label", $suboption["label"] );
	    				$xtpl->assign( "value", RastyUtils::selected( $suboption["id"], $selected) );
	    				$xtpl->parse( "main.option.group.subitem" );	
	    				
	    			}
	    			$xtpl->parse( "main.option.group" );
	    			
	    		}else{
	    			
		    		$xtpl->assign( "label", $label );
		    		$xtpl->assign( "value", RastyUtils::selected( $value, $selected) );
		    		$xtpl->parse( "main.option.item" );	
	    		}
	    		
	    		
	    		
	    		$xtpl->parse( "main.option" );
	    		
	    	}
	    		
    	}
//    	else{
//    		
//    		$finder = ReflectionUtils::newInstance( $this->getFinder() );
//    		
//    		foreach ($this->getOptions() as $entity) {
//    			$label = $finder->getEntityLabel($entity);
//	    		$value = $finder->getEntityCode($entity);
//	    		$xtpl->assign( "label", $label );
//	    		$xtpl->assign( "value", RastyUtils::selected( $value, $selected) );
//	    		$xtpl->parse( "main.option" );
//	    	}
//    	}
    	
    	
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
		
		return "InputComboTree";
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
	
}
?>